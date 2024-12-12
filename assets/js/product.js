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

