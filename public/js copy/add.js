function projectdetails(x)
{
var projectdetail = document.getElementById("click0"+x);

// Get the button that opens the modal
var btn = document.getElementById("getdetails"+x);

// Get the <span> element that closes the modal
// var span = document.getElementById("close"+x);


// When the user clicks on the button, open the modal
btn.onclick = function() {
  projectdetail.style.display = "block";
  if(x=="2")
  {
  	// document.getElementById("click02").style.marginLeft = "-110%";
  }
var projectdetail1 = document.getElementById("click1"+x).style.display;

// if(projectdetail1=="block")
// {

// }

	alert(projectdetail1);

}


}
function closedetail(x)
{
	// alert("fghdfg");
var projectdetail = document.getElementById("click0"+x);

// Get the button that opens the modal
var btn = document.getElementById("close"+x);
btn.onclick = function() {
projectdetail.style.display = "none";
}

}