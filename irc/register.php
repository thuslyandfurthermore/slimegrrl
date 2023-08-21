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
        
        $usernameError = "invalid username";
        
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
        
        $passwordError = "invalid password";
        
      } else {
        
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $passwordpassed = true;
        
      }
    }
    
    if ($usernamePassed && $passwordpassed) {
      
      if (file_exists("/etc/thelounge/users/$username.json")) {
        $error = "<span class=\"error\">user already exists!!</span>";
      }
      
      if (!$file = fopen("/etc/thelounge/users/$username.json", 'x')) {
        
        $error = "<span class=\"error\">failed to open file!!</span>";
        
      } else {
        
        fwrite($file, "{\r\n       \"password\":\"$hash\",\r\n        \"log\": true\r\n}");
        fclose($file);
        mail('emily@slimegrrl.life', 'acct created', 'made an account for' . $username);
        $error = "<span class=\"success\">successfully registered!!</span>";
        
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
      
      <h2>register for the lounge irc</h2>
      <p class="emily">i fuckin did it you can register for the lounge now!!!</p>
      
      <p>pls refrain from pentesting our server its v fragile rn lol</p>
      
      <form action="/irc/register.php" method="post">
        <p><?php echo $error ?></p>
          <p>
            <label>username (a-z, 0-9, -, _, no &lt;&gt; or spaces or weird shit, 50 characters max):<br><input type="text" name="username" placeholder="cutie" maxlength="50">
              <span class="error"><?php echo $usernameError ?></span>
            </label>
          </p>
          <p>
            <label>password (same restrictions as username, stored hashed on our server):<br><input type="password" placeholder="hunter2" name="password" maxlength="50">
              <span class="error"><?php echo $passwordError ?></span>
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