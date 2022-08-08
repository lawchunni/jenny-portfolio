'use strict';

$(document).ready(function() {

    // invoke function
    searchAnimation();
    backToTop();

});

/**
 * search bar animation
 */
function searchAnimation()
{
    // expend search bar when search icon is clicked
    $('#searchbox .decor').click(function() {
        $('#searchbox .hidden_bar').animate({
            // show 
            opacity: 1
        }, 150)
        .delay(50)
        .animate({
            width: "300px"
        }, 300, function() {
            setTimeout(function() {
                $('#searchbox #search_form #search').focus(); 
            }, 600);
        })
        .css("pointer-events", "auto");

    });

    // collapse search box when search icon is clicked
    $('#searchbox .hidden_bar .icon').click(function(){
        // collapse search bar
        searchCollapse();
    });

    // check if user's mouse hits outside the searchbar when it is expended
    $(document).click(function(e) {
        const searchBox = $('#searchbox .hidden_bar');

        if(
            !searchBox.is(e.target) && 
            searchBox.has(e.target).length === 0 &&
            searchBox.css('opacity') == 1
        ) {
            // collapse search bar
            searchCollapse();
        }
    });
}

/**
 * Share collapse searchbar function for search Animation
 */
function searchCollapse() {
    $('#searchbox .hidden_bar').animate({
        // collapse
        width: "50px"
    }, 300)
    .delay(150)
    .animate({
        // hide
        opacity: 0
    }, 200)
    .css("pointer-events", "none");
}


/**
 * back to top arrow action 
 */
function backToTop() 
{
    $('#back_to_top').click(function(e) {
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
}
