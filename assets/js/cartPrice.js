document.addEventListener("DOMContentLoaded", () => {
  const quantityInputs = document.querySelectorAll(".quantity-input");
  const subtotalElement = document.getElementById("subtotal");
  const taxesElement = document.getElementById("taxes");
  const grandTotalElement = document.getElementById("grand-total");
  const discountElement = document.getElementById("discount");
  const discountRate = document.getElementById("discount-rate").textContent;
  const TAX_RATE = 0.19;

  const calculateCartTotals = () => {
    let subtotal = 0;

    quantityInputs.forEach((input) => {
      const pricePerUnit = parseFloat(input.getAttribute("data-price"));
      const quantity = parseInt(input.value);
      const totalPrice = (pricePerUnit * quantity).toFixed(2);

      subtotal += parseFloat(totalPrice);
    });

    let taxes = 0;
    let grandTotal = 0;
    let discount = 0;
    let printDiscount = 0;
    let subtotalAfterDiscount = 0;

    if (discountRate > 0) {
      discount = subtotal * (discountRate/100);
      printDiscount = subtotal - discount;
      subtotalAfterDiscount = subtotal - discount;
      taxes = (subtotalAfterDiscount * TAX_RATE).toFixed(2);
      grandTotal = subtotalAfterDiscount + parseFloat(taxes);

      subtotalElement.textContent = subtotal.toFixed(2);
      discountElement.textContent = printDiscount.toFixed(2);
      taxesElement.textContent = taxes;
      grandTotalElement.textContent = grandTotal.toFixed(2);
    } else {

      taxes = (subtotal * TAX_RATE).toFixed(2);
      grandTotal = subtotal + parseFloat(taxes);

      subtotalElement.textContent = subtotal.toFixed(2);
      taxesElement.textContent = taxes;
      grandTotalElement.textContent = grandTotal.toFixed(2);
    }
  };

  quantityInputs.forEach((input) => {
    input.addEventListener("input", calculateCartTotals);
  });

  calculateCartTotals();
});
