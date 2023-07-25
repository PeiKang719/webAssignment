<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="headerStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  </head>
  
  <body>
    <nav>
      <?php
      session_start();
    $adminID = $_SESSION['adminID'];
    ?>
  <label class="logo">
    <a href="adminBio.php">MyBio</a>
  </label>
  <ul>
    <li><a href="adminLogin.php">Log Out</a></li>   
  </ul>
</nav>

  </body>
</html>