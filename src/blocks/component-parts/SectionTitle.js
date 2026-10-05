import {RichText} from '@wordpress/block-editor';
import {change_icon} from "./functions";

const SectionTitle = ({attributes, setAttributes}) => {
    const {
        show_section_title,
        section_title_style,
        section_title_source,
        section_title_text,
        section_title_tag,
        enable_external_link,
        section_external_text
    } = attributes;
    if ('show' !== show_section_title) {
        return '';
    }
    const HeadingTag = `${section_title_tag}`;
    return (
        <div className={`tpg-widget-heading-wrapper rt-clear heading-${section_title_style}`}>
            <span className="tpg-widget-heading-line line-left"></span>
            <HeadingTag className="tpg-widget-heading">
                <span>{
                    'page_title' === section_title_source ? rtParams.pageTitle :
                        <RichText
                            allowedFormats={['core/bold', 'core/italic']}
                            value={section_title_text}
                            onChange={(section_title_text) => setAttributes({section_title_text})}
                        />
                }</span>

            </HeadingTag>
            <span className="tpg-widget-heading-line line-right"></span>

            {'show' === enable_external_link &&
                <a className={`external-link`} href='#'>
                    {section_external_text && <span className={`external-lable`}>{section_external_text}</span>}
                    <i className={change_icon("fas fa-arrow-right", "right-arrow")} aria-hidden="true"></i>
                </a>
            }
        </div>
    )
}

export default SectionTitle;