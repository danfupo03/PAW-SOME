document.addEventListener("DOMContentLoaded", () => {
  const quantityInputs = document.querySelectorAll(".quantity-input");
  const subtotalElement = document.getElementById("subtotal");
  const taxesElement = document.getElementById("taxes");
  const grandTotalElement = document.getElementById("grand-total");
  const TAX_RATE = 0.19;

  const calculateCartTotals = () => {
    let subtotal = 0;

    quantityInputs.forEach((input) => {
      const pricePerUnit = parseFloat(input.getAttribute("data-price"));
      const quantity = parseInt(input.value) || 0;
      const totalPrice = (pricePerUnit * quantity).toFixed(2);

      const totalPriceElement = input
        .closest(".shopping-cart-content")
        .querySelector(".total-price");
      totalPriceElement.textContent = totalPrice;

      subtotal += parseFloat(totalPrice);
    });

    const taxes = (subtotal * TAX_RATE).toFixed(2);
    const grandTotal = (subtotal + parseFloat(taxes)).toFixed(2);

    subtotalElement.textContent = subtotal.toFixed(2);
    taxesElement.textContent = taxes;
    grandTotalElement.textContent = grandTotal;
  };

  quantityInputs.forEach((input) => {
    input.addEventListener("input", calculateCartTotals);
  });

  calculateCartTotals();
});
