const ssList = rtParams.ssList;
import {change_icon} from "./functions";


function SocialShare() {

    return (
        <div className="rt-tpg-social-share">
            {ssList.includes('facebook') &&
                <a href="#" className="facebook"><i className={change_icon("fab fa-facebook-f", "facebook")} aria-hidden="true"></i></a>}
            {ssList.includes('twitter') &&
                <a href="#" className="twitter"><i className={change_icon("fab fa-twitter", "twitter")} aria-hidden="true"></i></a>}
            {ssList.includes('linkedin') &&
                <a href="#" className="linkedin"><i className={change_icon("fab fa-linkedin-in", "linkedin")} aria-hidden="true"></i></a>}
            {ssList.includes('pinterest') &&
                <a href="#" className="pinterest"><i className={change_icon("fab fa-pinterest", "pinterest")} aria-hidden="true"></i></a>}
            {ssList.includes('reddit') &&
                <a href="#" className="reddit"><i className={change_icon("fab fa-reddit-alien", "reddit")} aria-hidden="true"></i></a>}
            {ssList.includes('email') && <a href="#" className="email"><i className={change_icon("fa fa-envelope", "email")}></i></a>}
        </div>
    );
}

export default SocialShare;
