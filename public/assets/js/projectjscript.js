function Cpass() {
    var conpass = document.getElementById("exPassword");
    if (conpass.type === "password") {
      conpass.type = "text";
      toggleText.textContent = "Hide Password";
    } else {
      conpass.type = "password";
      toggleText.textContent = "Show Password";
    }
  }

  function CFpass() {
    var conFpass = document.getElementById("conPassword");
    if (conFpass.type === "password") {
      conFpass.type = "text";
      toggleTexts.textContent = "Hide Password";
    } else {
      conFpass.type = "password";
      toggleTexts.textContent = "Show Password";
    }
  }

  function LGpass() {
    var LGpass = document.getElementById("LGPassword");
    if (LGpass.type === "password") {
      LGpass.type = "text";
      toggleTextss.textContent = "Hide Password";
    } else {
      LGpass.type = "password";
      toggleTextss.textContent = "Show Password";
    }
  }

  var hsButton = document.getElementById('hsButton');
  var inp = document.getElementById('uPass');
  var currentDis = 1;

  function hsPassInput() {
    if (currentDis == 1) {
      inp.style.display = 'block';
      currentDis = 0;
      hsButton.textContent = 'Cancel';
    } else {
      inp.style.display = 'none';
      currentDis = 1;
      hsButton.textContent = 'Update Password';
    }
  }
