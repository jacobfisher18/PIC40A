function makeCloud() {

  //grabs texarea text, splits into an array, and sorts the array
  var tags = document.getElementById("tags").value.split(" ").sort();

  var uniqueTags = [];
  var frequencyTags = [];

  for (var i = 0; i < tags.length; i++) {
    if (tags[i] !== tags[i+1]) {
      uniqueTags.push(tags[i]);
    }
  }

  for (var j = 0; j < uniqueTags.length; j++) {
    frequencyTags[j] = 0;
    for (var k = 0; k < tags.length; k++) {
      if (tags[k] === uniqueTags[j]) {
        frequencyTags[j]++;
      }
    }
  }

  var maxFreq = max(frequencyTags);
  createSpans(uniqueTags, frequencyTags);

  var allSpans = document.getElementsByTagName("span");

  for (var i = 0; i < uniqueTags.length; i++) {
    var fontSize = Math.floor((frequencyTags[i] / maxFreq) * 20 + 0.5) + 15 + "pt";
    allSpans[i].style.fontSize = fontSize;
  }
}

function saveCloud() {
  var cookiedate = new Date( 2018, 0, 0, 0);
  document.cookie = "my_text = " + document.getElementById("tags").value + "; expires = " + cookiedate.toGMTString();
}

function loadCloud() {
  var cookie = document.cookie;
  var arr = cookie.split(";");
  var pair = arr[0].split("=");
  var val = pair[1];

  document.getElementById("tags").value = val;
}

function clearArea() {
  document.getElementById("tags").value = "";
}

//given an array of numbers, return the highest value
function max(arr) {
  var max = 0;

  for (var i = 0; i < arr.length; i++) {
    if (arr[i] > max) {
      max = arr[i];
    }
  }

  return max;
}

//creates spans for the tags, passed as a parameter
function createSpans(tags, frequencies) {
  var container = document.createElement("div");

  for (var i = 0; i < tags.length; i++) {
    var tag = document.createElement("span");
    tag.innerHTML = tags[i];
    var value = tags[i];
    var freq = frequencies[i];

    tag.onclick = function(v, f) {
      return function() {
        alert(v + ": " + f + " occurrences");
      }
    }(value, freq);

    container.appendChild(tag);
  }

  container.style.border = ".1em solid silver";
  container.style.backgroundColor = "blue";
  container.style.color = "silver";
  container.style.font = "serif";
  container.style.fontSize = "x-large";

  var oldDiv = document.getElementsByTagName("div")[0];
  document.body.replaceChild(container, oldDiv);
}
