import {ModalManager} from "./ModalManager";
import ImportLayoutModal from "./ImportLayoutModal";

const {__} = wp.i18n;

const ImportLayout = () => {
    return (
        <button
            className="button button-large rttpg-import-btn"
            id="rttpg-import-button"
            title="The Post Grid"
            onClick={() => ModalManager.open(<ImportLayoutModal/>)}
        >
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M20 10C20 15.5228 15.5225 20 10 20C4.47754 20 0 15.5228 0 10C0 4.47717 4.47754 0 10 0C15.5225 0 20 4.47717 20 10ZM5 5H10V9.375H5V5ZM10 10.4688H5V14.8438H10V10.4688ZM10.7812 5H15.7812V9.375H10.7812V5ZM15.7812 10.4688H10.7812V14.8438H15.7812V10.4688Z" fill="white"/>
            </svg>

            {__("The Post Grid")}
        </button>
    );
};
export default ImportLayout;