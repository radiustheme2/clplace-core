const {useEffect, useState, useRef} = wp.element;
const {Spinner} = wp.components;
const {apiFetch} = wp;
const {__} = wp.i18n;
import Masonry, {ResponsiveMasonry} from "react-responsive-masonry"
import {RttpgModal, ModalManager} from "./ModalManager";
import CardItem from "./components/CardItem";
import "./ImportLayoutModal.scss";

const CHECK_ICON = <svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path
        d="M3.18778 6C3.03869 5.99939 2.89575 5.94399 2.78943 5.84561L0.165003 3.3754C0.0593532 3.27596 0 3.14109 0 3.00046C0 2.85983 0.0593532 2.72496 0.165003 2.62552C0.270652 2.52608 0.413943 2.47021 0.563354 2.47021C0.712764 2.47021 0.856055 2.52608 0.961705 2.62552L3.18778 4.72078L8.0383 0.155306C8.09061 0.106068 8.15271 0.0670104 8.22106 0.0403629C8.28941 0.0137154 8.36267 0 8.43665 0C8.51063 0 8.58388 0.0137154 8.65223 0.0403629C8.72058 0.0670104 8.78269 0.106068 8.835 0.155306C8.88731 0.204545 8.92881 0.262999 8.95712 0.327332C8.98543 0.391664 9 0.460616 9 0.530249C9 0.599882 8.98543 0.668834 8.95712 0.733167C8.92881 0.797499 8.88731 0.855954 8.835 0.905192L3.58614 5.84561C3.47982 5.94399 3.33688 5.99939 3.18778 6Z"
        fill="white"/>
</svg>

const ImportLayoutModal = (props) => {
    const searchRef = useRef();
    const [loading, setLoading] = useState(true);
    const [allData, setAllData] = useState([]);
    //Layout
    const [layoutCategories, setLayoutCategories] = useState([]);
    const [layoutCards, setLayoutCards] = useState([]);
    const [allLayoutCount, setAllLayoutCount] = useState('');
    const [allSectionCount, setAllSectionCount] = useState('');
    const [catID, setCatID] = useState('all');
    const [searchTerm, setSearchTerm] = useState('');
    const [notFoundMessage, setNotFoundMessage] = useState('');

    const selectCatObj = {
        cat: 'all',
        name: 'Layout',
        count: allLayoutCount
    }
    const [selectedCategory, setSelectedCategory] = useState(selectCatObj)


    //Section
    const [sectionCategories, setSectionCategories] = useState([]);

    //Others
    const [category, setCategory] = useState('layout');
    const [cards, setCards] = useState([]);
    const [sidebarCategory, setSidebarCategory] = useState([]);
    const [status, setStatus] = useState('all');
    const [totalCount, setTotalCount] = useState('');

    const fetch_all_layouts = () => {

        let currentUserId = rtParams.current_user_id;

        const options = {
            method: "POST",
            url: `${rtParams.ajaxurl}?action=rttpg_get_layouts&nonce=${rtParams.nonce}&user_id=${currentUserId}&status=1`,
            headers: {"Content-Type": "application/json"},
        };

        apiFetch(options)
            .then((response) => {
                if (response.success) {
                    setAllData(response.data)
                    setLayoutCategories(response.data.layouts.category);
                    setSectionCategories(response.data.sections.category);
                    setAllLayoutCount(response.data.layouts.all_terms)
                    setAllSectionCount(response.data.sections.all_terms)
                    setLoading(false)
                } else {
                    setLoading(false)
                }
            })
            .catch((error) => {
                console.log(error)
                setLoading(false)
            });
    }


    useEffect(() => {
        fetch_all_layouts();
    }, []);

    useEffect(() => {

        if (layoutCategories && category === 'layout') {
            setSidebarCategory(layoutCategories);
        }

        if (sectionCategories && category === 'section') {
            setSidebarCategory(sectionCategories);
        }

        const allLayouts = allData?.layouts?.posts;
        const allSections = allData?.sections?.posts;

        if (allLayouts && category === 'layout') {
            setLayoutCards(allLayouts)
            setCards(allLayouts)
        }
        if (allSections && category === 'section') {
            setLayoutCards(allSections)
            setCards(allSections)
        }


    }, [layoutCategories, sectionCategories, category]);


    //Filter post and category
    const loadCards = () => {
        let newCards = [...cards];

        if (status === 'pro') {
            newCards = newCards.filter(item => item.status !== 'free');
            setTotalCount(newCards.length);
        }

        if (status === 'free') {
            newCards = newCards.filter(item => item.status === 'free');
            setTotalCount(newCards.length);
        }

        if (searchTerm) {
            newCards = newCards.filter(item => item.title.toLowerCase().includes(searchTerm));
            if (newCards.length === 0) {
                setNotFoundMessage("Sorry, we couldn't find the match.")
            } else {
                setNotFoundMessage('');
                setTotalCount(newCards.length);
            }
        } else {
            setNotFoundMessage('');
        }

        if (selectedCategory.cat != 'all') {
            let newLayout = newCards.filter(item => item.category === selectedCategory.cat);
            setLayoutCards(newLayout);

            setTotalCount(newLayout.length);
        } else {
            setLayoutCards(newCards)
        }


        setCatID(selectedCategory.cat);
    }

    const layoutClickHandle = (layout) => {
        setCategory(layout)
        setCatID('all');
        setSearchTerm('');
        setStatus('all');
        setTotalCount('')

        setTimeout(function () {
              setCatID('all');

              setSelectedCategory({
                  cat: 'all',
                  name: layout === 'layout' ? 'Layout' : 'Sections',
                  count: layout === 'layout' ? allLayoutCount : allSectionCount
              })
          }, 100)
    }

    useEffect(() => {
        setLayoutCards([])
        loadCards();
    }, ['', status, selectedCategory, searchTerm])


    return (
        <>
            <RttpgModal
                className={`rttpg-layout-modal-wrapper`}
                openTimeoutMS={0}
                closeTimeoutMS={0}
            >

                <div className={`rttpg-modal-inner modal-${category}`}>
                    <div className="rttpg-layout-modal-header">
                        <div className="rttpg-layout-header-inner">
                            <button className={category === 'layout' ? 'active' : 'button'}
                                    onClick={() => layoutClickHandle('layout')}>
                                {__("Starter Layouts")}
                            </button>
                            <button className={category === 'section' ? 'active' : 'button'}
                                    onClick={() => layoutClickHandle('section')}>
                                {__("Premade Section")}
                            </button>
                            {/*<button className={category === 'block' ? 'active' : 'button'}>
                                {__("Saved Section")}
                            </button>*/}
                        </div>

                        <div className="layout-search-wrapper">
                            <input
                                ref={searchRef}
                                type="text"
                                onChange={e => setSearchTerm(e.target.value)}
                                value={searchTerm}
                                placeholder={__("Search Here...")}
                                className="form-control"
                            />
                            <button className={`tpg-search-empty`}
                                    onClick={() => {
                                        setSearchTerm('');
                                        searchRef.current.focus();
                                    }}
                            ></button>
                            <svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M26.77 25.6596L20.6351 19.5248C22.518 17.3777 23.5569 14.6608 23.5569 11.7785C23.5569 8.63218 22.3316 5.67452 20.107 3.44996C17.8824 1.22539 14.9248 0 11.7785 0C8.63218 0 5.67452 1.22539 3.44996 3.44996C1.22539 5.67452 0 8.63218 0 11.7785C0 14.9248 1.22539 17.8824 3.44996 20.107C5.67452 22.3316 8.63218 23.5569 11.7785 23.5569C14.6608 23.5569 17.3777 22.518 19.5248 20.6351L25.6596 26.77C25.813 26.9233 26.0139 27 26.2148 27C26.4157 27 26.6166 26.9233 26.77 26.77C27.0767 26.4632 27.0767 25.9663 26.77 25.6596ZM4.56032 18.9966C2.63252 17.0684 1.57046 14.5049 1.57046 11.7785C1.57046 9.05202 2.63252 6.48851 4.56032 4.56032C6.48851 2.63252 9.05202 1.57046 11.7785 1.57046C14.5049 1.57046 17.0684 2.63252 18.9966 4.56032C20.9244 6.48851 21.9865 9.05202 21.9865 11.7785C21.9865 14.5049 20.9244 17.0684 18.9966 18.9966C17.0684 20.9244 14.5049 21.9865 11.7785 21.9865C9.05202 21.9865 6.48851 20.9244 4.56032 18.9966Z"
                                    fill="white"/>
                            </svg>
                        </div>

                        <button
                            className="rttpg-modal-close-wrapper"
                            onClick={(e) => {
                                ModalManager.close();
                            }}
                        >
                            {/*<i className={"fas fa-times"}/>*/}
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7 8.49049L1.78327 13.7072C1.58809 13.9024 1.33967 14 1.03802 14C0.736375 14 0.487959 13.9024 0.292775 13.7072C0.0975915 13.512 0 13.2636 0 12.962C0 12.6603 0.0975915 12.4119 0.292775 12.2167L5.50951 7L0.292775 1.78327C0.0975915 1.58809 0 1.33967 0 1.03802C0 0.736375 0.0975915 0.487959 0.292775 0.292775C0.487959 0.0975915 0.736375 0 1.03802 0C1.33967 0 1.58809 0.0975915 1.78327 0.292775L7 5.50951L12.2167 0.292775C12.4119 0.0975915 12.6603 0 12.962 0C13.2636 0 13.512 0.0975915 13.7072 0.292775C13.9024 0.487959 14 0.736375 14 1.03802C14 1.33967 13.9024 1.58809 13.7072 1.78327L8.49049 7L13.7072 12.2167C13.9024 12.4119 14 12.6603 14 12.962C14 13.2636 13.9024 13.512 13.7072 13.7072C13.512 13.9024 13.2636 14 12.962 14C12.6603 14 12.4119 13.9024 12.2167 13.7072L7 8.49049Z"
                                    fill="white"/>
                            </svg>

                        </button>
                    </div>


                    {/*TODO: Left Sidebar*/}

                    <div className="rttpg-layout-modal-sidebar">
                        <div className="rttpg-modal-sidebar-content">
                            <h3>{__('Categories')}</h3>
                            <ul className="rttpg-template-categories">

                                {category === 'layout' &&
                                    <li className={catID === 'all' ? 'block active' : 'block'}
                                        onClick={() => {
                                            setTotalCount('');
                                            setStatus('all');
                                            setSelectedCategory({
                                                cat: 'all',
                                                name: 'Layout',
                                                count: allLayoutCount
                                            })
                                        }
                                    }
                                    >
                                        <span className={`list-checkbox`}>
                                            {CHECK_ICON}
                                        </span>
                                        {__("All Starter Layouts")}
                                        <span className={`item-count`}>{allLayoutCount}</span>
                                    </li>
                                }

                                {category === 'section' &&
                                    <li className={catID === 'all' ? 'block active' : 'block'}
                                        onClick={() => {
                                            setTotalCount('');
                                            setStatus('all');
                                            setSelectedCategory({
                                                cat: 'all',
                                                name: 'Section',
                                                count: allSectionCount
                                            })
                                        }
                                    }
                                    >
                                        <span className={`list-checkbox`}>
                                            {CHECK_ICON}
                                        </span>
                                        {__("All Premade Sections")}
                                        <span className={`item-count`}>{allSectionCount}</span>
                                    </li>
                                }
                                {sidebarCategory && sidebarCategory.map(item => {
                                    let is_active = catID === item.term_id ? 'active' : '';
                                    return (
                                        <li
                                            className={`block ${is_active}`}
                                            key={item.term_id}
                                            onClick={() => setSelectedCategory({
                                                cat: item.term_id,
                                                name: item.name,
                                                count: item.count
                                            })}
                                        >
                                            <span className={`list-checkbox`}>
                                                 {CHECK_ICON}
                                            </span>
                                            {__(item.name)}
                                            <span className={`item-count`}>{item.count}</span>
                                        </li>
                                    )
                                })}
                            </ul>
                        </div>
                    </div>


                    <div className="rttpg-modal-content-wrapper">
                        {category != "saved_blocks" && (
                            <div className="rttpg-template-sub-header">
                                {/*TODO: Header*/}
                                <h4>
                                    {category === 'layout' ? allLayoutCount + " Layouts " : allSectionCount + " Sections "}
                                    {totalCount && "( " + totalCount + " )"}
                                </h4>

                                {/*TODO: action button */}
                                <div className="rttpg-template-filter-button-group">
                                    <button className={status === 'all' ? "active" : ''}
                                            onClick={() => {
                                                setStatus('all')
                                                setTotalCount('')
                                            }}>
                                        {__("All")}
                                    </button>

                                    <button className={status === 'free' ? "active" : ''}
                                            onClick={() => {
                                                setStatus('free')
                                            }}>
                                        {__("Free")}
                                    </button>

                                    <button className={status === 'pro' ? "active" : ''}
                                            onClick={() => {
                                                setStatus('pro')
                                            }}>
                                        <img src={rtParams.plugin_url + "/assets/images/crown.svg"} alt=""/>
                                        {__("Premium")}
                                    </button>
                                </div>
                            </div>
                        )}


                        {!loading ? (
                            <div id="modalContainer" className="rttpg-template-list">
                                <div className="rttpg-modal-template-container">

                                    {/*TODO: Cards*/}
                                    <div
                                        id="layouts-blocks-list"
                                        className={"rttpg-builder-page-templates"}
                                    >

                                        {notFoundMessage &&
                                            <span className={`rttpg-not-fount`}>{notFoundMessage}</span>
                                        }


                                        {
                                            layoutCards && category === 'layout' &&
                                            layoutCards.map((item) => (
                                                <CardItem
                                                    key={item.id}
                                                    data={item}
                                                    layout_id={item.id}
                                                    importLayoutBlock={props.insertBlocks}
                                                />
                                            ))
                                        }

                                        {layoutCards && category === 'section' &&
                                            <ResponsiveMasonry columnsCountBreakPoints={{300: 1, 768: 2, 1200: 3}}>
                                                <Masonry gutter="20px">
                                                    {
                                                        layoutCards.map((item) => (
                                                            <CardItem
                                                                key={item.id}
                                                                data={item}
                                                                layout_id={item.id}
                                                                importLayoutBlock={props.insertBlocks}
                                                            />
                                                        ))
                                                    }
                                                </Masonry>
                                            </ResponsiveMasonry>
                                        }
                                    </div>
                                </div>
                            </div>
                        ) : (
                            <div className="tpg-loader">
                                <Spinner/>
                            </div>

                        )}
                    </div>
                </div>
            </RttpgModal>
        </>
    )

}

export default ImportLayoutModal;