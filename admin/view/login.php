<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="public/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>FGShop</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

  <link rel="stylesheet" type="text/css" href="public/assets/css/login.css">

</head>

<body>
  <div class="wrapper">

    <div class="login_box">

      <div class="login_header">
        <h1>FGShop</h1>
        Login below!
      </div>
      <div class="first" id="first">
        <!-- Login form -->
        <form action="#" method="POST">
          <input type="hidden" name="controller" value="user">
          <input type="hidden" name="action" value="login">
          <input type="text" name="log_username" placeholder="Username" value="" required>
          <br>
          <input type="password" name="log_pass" placeholder="Password" required>
          <br>
          <input type="submit" name="log_button" value="Login">
          <br>
        </form>
      </div>
    </div>

  </div>

</body>

</html>
