<!DOCTYPE html>

<html>
<head>
  <meta http-equiv="CONTENT-TYPE" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/styles/style.css"/>
  <title>title</title>
  <script src="/scripts/include.js"></script>
</head>
<body>
  

  <?php
  // define variables and set to empty values
  $usernameError = $passwordError = "";
  $username = $password = "";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
      $usernameError = "enter a username pls";
    } else {
      $username = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z0-9-_]*$/",$username)) {
        $usernameError = "a-z, 0-9, -, _ only";
      }
    }
    
    if (empty($_POST["email"])) {
      $passwordError = "Email is required";
    } else {
      $password = test_input($_POST["password"]);
      // check if e-mail address is well-formed
      if (!preg_match("/^[a-zA-Z0-9-_]*$/",$password)) {
        $passwordError = "Invalid email format";
      }
    }
  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
  
  
  
  <div id="container">
    <div id="main">
      
      <p>this defo does nothing for now, until i can figure out server side shit. dont uh, hold yr breath? ask me and ill register you, your password will be password lmao</p>
      
      <p>pls refrain from pentesting my server its v fragile rn lol</p>
      
      <form action="/register.php" method="POST">
          <p><label>username (a-z, 0-9, -, _, no &lt; or spaces or weird shit, 20 characters max):<br><input type="text" id="username" placeholder="cutie" value="<?php echo $username; ?>"><?php echo $usernameError; ?></label></p>
          <p><label>password (stored hashed on our server):<br><input type="password" placeholder="hunter2" value="<?php echo $password; ?>"><?php echo $passwordError; ?></label></p>
          <input type="submit" id="confirmButton" value="register">
        </form>
      
    </div>
    <div include-html="/include/foot.html" id="foot"></div>
  </div>
<script>
  includeHTML();
</script>

</body>
</html>