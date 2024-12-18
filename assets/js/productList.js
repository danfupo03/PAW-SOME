const buttons = document.querySelectorAll(".button.is-warning");

buttons.forEach(function (button) {
  button.addEventListener("click", function () {
    const card = button.closest(".card");
    const productName = card.querySelector(".title.is-5").innerText;
    const quantityInput = card.querySelector("input[type='number']");
    const priceInput = card.querySelector("strong").innerText;
    const price = parseFloat(priceInput.replace("Price: $", ""));
    const quantity = parseInt(quantityInput.value);
    const totalPrice = price * quantity;

    if (isNaN(quantity) || quantity < 1) {
      alert("Please enter a valid quantity!");
      return;
    }

    alert(`Added ${quantity} of "${productName}" to the list!`);

    addToProductList(productName, quantity, totalPrice);
  });
});

function addToProductList(productName, quantity, price) {
  const productListContainer = document.getElementById("product-list");

  const productDiv = document.createElement("div");
  productDiv.className = "product-list";

  const productNameSpan = document.createElement("span");
  productNameSpan.className = "content";
  productNameSpan.textContent = `${productName}: `;

  const quantityInput = document.createElement("input");
  quantityInput.setAttribute("type", "number");
  quantityInput.setAttribute("value", quantity);
  quantityInput.setAttribute("readonly", true);

  const priceInput = document.createElement("input");
  priceInput.setAttribute("type", "number");
  priceInput.setAttribute("value", price);

  const taxInput = document.createElement("input");
  taxInput.setAttribute("type", "number");
  taxInput.setAttribute("value", getTotalPrice(price));
  taxInput.setAttribute("readonly", true);

  priceInput.addEventListener("input", function () {
    const newPrice = parseFloat(priceInput.value);
    taxInput.value = getTotalPrice(newPrice);
  });

  productDiv.appendChild(productNameSpan);
  productDiv.appendChild(quantityInput);
  productDiv.appendChild(priceInput);
  productDiv.appendChild(taxInput);

  productListContainer.appendChild(productDiv);
}

function getTotalPrice(priceWOTax) {
  const taxRate = 0.19;
  const totalPrice = priceWOTax + priceWOTax * taxRate;
  return parseFloat(totalPrice.toFixed(2));
}

