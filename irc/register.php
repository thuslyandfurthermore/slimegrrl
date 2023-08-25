<!DOCTYPE html>

<html>
<head>
  <meta http-equiv="CONTENT-TYPE" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/styles/style.css"/>
  <title>register for the lounge</title>
  <script src="/scripts/hilite.js"></script>
</head>
<body>


  <?php
  
  $usernameError = $passwordError = $passmatch = $error = "";
  $username = $password = "";
  
  
  //dont run on normal open
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
        
        if ($password != $_POST[password2]) {
          
          $passmatch = "passwords must match";
          
        } else {
        
          $hash = password_hash($password, PASSWORD_BCRYPT);
          $passwordpassed = true;
        
        }
      }
    }
    
    if ($usernamePassed && $passwordpassed) {
      
      if (file_exists("/etc/thelounge/users/$username.json")) {
        
        $error = "<h2 class=\"error\">user already exists!!</h2>";
        
        
      } elseif (!$file = fopen("/etc/thelounge/users/$username.json", 'x')) {
        
        $error = "<h2 class=\"error\">failed to open file!!</h2>";
        
      } else {
        
        fwrite($file, "{\r\n       \"password\":\"$hash\",\r\n        \"log\": true\r\n}");
        fclose($file);
          
        if (mail('root', 'acct created', "made an account for $username")) {
            
          $error = "<h2 class=\"success\">successfully registered!!</h2>";
            
        } else {
            
          $error = "<h2 class=\"success\">registration worked but mail failed</h2>";
        }
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
        <?php echo $error ?>

            <label>username (a-z, 0-9, -, _, no &lt;&gt; or spaces or weird shit, 50 characters max):<br><input type="text" name="username" placeholder="cutie" maxlength="50">
              <span class="error"><?php echo $usernameError ?></span>
            </label><br><br>


            <label>password (same restrictions as username, stored hashed on our server):<br><input type="password" placeholder="hunter2" name="password" maxlength="50">
              <span class="error"><?php echo $passwordError ?></span>
            </label><br><br>


            <label>re-enter password:<br>
              <input type="password" name="password2" maxlength="50"><span class="error"><?php echo $passmatch ?></span>
            </label><br><br>
 
          <input type="submit" id="confirmButton" value="register"><br>
        </form>
        
        <p class="emily">there are restrictions on what you can put in the password on this form, because im incompetent and idk how the escaping or whatever will interact with the lounge's escaping? but you can change it l8r through the lounge's interface</p>
      
    </div>
    <div id="foot"><?php require '/include/foot.php'; ?></div>
  </div>
<script>
  addCurrentTab();
</script>

</body>
</html>