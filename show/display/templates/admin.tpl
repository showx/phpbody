<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

    <link href="static/css/bootstrap.css" rel="stylesheet">
    <link href="signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

        <form class="form-signin" action="">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="hidden" name="c" value="admin"/>
        <input type="hidden" name="a" value="login"/>
        <input type="text" class="form-control" name="name" placeholder="Email address" autofocus>
        <input type="password" class="form-control" name="pass" placeholder="Password">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
  </body>
</html>