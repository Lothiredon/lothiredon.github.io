// VARIABLES
const rangeInput = document.querySelector('input[type = "range"]');
const imageList = document.querySelector(".image-list");
const searchInput = document.querySelector('input[type="search"]');
const btns = document.querySelectorAll(".view-options button");
const photosCounter = document.querySelector(".toolbar .counter span");
const imageListItems = document.querySelectorAll(".image-list li");
const captions = document.querySelectorAll(".image-list figcaption p:first-child");
const myArray = [];
let counter = 1;
const active = "active";
const listView = "list-view";
const gridView = "grid-view";
const dNone = "d-none";

// SET VIEW
for (const btn of btns) {
  btn.addEventListener("click", function() {
    const parent = this.parentElement;
    document.querySelector(".view-options .active").classList.remove(active);
    parent.classList.add(active);
    this.disabled = true;
    document.querySelector('.view-options [class^="show-"]:not(.active) button').disabled = false;

    if (parent.classList.contains("show-list")) {
      parent.previousElementSibling.previousElementSibling.classList.add(dNone);
      imageList.classList.remove(gridView);
      imageList.classList.add(listView);
    } else {
      parent.previousElementSibling.classList.remove(dNone);
      imageList.classList.remove(listView);
      imageList.classList.add(gridView);
    }
  });
}

// SET THUMBNAIL VIEW - CHANGE CSS VARIABLE
rangeInput.addEventListener("input", function() {
  document.documentElement.style.setProperty("--minRangeValue",`${this.value}px`);

      //Change slide thumb color on way up
    if (this.value > 250) {
      inputRange.classList.add('ltpurple');
    }
    if (this.value > 300) {
        inputRange.classList.add('purple');
    }
    if (this.value > 350) {
        inputRange.classList.add('pink');
    }

    //Change slide thumb color on way down
    if (this.value < 250) {
        inputRange.classList.remove('ltpurple');
    }
    if (this.value < 300) {
        inputRange.classList.remove('purple');
    }
    if (this.value < 350) {
        inputRange.classList.remove('pink');
    }
});

// SEARCH FUNCTIONALITY
for (const caption of captions) {
  myArray.push({
    id: counter++,
    text: caption.textContent
  });
}

searchInput.addEventListener("keyup", keyupHandler);

function keyupHandler() {
  for (const item of imageListItems) {
    item.classList.add(dNone);
  }
  const text = this.value;
  const filteredArray = myArray.filter(el => el.text.includes(text));
  if (filteredArray.length > 0) {
    for (const el of filteredArray) {
      document.querySelector(`.image-list li:nth-child(${el.id})`).classList.remove(dNone);
    }
  }
  photosCounter.textContent = filteredArray.length;
}

var inputRange = document.getElementsByClassName('range')[0],
    /*maxValue = 1,*/ // the higher the smoother when dragging
    /*speed = 5,*/
    currValue;

// set equal to HTML input range min and max value
inputRange.min = 200;
inputRange.max = 400;

// handle range animation
function animateHandler() {

  // calculate gradient transition
  var transX = currValue - maxValue;
  
  // update input range
  inputRange.value = currValue;

  // decrement value
  currValue = currValue - speed;
}

// bind events
inputRange.addEventListener('mousedown', unlockStartHandler, false);
inputRange.addEventListener('mousestart', unlockStartHandler, false);
inputRange.addEventListener('mouseup', unlockEndHandler, false);
inputRange.addEventListener('touchend', unlockEndHandler, false);