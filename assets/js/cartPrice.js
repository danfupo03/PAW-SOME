document.addEventListener("DOMContentLoaded", () => {
  const quantityInputs = document.querySelectorAll(".quantity-input");

  quantityInputs.forEach((input) => {
    input.addEventListener("input", () => {
      const pricePerUnit = parseFloat(input.getAttribute("data-price"));
      const quantity = parseInt(input.value);
      const totalPrice = (pricePerUnit * quantity).toFixed(2);

      const totalPriceElement = input
        .closest(".shopping-cart-content")
        .querySelector(".total-price");
      totalPriceElement.textContent = totalPrice;
    });
  });
});
