<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:index.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <img src="0.webp">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <p>Your Name<sup>*</sup></p>
      <input type="text" name="name" required placeholder="enter your name">
      <p>Your Email<sup>*</sup></p>
      <input type="email" name="email" required placeholder="enter your email">
      <p>Password<sup>*</sup></p>
      <input type="password" name="password" required placeholder="enter your password">
      <p>Confirm Password<sup>*</sup></p>
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <p>User Type<sup>*</sup></p>
      <select name="user_type">
         <option value="user">Mentee | Full Stack Developer</option>
         <option value="user">Mentee | UI & UX Designer</option>
         <option value="user">Mentee | Front-End & Back-End Developer</option>
         <option value="admin">Mentor | Full Stack Developer</option>
         <option value="admin">Mentor | UI & UX Designer</option>
         <option value="admin">Mentor | Front-End & Back-End Developer</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>Already have an account? <a href="index.php">login now</a></p>
   </form>

</div>

</body>
</html>