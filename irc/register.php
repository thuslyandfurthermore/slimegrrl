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
  
  $usernameError = $passwordError = $error = "";
  $username = $password = "";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    if (empty($_POST["username"])) {
      
      $usernameError = "enter a username pls";
      
    } else {
      
      $username = test_input($_POST["username"]);
      
      if (!preg_match("/^[a-zA-Z0-9-_]*$/",$username)) {
        
        $usernameError = "a-z, 0-9, -, _ only";
        
      }
      else {
        
        $usernamePassed = true;
        
      }
    }
    
    if (empty($_POST["password"])) {
      
      $passwordError = "password is required";
      
    } else {
      
      $password = test_input($_POST["password"]);
      
      if (!preg_match("/^[a-zA-Z0-9-_]*$/",$password)) {
        
        $passwordError = "a-z, 0-9, -, _ only";
        
      } else {
        
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $passwordpassed = true;
        
      }
    }
    
    if ($usernamePassed && $passwordpassed) {
      
      if (file_exists("/etc/thelounge/users/$username.json")) {
        $error = "user already exists!!";
      }
      
      if (!$file = fopen("/etc/thelounge/users/$username.json", 'x')) {
        
        $error = "failed to open file!!";
        
      } else {
        
        fwrite($file, "{\r\n       \"password\":\"$hash\",\r\n        \"log\": true\r\n}");
        fclose($file);
        mail('emily@slimegrrl.life', 'acct created', 'made an account for' . $username);
        $error = "successfully registered!!";
        
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
      
      <form action="/irc/register.php" method="post">
        <p><?php echo $error ?></p>
          <p>
            <label>username (a-z, 0-9, -, _, no &lt;&gt; or spaces or weird shit, 50 characters max):<br><input type="text" name="username" placeholder="cutie" maxlength="50">
              <?php echo $usernameError ?>
            </label>
          </p>
          <p>
            <label>password (same restrictions as username, stored hashed on our server):<br><input type="password" placeholder="hunter2" name="password" maxlength="50">
              <?php echo $passwordError ?>
            </label>
          </p>
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