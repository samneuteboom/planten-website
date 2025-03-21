// Navigatie-functies
function hideAll() {
    document.querySelectorAll('.container').forEach(el => el.classList.add('hidden'));
  }
  
  function goToHome() {
    hideAll();
    document.getElementById('homePage').classList.remove('hidden');
  }

  function goToLogin() {
    hideAll();
    document.getElementById('loginPage').classList.remove('hidden');
  }

  function goToRegister() {
    hideAll();
    document.getElementById('registerPage').classList.remove('hidden');
  }

  function goToDashboard() {
    hideAll();
    document.getElementById('dashboardPage').classList.remove('hidden');
    document.getElementById('welcomeMessage').innerText = "Welkom, " + localStorage.getItem('loggedInUser') + "!";
  }

  function goToShop() {
    hideAll();
    document.getElementById('shopPage').classList.remove('hidden');
  }

  // Registreren
  function registerUser() {
    var username = document.getElementById('registerUsername').value.trim();
    var password = document.getElementById('registerPassword').value.trim();
    var messageEl = document.getElementById('registerMessage');

    if (username === "" || password === "") {
      messageEl.innerText = "Vul alle velden in!";
      return;
    }
    if (localStorage.getItem("user_" + username)) {
      messageEl.innerText = "Gebruikersnaam bestaat al!";
      return;
    }

    var user = { username: username, password: password };
    localStorage.setItem("user_" + username, JSON.stringify(user));

    messageEl.style.color = "green";
    messageEl.innerText = "Registratie geslaagd! Ga naar inloggen.";
  }

  // Inloggen
  function loginUser() {
    var username = document.getElementById('loginUsername').value.trim();
    var password = document.getElementById('loginPassword').value.trim();
    var messageEl = document.getElementById('loginMessage');

    if (username === "" || password === "") {
      messageEl.innerText = "Vul alle velden in!";
      return;
    }

    var storedUser = localStorage.getItem("user_" + username);
    if (!storedUser) {
      messageEl.innerText = "Gebruiker niet gevonden!";
      return;
    }

    var user = JSON.parse(storedUser);
    if (user.password !== password) {
      messageEl.innerText = "Onjuist wachtwoord!";
      return;
    }

    // Succesvolle login
    localStorage.setItem('loggedInUser', username);
    goToDashboard();
  }

  // Uitloggen
  function logoutUser() {
    localStorage.removeItem('loggedInUser');
    goToHome();
  }

  // Controleer of er een gebruiker is ingelogd bij het laden van de pagina
  window.onload = function() {
    if (localStorage.getItem('loggedInUser')) {
      goToDashboard();
    } else {
      goToHome();
    }
  }