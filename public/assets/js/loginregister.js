var typing = new Typed (".auto-type", {
  strings: ["Desserts", "Lunch", "Dinner"],
  typeSpeed: 120,
  backSpeed: 50,
  loop: true
});

function closeRegis() {
  const card = document.querySelector('.card');
  const Modal = document.querySelector('.modal');
  card.style.display = 'none';
  Modal.style.display = 'none';
}

function Cpass() {
  var passA = document.getElementById("exPassword");
  var c1 = document.getElementById("checkbox1");
  var toggleText = document.getElementById("toggleText");

  if (passA.type === "password") {
      passA.type = "text";
      toggleText.textContent = "Hide Password";
      c1.checked = true;
  } else {
      passA.type = "password";
      toggleText.textContent = "Show Password";
      c1.checked = false;
  }
}

function C1pass() {
  var passB = document.getElementById("conPassword");
  var c2 = document.getElementById("checkbox2");
  var toggleTextF = document.getElementById("toggleTextF");

  if (passB.type === "password") {
      passB.type = "text";
      toggleTextF.textContent = "Hide Password";
      c2.checked = true;
  } else {
      passB.type = "password";
      toggleTextF.textContent = "Show Password";
      c2.checked = false;
  }
}

function LGpass() {
  var LGpass = document.getElementById("LGPassword");
  if (LGpass.type === "password") {
    LGpass.type = "text";
    toggleTextss.textContent = "Hide Password";
    document.getElementById("checkbox").checked = true;
  } else {
    LGpass.type = "password";
    toggleTextss.textContent = "Show Password";
    document.getElementById("checkbox").checked = false;
  }
}

var x = document.getElementById("login-form");
var y = document.getElementById("register-form");
var z = document.getElementById("btns");
var f = document.getElementById("formcard");

function login() {
  x.style.left = "0%";
  y.style.left = "100%";
  z.style.left = "0%";        
  f.style.height = "330px"
}

function register() {
  x.style.left = "-100%";
  y.style.left = "0%";
  z.style.left = "50%";
  f.style.height = "550px"
}

document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        const alerts = document.querySelectorAll(".floating-alert");
        alerts.forEach(alert => alert.remove());
    }, 5000);
});

//Validation
(function () {
  'use strict';

  function loginErrorSpace() {
    f.style.height = "400px";
  }

  function registerErrorSpace() {
    f.style.height = "700px";
  }
  
  function registerPassMissmatch() {
    f.style.height = "670px";
  }

  function checkPass() {
    var passA = document.getElementById("exPassword").value;
    var passB = document.getElementById("conPassword").value;
    var textEr = document.getElementById("invalid-feedback");
    var textEr1 = document.getElementById("invalid-feedback1");
    if (passA.length < 8 || passB.length < 8) {
      textEr.innerText = "Passwords must be 8-20 characters long.";
      textEr1.innerText = "Passwords must be 8-20 characters long.";
      textEr.style.display = "block";
      textEr1.style.display = "block";
      return false;
    }
    if (passA !== passB) {
      textEr.innerText = "Passwords didn't match";
      textEr1.innerText = "Passwords didn't match";
      textEr.style.display = "block";
      textEr1.style.display = "block";
      return false;
    }
    textEr.style.display = "none";
    return true;
  }

  // Function to validate forms
  function validateForm(formId) {
    const form = document.getElementById(formId);

    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        if (formId === 'login-form') {
          loginErrorSpace();
        }
        if (formId === 'register-form') {
          registerErrorSpace();
        }
      }

      if (formId === 'register-form') {
        const checkerP = checkPass();
        if (!checkerP) {
          registerPassMissmatch();
          event.preventDefault();
          event.stopPropagation();
        }
      }
      
      form.classList.add('was-validated');
    }, false);
  }

  // Initialize validation for registration and login forms
  document.addEventListener('DOMContentLoaded', function () {
    validateForm('login-form');        // For the login form
    validateForm('register-form');     // For the registration form 
  });
})();