
// Wait till document is loaded to update selected category
jQuery(document).ready(function($) {
    
    // Check if calendar exists yet every 200ms
    var checkExist = setInterval(function() {
        if ($('.eo-fc-filter-category').length || $('.eo-fc-filter-venue').length) {
            clearInterval(checkExist); // Stop checking

            let $category = $('.eo-fc-filter-category');
            let $venue = $('.eo-fc-filter-venue');
            
            if (get_vars.length !== 0) {

                // Categories
                // Get array of categories
                let $categories = $('.eo-fc-filter-category > option');
                let categories = $.map($categories, function(category) {
                    return category.value;
                });

                // Change the selected category if category exists in options list
                if (categories.includes(get_vars.category))
                    $category.val(get_vars.category).change();

                // Venues
                if ($('.eo-fc-filter-venue').length) {
                    // Get array of venues
                    let $venues = $('.eo-fc-filter-venue > option');
                    let venues = $.map($venues, function(venue) {
                        return venue.value;
                    });

                    // Change the selected venue if venue exists in options list
                    if (venues.includes(get_vars.place))
                        $venue.val(get_vars.place).change();
                }
                
            }
        }
    }, 200);
    
});