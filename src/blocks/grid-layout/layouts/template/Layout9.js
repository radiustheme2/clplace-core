import Thumbnail from "../../../component-parts/Thumbnail"

function Layout9({attributes, post}) {
    const {grid_column, hover_animation, layout_style, show_thumb} = attributes;

    let new_grid_column = {...grid_column};
    const gridColKeys = Object.keys(new_grid_column);
    gridColKeys.length && gridColKeys.map(function (key) {
        if (new_grid_column[key] == '1') {
            new_grid_column[key] = '12';
        } else if (new_grid_column[key] == '2') {
            new_grid_column[key] = '6';
        } else if (new_grid_column[key] == '3') {
            new_grid_column[key] = '4';
        } else if (new_grid_column[key] == '4') {
            new_grid_column[key] = '3';
        } else if (new_grid_column[key] == '5') {
            new_grid_column[key] = '24';
        } else if (new_grid_column[key] == '6') {
            new_grid_column[key] = '2';
        }
    });

    let grid_column_desktop = new_grid_column?.lg ? new_grid_column.lg : '4';
    let grid_column_tab = new_grid_column?.md ? new_grid_column.md : '6';
    let grid_column_mobile = new_grid_column?.sm ? new_grid_column.sm : '12';
    let gridColumn = "rt-col-md-" + grid_column_desktop + " rt-col-sm-" + grid_column_tab + " rt-col-xs-" + grid_column_mobile;

    let colClasses = " rt-grid-item";
    colClasses += " " + hover_animation;
    if (layout_style === 'masonry') {
        colClasses += " masonry-grid-item";
    }

    return (
        <div className={post.post_class + ' ' + gridColumn + ' ' + colClasses} data-id={post.id}>
            <div className="rt-holder tpg-post-holder">
                <div className="rt-detail rt-el-content-wrapper">
                    {(show_thumb === 'show') &&
                        <div className="rt-img-holder tpg-el-image-wrap">
                            <Thumbnail attributes={attributes} post={post}/>
                        </div>
                    }
                </div>
            </div>
        </div>
    );
}

export default Layout9;
