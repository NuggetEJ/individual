//for responsive sandwich menu
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

function show_AddEntry() {  
    var x = document.getElementById("challengeDiv");
    x.style.display = 'block';
    var firstField = document.getElementById('sem');
    firstField.focus();
}

//reset form after modification to a php echo to fields
function resetForm() {
    document.getElementById("myForm").reset();
}

//this clear form to empty the form for new data
function clearForm() {
    var form = document.getElementById("myForm");
    if (form) {
        var inputs = form.getElementsByTagName("input");
        var textareas = form.getElementsByTagName("textarea");
        
        //clear select
        form.getElementsByTagName("select")[0].selectedIndex=0; 

        //clear all inputs
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type !== "button" && inputs[i].type !== "submit" && inputs[i].type !== "reset") {
                inputs[i].value = "";
            }
        }
        
        //clear all textareas
        for (var i = 0; i < textareas.length; i++) {
            textareas[i].value = "";
        }
    } else {
        console.error("Form not found");
    }
}

// Get the modal (from id01 - id03)
var loginModal = document.getElementById('id01');
var registerModal = document.getElementById('id02');
var editProfile = document.getElementById('id03');

// When the user clicks anywhere outside of the modals, close them
window.onclick = function(event) {
    if (event.target == loginModal) {
        loginModal.style.display = "none";
    }
    else if (event.target == registerModal) {
        registerModal.style.display = "none";
    }
    else if (event.target == editProfile) {
        editProfile.style.display = "none";
    }
}

