function changeBorderColor(inputElement, isValid, errorElement) {
  if (isValid) {
    inputElement.style.borderColor = "green";
    errorElement.style.display = "none";
  } else {
    inputElement.style.borderColor = "red";
    errorElement.style.display = "block";
  }
}

username = document.getElementById("username");
password = document.getElementById("password");

username.addEventListener("input", function () {
  let isValidUsername =
    /^(?=.*[a-z])(?=.*[A-Z])/.test(username.value) &&
    username.value.length >= 5;
  changeBorderColor(
    username,
    isValidUsername,
    document.getElementById("usernameError")
  );
});

password.addEventListener("input", function () {
  changeBorderColor(
    password,
    password.value.length >= 10,
    document.getElementById("passwordError")
  );
});

document
  .getElementById("customerForm")
  .addEventListener("submit", function (event) {
    let isValidUsername =
      username.value.length >= 5 &&
      /^(?=.*[a-z])(?=.*[A-Z])/.test(username.value);
    let isValidPassword = password.value.length >= 10;

    if (!isValidUsername || !isValidPassword) {
      event.preventDefault();
      alert("Form is not valid");
    } else {
      alert("Profile updated successfully");
    }
  });
