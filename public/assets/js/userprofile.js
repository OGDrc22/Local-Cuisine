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
  
    function checkPass() {
      var passA = document.getElementById("exPassword").value;
      var passB = document.getElementById("conPassword").value;
      var textEr = document.getElementById("invalid-feedback");
      var textEr1 = document.getElementById("invalid-feedback1");
      if ((passA.length < 8 && passA.length > 0) || (passB.length < 8 && passB.length > 0)) {
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
  

document.addEventListener('DOMContentLoaded', function () {
  console.log('DOM fully loaded and parsed'); // Log message

      const modalSub = new bootstrap.Modal(document.getElementById('confirmationModal'));

  document.getElementById('openModal').addEventListener('click', function () {
      console.log('openModal click detected'); // Log message
      // Open the modal
      modalSub.show();
  });

  document.getElementById('confirmSubmit').addEventListener('click', function () {
      console.log('confirmSubmit click detected'); // Log message
      const form = document.getElementById('update-form');
      console.log(form); // Log the form element
      if (form.checkValidity() && checkPass()) {
          console.log('Form is valid and passwords match'); // Log message
          form.submit();
      } else {
          console.log('Form is invalid or passwords do not match');
          modalSub.hide();
      }
  });

  document.getElementById('openModalD').addEventListener('click', function () {
      console.log('openModalD click detected'); // Log message
      // Open the modal
      const modal = new bootstrap.Modal(document.getElementById('confirmationModalD'));
      modal.show();
  });

  document.getElementById('confirmDelete').addEventListener('click', function () {
      console.log('confirmSubmitD click detected'); // Log message
      const formD = document.getElementById('myFormD');
      console.log(formD); // Log the form element
      if (formD) {
          formD.submit();
      } else {
          console.error('Form myFormD not found'); // Log error if form not found
      }
  });
});
