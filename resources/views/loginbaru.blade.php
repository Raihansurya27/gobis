<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="{{asset('css/style_login1.css')}}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>GO-BIS</title>
</head>
<body>
  <div class="navbar">
    <input type="checkbox" name="" value="" id="check">
    <label for="check">
      <i class="material-icons" id="dehaze">dehaze</i>
      <i class="material-icons" id="close">close</i>
    </label>
    <div class="logo">
      <h2>Go-Bis</h2>
    </div>
    <div class="nav">
      <ul>
        <li> <a href="#">Home</a></li>
        <li> <a href="#">Bis</a></li>
        <li> <a href="#">Kontak</a></li>
        <li> <a href="#">Tentang Kami</a></li>
        <li> <a href="register.php" >Register</a></li>
        <li> <a href="#"class="active">Login</a></li>
      </ul>
    </div>
  </div>
  <!-- login -->
  <div class="grid-container">
    <div class="title">
      <h2>Log in</h2>
    </div>
    <div class="col-1">
      <img src="bus.jpg" alt="">
    </div>
    <div class="col-2">
      <form class="" action="index.html" method="post">
        <div class="create-account">
          <p>Don't have an account ? <a href="#">Create an account</a> </p>
        </div>
        <div class="kontent">
          <div class="col-25">
            <p>Username</p>
          </div>
          <div class="col-75">
            <input type="text" name="" value="" placeholder="Username">
          </div>
        </div>
        <div class="kontent">
          <div class="col-25">
            <p>Password</p>
          </div>
          <div class="col-75">
            <input type="password" name="" value="" placeholder="Password">
          </div>
        </div>
        <div class="forgot-password">
          <a href="#">Forgot your password ?</a>
        </div>
        <div class="daftar">
          <button type="button" name="button">Login</button>
        </div>
      </form>
    </div>

  </div>
  <br>
</body>
</html>
