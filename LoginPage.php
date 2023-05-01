<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="LoginStyle.css">
  </head>
  <body>
    <form action="LoginPage_connect.php" method="POST" id="login-form">
      <h1>Sign into UniForum</h1>
      <label for="username">Username:</label>
      <input type="varchar" size="16" id="username" name="Username">
      <label for="password">Password:</label>
      <input type="password" size="16" id="password" name="Password">
<!--      <input type="submit" value="Login">-->
        <a href="Welcome.php"><button type="submit" class="">Login</button></a>
        <div>
            <a href="">Forget Password?</a>
        </div>
      <!-- <div class="error">Incorrect username or password.</div> -->
    </form>
  </body>
</html>

