<?php

$is_invalid = false;

if($_SERVER["REQUEST_METHOD"]=== "POST"){
    $mysqli= require __DIR__."/database.php";

    $sql= sprintf("SELECT * FROM user
          WHERE email= '%s'",
          $mysqli->real_escape_string($_POST["email"]));

          $result = $mysqli->query($sql);

          $user = $result->fetch_assoc();
      
          if ($user) {
      
              if (password_verify($_POST["password"], $user["password_hash"])) {
      
                  session_start();
      
                  session_regenerate_id();
      
                  $_SESSION["user_id"] = $user["id"];
      
                  header("Location: index.php");
                  exit;
              }
          }
      
          $is_invalid = true;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="log.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="post">
    <div class="border">
        <div>
            <h1>Log In</h1> 
        </div>
       
        <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>

        <div>
            <input type="text" placeholder="Email Id"  name="email" id="email" >
        </div>
        
        <div>
            <input type="password" placeholder="Password" name="password" id="password" >    
        </div>
        <div>
            <button>Log In</button>
        </div>
    </form>
</body>
</html>