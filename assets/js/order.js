function toggleMessageInput() {
  const stateSelect = document.getElementById("state");
  const messageInput = document.getElementById("message-order");

  if (stateSelect.value === "rejected") {
    messageInput.style.display = "block";
  } else {
    messageInput.style.display = "none";
    messageInput.value = "";
  }
}

document.addEventListener("DOMContentLoaded", toggleMessageInput);
