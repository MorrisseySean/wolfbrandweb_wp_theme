
    //include('scrollStyle.js');
    import {debounce, updateScrollStyle} from './scroll_style.js';
    import {detectswipe, move_container} from './swipe.js';

    // Run the loop once to get initial page setup
    //TODO: Fix this to work after initial page load.
    document.addEventListener('load', updateScrollStyle);
    // Listen for new scroll events
    document.addEventListener('scroll', debounce(updateScrollStyle));
    detectswipe('blog-container', move_container);

