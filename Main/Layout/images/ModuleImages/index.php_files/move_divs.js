//Script author:Kirathe Dickson
//This script will be involved in the movement of divs on the system display

//Store double clicked objects for movement on a array
var pickedUp = new Array("", false);

function getReadyToMove(element, evt) {
//This function is to alert the browser to get ready to move objects
pickedUp[0] = element;
pickedUp[1] = true;
}

function checkLoadedObjects(evt) {
	//This function actually moves the selected objects
  if (pickedUp[1] == true) {
	//If there were selected objects to move,store them on a variable called currentSelectiuon
  var currentSelection = document.getElementById(pickedUp[0]);

  currentSelection.style.position = "absolute";
  //Set the new position of the selected object with the coordinates of the mouse 
  currentSelection.style.top = (evt.clientY + 1) + "px";
  currentSelection.style.left = (evt.clientX + 1) + "px";
  }
}

function dropLoadedObject(evt) {
	//To stop moving the objects,invoke this function
  if (pickedUp[1] == true) {
//If there were selected objects to move,store them on a variable called currentSelectiuon

  var currentSelection = document.getElementById(pickedUp[0]);
  //Set the new position of the selected object with the coordinates of the mouse 
  currentSelection.style.position = "absolute";
  currentSelection.style.top = (evt.clientY + 1) + "px";
  currentSelection.style.left = (evt.clientX + 1) + "px";
  //The array that had stored the objects will now be wiped out to stop moving the objects
  pickedUp = new Array("", false);
  }
}