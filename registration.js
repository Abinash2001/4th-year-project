// current address same as permanent address
function address_function(){    
    if(chk.checked==true)
    {
        document.querySelector(".curr_house").value=document.querySelector(".perma_house").value;
        document.querySelector(".curr_area").value=document.querySelector(".perma_area").value;
        document.querySelector(".curr_city").value=document.querySelector(".perma_city").value;
        document.querySelector(".curr_district").value=document.querySelector(".perma_district").value;
        document.querySelector(".curr_po").value=document.querySelector(".perma_po").value;
        document.querySelector(".curr_ps").value=document.querySelector(".perma_ps").value;
        document.querySelector(".curr_pin").value=document.querySelector(".perma_pin").value;
        document.querySelector(".curr_country").value=document.querySelector(".perma_country").value;
    }
    else{
        document.querySelector(".curr_house").value='';
        document.querySelector(".curr_area").value='';
        document.querySelector(".curr_city").value='';
        document.querySelector(".curr_district").value='';
        document.querySelector(".curr_po").value='';
        document.querySelector(".curr_ps").value='';
        document.querySelector(".curr_pin").value='';
        document.querySelector(".curr_country").value='';
    }
}

// age calculate
function findAge(){
    var day=document.querySelector(".dob").value;
    var Dob=new Date(day);
    var today=new Date();
    var Age=today.getTime()-Dob.getTime();
    Age=Math.floor(Age/(1000*60*60*24*365.25));
    console.log(Age);
    document.querySelector(".age").value=Age;
}
// image upload
// AADHAR FRONT
function showPreview1(event) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.querySelector(".a_f_img");
        preview.src = src;
        preview.style.display = "block";
        document.querySelector(".upload_area_1").style.height="auto";
    }
}
// AADHAR BACK
function showPreview2(event) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.querySelector(".a_b_img");
        preview.src = src;
        preview.style.display = "block";
        document.querySelector(".upload_area_2").style.height="auto";
    }
}
// VOTER
function showPreview3(event) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.querySelector(".voter_img");
        preview.src = src;
        preview.style.display = "block";
        document.querySelector(".upload_area_3").style.height="auto";
    }
}

// password and confirm password
var passwordInput = document.getElementById("password");
passwordInput.addEventListener("input", checkPasswordStrength);

function checkPasswordStrength() {
    var password = passwordInput.value;
    var strengthMessage = document.getElementById("strength_message");
  
    // Define the criteria for a strong password
    var strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  
    // Define the criteria for a medium password
    var mediumRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/;
  
    if (strongRegex.test(password)) {
      // Password is strong
      strengthMessage.innerHTML = "Password strength: strong";
      strengthMessage.style.color = "green";
    } else if (mediumRegex.test(password)) {
      // Password is medium
      strengthMessage.innerHTML = "Password strength: medium";
      strengthMessage.style.color = "orange";
    } else {
      // Password is weak
      strengthMessage.innerHTML = "Password strength: weak";
      strengthMessage.style.color = "red";
    }
}

var cpasswordstrength=document.getElementById("cpassword");
cpasswordstrength.addEventListener("input",checkPassword);
function checkPassword(){
    let password = document.getElementById("password").value;
    let cnfrmPassword = document.getElementById("cpassword").value;
    console.log(" Password:", password,'\n',"Confirm Password:",cnfrmPassword);
    let message = document.getElementById("message");

    if(password.length != 0){
        if(password == cnfrmPassword){
            message.textContent = "Passwords match";
            message.style.color = "#1dcd59";
        }
        else{
            message.textContent = "Password don't match";
            message.style.color = "#ff4d4d";
        }
    }
}