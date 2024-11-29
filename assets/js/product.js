const changeColorButton = document.getElementById("changeColorButton");
const teddyBearImage = document.querySelector(".product img");

let isOriginalColor = true;

changeColorButton.addEventListener("click", function () {
  if (isOriginalColor) {
    teddyBearImage.src = "assets/images/kongBearColor.png";
    isOriginalColor = false;
  } else {
    teddyBearImage.src = "assets/images/kongBear.png";
    isOriginalColor = true;
  }
});

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
