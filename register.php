<?php
include "config.php";

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
  $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

  $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass' ")
    or die('query failed');

  if (mysqli_num_rows($select) > 0) {
    $message[] = 'user already exist!';
  } else {
    mysqli_query($conn, "INSERT INTO `user_form`(name, email, password) VALUES ('$name', '$email', '$pass')")
      or die('query failed');
    $message[] = 'register success!';
    header('location:login.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <?php
  if (isset($message)) {
    foreach ($message as $sms) {
      echo '<div class="message" onclick="this.remove();">' . $sms . '</div>';
    }
  }
  ?>

  <div class="form-container">
    <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" class="box" required placeholder="username..">
      <input type="email" name="email" class="box" required placeholder="email..">
      <input type="password" name="password" class="box" required placeholder="password">
      <input type="password" name="cpassword" class="box" required placeholder="confirm password">
      <input type="submit" name="submit" class="btn" value="register now">
      <p>already have an account ? <a href="login.php">login now</a></p>
    </form>
  </div>
</body>

</html>

<!-- md5(), mysqli_num_rows -->