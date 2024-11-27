function darkMode() {
  let body = document.body;
  let button = document.getElementById("dark-mode");
  let icon = document.querySelector("#dark-mode i");

  body.classList.toggle("dark-mode");

  if (body.classList.contains("dark-mode")) {
    icon.classList.remove("fa-moon");
    icon.classList.add("fa-sun");
    button.classList.remove("is-dark");
    button.classList.add("is-light");
  } else {
    icon.classList.remove("fa-sun");
    icon.classList.add("fa-moon");
    button.classList.remove("is-light");
    button.classList.add("is-dark");
  }
}

const password = "password123";
const username = "JohnDoe03";

const form = document.querySelector("form");
form.addEventListener("submit", (e) => {
  e.preventDefault();
  const passwordInput = document.querySelector('input[type="password"]');
  const usernameInput = document.querySelector('input[type="text"]');
  if (passwordInput.value === password && usernameInput.value === username) {
    window.location.href = "index.html";
  } else {
    alert("Invalid username or password");
  }
});
