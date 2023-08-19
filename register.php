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
  <div id="container">
    <div id="main">
      
      <form action="/register.php" method="POST">
          <p>this defo does nothing for now, until i can figure out server side shit. dont uh, hold yr breath? ask me and ill register you, your password will be password lmao</p>
          <p><label>username (a-z, 0-9, -, _, no commas or spaces or weird shit, 20 characters max):<br><input type="text" id="username" placeholder="cutie"/></label><?= "Hello World"?></p>
          <p><label>password (stored hashed on our server):<br><input type="password" placeholder="hunter2"></label></p>
          <input type="submit" id="confirmButton" value="register">
        </form>
      
    </div>
    <div include-html="/include/foot.html" id="foot"></div>
  </div>
<script>
  includeHTML();
</script>


<?php

$username = $_POST["username"];
$password = password_hash($_POST["password"]);

?>

</body>
</html>