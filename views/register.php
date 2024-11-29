<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paw-Some &#128054;</title>
    <link rel="icon" href="/assets/images/favicon.ico" />

    <!-- Font Awesome -->
    <script
      src="https://kit.fontawesome.com/87b5cb0a2b.js"
      crossorigin="anonymous"
    ></script>

    <!-- Stylesheet -->
    <link defer rel="stylesheet" href="../assets/css/styles.css" />
    <link defer rel="stylesheet" href="../assets/css/variables.css" />
  </head>
  <body class="body">
    <div class="mt-3">
      <a class="button is-dark ml-1" onclick="darkMode()" id="dark-mode"
        ><i class="fa-solid fa-moon"></i
      ></a>
    </div>
    <section>
      <div class="container">
        <div class="form mt-5">
          <h1 class="title is-3">Join Paw-Some &#128054;</h1>
          <p class="content">Create an account to start exploring!</p>
          <form action="" method="GET" id="registerForm">
            <label for="username">Username</label>
            <input type="text" placeholder="JohnDoe03" required id="username" />
            <span id="usernameError" style="color: red; display: none"
              >The username must contain at least 5 characters and at least one
              capital letter and one lower case letter</span
            >

            <label for="password">Password</label>
            <input type="text" placeholder="password" id="password" required />
            <span id="passwordError"
              >The password must be at least 10 characters long</span
            >

            <label for="confirmPassword">Confirm Password</label>
            <input type="text" required id="confirmPassword" />
            <span id="confirmPasswordError" style="color: red; display: none"
              >The password does not match</span
            >

            <button class="button is-secondary" type="submit">
              Create account
            </button>
          </form>

          <div class="mb-3">
            <h1 class="title is-5">Already an account?</h1>
            <a class="button is-dark" href="login.html">Login</a>
          </div>
        </div>
      </div>
    </section>
    <script src="../assets/js/register.js"></script>
  </body>
</html>
