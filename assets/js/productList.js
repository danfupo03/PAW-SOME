document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".button.is-warning");

  buttons.forEach(function (button) {
    button.addEventListener("click", function () {
      const card = button.closest(".card");
      const productName = card.querySelector(".title.is-5").innerText;
      const quantityInput = card.querySelector("input[type='number']");
      const quantity = parseInt(quantityInput.value);

      if (isNaN(quantity) || quantity < 1) {
        alert("Please enter a valid quantity!");
        return;
      }

      alert(`Added ${quantity} of "${productName}" to the list!`);

      addToProductList(card, quantity);
    });
  });

  function addToProductList(card, quantity) {
    const productListContainer = document.getElementById("product-list");
    const clonedCard = card.cloneNode(true);

    clonedCard.querySelector(".button.is-warning").remove();
    clonedCard.querySelector("input[type='number']").remove();

    const quantityText = document.createElement("p");
    quantityText.textContent = `Quantity: ${quantity}`;
    clonedCard.querySelector(".card-content").appendChild(quantityText);

    productListContainer.appendChild(clonedCard);
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
