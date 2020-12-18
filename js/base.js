
    //include('scrollStyle.js');
    import {debounce, updateScrollStyle} from './scroll_style.js';
    import {detectswipe, move_container} from './swipe.js';
    // Run the loop once to get initial page setup
    //TODO: Fix this to work after initial page load.
    document.addEventListener('load', updateScrollStyle);
    // Listen for new scroll events
    document.addEventListener('scroll', debounce(updateScrollStyle));
    detectswipe('blog-container', move_container);
function drag(e) {
    e.preventDefault();
    
    if(x0 || x0 === 0)  
        _C.style.setProperty('--tx', `${Math.round(unify(e).clientX - x0)}px`)
};

