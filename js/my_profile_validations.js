function openItem(evt, catName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(catName).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();



const currenttoggle = document.querySelector("#currenttoggle");
const currentpassword = document.querySelector("#current_password");

currenttoggle.addEventListener("click", function () {
   
  // toggle the type attribute
  const currenttype = currentpassword.getAttribute("type") === "password" ? "text" : "password";
  currentpassword.setAttribute("type", currenttype);
  // toggle the eye icon
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});


const newtoggle = document.querySelector("#newtoggle");
const newpassword = document.querySelector("#new_password");

newtoggle.addEventListener("click", function () {
   
  // toggle the type attribute
  const newtype = newpassword.getAttribute("type") === "password" ? "text" : "password";
  newpassword.setAttribute("type", newtype);
  // toggle the eye icon
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});


const confirmtoggle = document.querySelector("#confirmtoggle");
const confirmpassword = document.querySelector("#confirm_password");

confirmtoggle.addEventListener("click", function () {
   
  // toggle the type attribute
  const confirmtype = confirmpassword.getAttribute("type") === "password" ? "text" : "password";
  confirmpassword.setAttribute("type", confirmtype);
  // toggle the eye icon
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});



