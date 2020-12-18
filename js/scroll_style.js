// Returns scroll position of the window
export const getScroll = () => {
  return window.scrollY;  
}

// Change the target div based on the wanted scroll percentage
export const changeDiv = (elementId, parameter, startChange, duration, changeAmount, startValue = 0, valueType = 'rem') => {
  const scrollY = window.scrollY;
  const changeElement = elementId;
  let string = startValue.toString() + valueType;

  // Check if the scrollY has passed startChange before doing anything.
  if(scrollY > startChange) {

    // Calculate the endChange and check if scrollY has passed that value
    const endChange = startChange + duration;
    if(scrollY < endChange) {

      // Find the percentage of the change associated with the current scroll value
      const percentChange = (scrollY - startChange) / duration;
 
      // Find the new value, then convert it to a string
      const change = startValue + changeAmount * percentChange;    
      string = change.toString() + valueType;

      // Set the new value
      //document.getElementById(elementId).style.setProperty(parameter, string);

    } else {

      // Find the new value, then convert it to a string
      const change = startValue + changeAmount;    
      string = change.toString() + valueType;

      // Set the new value
      //document.getElementById(elementId).style.setProperty(parameter, string);
      
    }
  } else {
      // Set the parameter back to it's starting value
      //document.getElementById(elementId).style.setProperty(parameter, startValue.toString() + valueType);
  } 
  document.getElementById(elementId).style.setProperty(parameter, string);
}

const translateDiv = (elementId, parameter, startChange, duration, changeAmount, startValue = '0', valueType = 'rem') => {
  // TODO: A method which moves divs based on user scroll actions
}

//Changes an elements color based on user scroll actions.
export const changeColor = (elementId, parameter, startChange, duration, startRGBA, endRGBA) => {
  const scrollY = window.scrollY;
  let newColor = startRGBA;  
  if(scrollY > startChange) {      
      if(scrollY < startChange + duration) {
        // Use regex to seperate the individual values of an RGBA code.
        const newRegex = /rgba?\((\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*(?:,\s*([\d\.]+))?\s*\)/;
        const startColor = newRegex.exec(startRGBA);
        const endColor = newRegex.exec(endRGBA);

        // Set a storage array for the color values
        let colorPalette = [0, 0, 0, startColor[4]]

        // Get the percentage of change
        const percentChange = (scrollY - startChange) / duration;
        for(let i = 1; i < 5; i++) {     
          // Parse the individual RGB values to Ints
          let colorA = parseInt(startColor[i]);
          let colorB = parseInt(endColor[i])
          // Assign a variable to track the direction of change.
          let direction = 1;

          // If the colors are not equal, perform a change
          if(colorA != colorB) {
            // Get the distance between the two colors
            let dist = colorB - colorA;
            // If the distance is below 0, reverse the direction and invert the distance
            if(dist < 0) {
              dist *= -1;
              direction = -1;
            }
            // Move the color based on percentage scrolled.
            let change = (dist * percentChange) * direction;

            // Assign the new value to an array
            colorPalette[i-1] = colorA + change;
            newColor = getRGBA(colorPalette);
            
          }
        }
      
    } else {
      newColor = endRGBA;
    }
  } else {
    newColor = startRGBA;
  }
  // Set the color to the correct property.
  document.getElementById(elementId).style.setProperty(parameter, newColor);
  
}

// Converts an array to an RGB value
const getRGBA = (values) => {
  return 'rgba(' + values.join(', ') + ')';
}

// The debounce method queues the event until the browser is ready
// to draw a new frame, increasing performance.
// Credit: Riq Schennik https://pqina.nl/blog/applying-styles-based-on-the-user-scroll-position-with-smart-css/
export const debounce = (fn) => {
  let frame;

  return (...params) => {
    if(frame) {
      cancelAnimationFrame(frame);
    }
    frame = requestAnimationFrame(() => {
      fn(...params);
    });
  }
}

// Runs the given parameter changes. 
export const updateScrollStyle = () => {
  /*
    Website colors: 
      color-primary: rgba(111, 74, 142, 1)
      color-primary: rgba(98,35,176, 1)
      rgb(110,39,197)
      color-secondary: rgba(34, 31, 59, 1)
      color-black: rgba(5, 5, 5, 1)
      color-white: rgba(235, 235, 235, 1)
  */

  // Changes hero color and text as the user scrolls 
  changeColor('hero', 'background-color', 50, 400, 'rgba(110, 39, 197, 1)', 'rgba(5, 5, 5, 1)');
  changeColor('hero', 'color', 50, 400, 'rgba(5, 5, 5, 1)', 'rgba(235, 235, 235, 1)');
  // Changes the height of the divider image and adds padding
  changeDiv('first-divider', 'padding-left', 400, 150, 10, 0, '%');
  changeDiv('first-divider', 'padding-right', 400, 150, 10, 0, '%');
  // Content container 
  changeDiv('content-main', 'opacity', 650, 200, 100, 0, '%');

  // Intro div
  changeDiv('intro', 'height', 700, 500, 45, 0, 'rem');

}