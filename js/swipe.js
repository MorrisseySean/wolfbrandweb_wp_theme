export const detectswipe = (el,func) => {
    var swipe_det = new Object();
    swipe_det.sX = 0; swipe_det.sY = 0; swipe_det.eX = 0; swipe_det.eY = 0;
    var min_x = 30;  //min x swipe for horizontal swipe
    var max_x = 30;  //max x difference for vertical swipe
    var min_y = 50;  //min y swipe for vertical swipe
    var max_y = 60;  //max y difference for horizontal swipe
    var direc = "";
    var ele = document.getElementById(el);
    ele.addEventListener('touchstart',function(e){
      var t = e.touches[0];
      swipe_det.sX = t.screenX; 
      swipe_det.sY = t.screenY;
    },false);
    ele.addEventListener('touchmove',function(e){
      e.preventDefault();
      var t = e.touches[0];
      swipe_det.eX = t.screenX; 
      swipe_det.eY = t.screenY;    
    },false);
    ele.addEventListener('touchend',function(e){
      //horizontal detection
      if ((((swipe_det.eX - min_x > swipe_det.sX) || (swipe_det.eX + min_x < swipe_det.sX)) && ((swipe_det.eY < swipe_det.sY + max_y) && (swipe_det.sY > swipe_det.eY - max_y) && (swipe_det.eX > 0)))) {
        if(swipe_det.eX > swipe_det.sX) direc = "r";
        else direc = "l";
      }
      //vertical detection
      else if ((((swipe_det.eY - min_y > swipe_det.sY) || (swipe_det.eY + min_y < swipe_det.sY)) && ((swipe_det.eX < swipe_det.sX + max_x) && (swipe_det.sX > swipe_det.eX - max_x) && (swipe_det.eY > 0)))) {
        if(swipe_det.eY > swipe_det.sY) direc = "d";
        else direc = "u";
      }
  
      if (direc != "") {
        if(typeof func == 'function') func(el,direc);
      }
      var direc = "";
      swipe_det.sX = 0; swipe_det.sY = 0; swipe_det.eX = 0; swipe_det.eY = 0;
    },false);  
  }
  /**
 * Pass in an element and its CSS Custom Property that you want the value of.
 * Optionally, you can determine what datatype you get back.
 *
 * @param {String} propKey
 * @param {HTMLELement} element=document.documentElement
 * @param {String} castAs='string'
 * @returns {*}
 */

const getCSSCustomProp = (propKey, element = document.documentElement, castAs = 'string') => {
    let response = getComputedStyle(element).getPropertyValue(propKey);
  
    // Tidy up the string if there's something to work with
    if (response.length) {
      response = response.replace(/\'|"/g, '').trim();
    }
  
    // Convert the response into a whatever type we wanted
    switch (castAs) {
      case 'number':
      case 'int':
        return parseInt(response, 10);
      case 'float':
        return parseFloat(response, 10);
      case 'boolean':
      case 'bool':
        return response === 'true' || response === '1';
    }
  
    // Return the string response by default
    return response;
  };

  export const move_container = (elementId, d) => { 
      var ele = document.getElementById(elementId);
      var pos = getCSSCustomProp('--position', ele, 'number');
      
    if(d == "l") {
        pos = pos - 100;
        
    } else if (d == "r") {
        pos = pos + 100;        
    }
    if(d != "r" || d != "l") {
        ele.style.setProperty('--position', pos);
    }
  }