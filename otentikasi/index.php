<?php

session_start();

  if (isset($_SESSION['ssLoginRM'])) {
    header("location: ../index.php");
    exit();
}

require "../config.php";
?>


<!doctype html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.84.0">
      <title>Login - SIMKES</title>

      <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

      <link rel="icon" type="image/x-icon" href="<?= $main_url ?>asset/gambar/app-icon.png">
      

      <!-- Bootstrap core CSS -->
  <link href="<?= $main_url ?>asset/dist/css/bootstrap.min.css" rel="stylesheet">

      <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }

        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }

        #bg-login{
          background-image: url(../asset/gambar/sekolah.png);
          background-size: cover;
          background-position: center center;
        }
      </style>

      
      <!-- Custom styles for this template -->
      <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center" id="bg-login">
    
  <main class="form-signin">
    <form action="proses-login.php" method="post">
        <img class="mb-4" src="<?= $main_url ?>asset/gambar/app-icon.png" alt="" width="72" height="57">
        <h1 class="h3 mb-4 fw-normal text-white">Sistem Kesehatan Sekolah</h1>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="username" name="username" required>
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
          <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary mt-2" type="submit" name="login">Sign in</button>
        <p class="mt-5 mb-3 text-white">&copy; 2024 All Rights Reserved</p>
    </form>
  </main>

<script src="<?= $main_url ?>asset/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
