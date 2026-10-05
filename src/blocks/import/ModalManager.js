const {__} = wp.i18n;
const {Component} = wp.element;

var onClose;

export class RttpgModal extends Component {

    state = {
        afterOpen: false,
        beforeClose: false,
    };

    close = () => {
        if (!this.props.onRequestClose || this.props.onRequestClose()) {
            ModalManager.close();
        }
    }

    handleKeyDown = (event) => {
        if (event.keyCode === 27) {
            ModalManager.close();
        }
    };

    componentDidMount() {
        const {openTimeoutMS, closeTimeoutMS} = this.props;
        document.addEventListener("keydown", this.handleKeyDown);
        setTimeout(() => this.setState({afterOpen: true}), openTimeoutMS ? openTimeoutMS : 150);

        onClose = (callback) => {
            this.setState({beforeClose: true}, () => {
                this.closeTimer = setTimeout(callback, closeTimeoutMS ? closeTimeoutMS : 150);
            });
        };
    }

    componentWillUnmount() {
        onClose = null;
        clearTimeout(this.closeTimer);
        document.removeEventListener("keydown", this.handleKeyDown);
    }

    render() {
        return (
            <>
				<span
                    onClick={(e) => {
                        this.close();
                    }}
                    className="rttpg-layout-modal-overlay"
                >
					&nbsp;
				</span>
                <div className={`rttpg-layout-modal-inner`} onClick={(e) => e.stopPropagation()}>
                    {this.props.children}
                </div>
            </>
        );
    }
}

var modalWrapper;
export const ModalManager = {
    open(component) {
        if (onClose) {
            throw __("There is already one modal.It must be closed before one new modal will be opened");
        }
        if (!modalWrapper) {
            modalWrapper = document.createElement("div");
            modalWrapper.className = "rttpg-builder-modal";
            document.body.appendChild(modalWrapper);
        }
        wp.element.render(component, modalWrapper);
        document.body.classList.add("rttpg-builder-modal-open");
    },
    close() {
        onClose &&
        onClose(() => {
            wp.element.unmountComponentAtNode(modalWrapper);
            document.body.classList.remove("rttpg-builder-modal-open");
        });
    },
};