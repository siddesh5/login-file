<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){
    
   $email = mysqli_real_escape_string($conn, $_POST['usermail']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $name = mysqli_real_escape_string($conn, $_POST['fname']);
   $city = mysqli_real_escape_string($conn, $_POST['city']);

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'user already exist';
   }else{
      if($pass != $cpass){
         $error[] = 'password not mathched!';
      }else{
         $insert = "INSERT INTO user_form(email, password, name, city ) VALUES('$email','$pass','$name','$city')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="form-container">

   <form action="" method="post">
      <h3 class="title">Responsive Rgistration Form</h3>
      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
      <input type="email" name="usermail" placeholder="enter your email"class="box" >
      <input type="password" name="password" placeholder="enter your password" class="box" required>
      <input type="password" name="cpassword" placeholder="confirm your password" class="box" required>
      <input type="name" name="fname" placeholder="enter your name"class="box" >
      <select name="city" class="box">
    <option value="pune">Pune</option>
    <option value="Mumbai">Mumbai</option>
    <option value="nashik">nashik</option>
    <option value="nagpur">Nagpur</option>
  </select>




      <input type="submit" value="register now" class="form-btn" name="submit">
       <p>If you already have an account, please <a href="login_form.php">login</a></p>
   </form>

</div>

</body>
</html>