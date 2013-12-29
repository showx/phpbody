<?php /* Smarty version Smarty-3.1.14, created on 2013-12-28 16:47:49
         compiled from "/Library/WebServer/Documents/phpg/show/display/templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:156027554752be903517e6d5-79336010%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '344e2e5660e230347c078cf10a0c0b57d740b797' => 
    array (
      0 => '/Library/WebServer/Documents/phpg/show/display/templates/login.tpl',
      1 => 1383208380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '156027554752be903517e6d5-79336010',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52be90351a8fd6_35902541',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52be90351a8fd6_35902541')) {function content_52be90351a8fd6_35902541($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="static/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

        <form class="form-signin" action="">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="hidden" name="c" value="admin"/>
        <input type="hidden" name="a" value="login"/>
        <input type="text" class="form-control" name="name" placeholder="Email address" autofocus>
        <input type="password" class="form-control" name="pass" placeholder="Password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
  </body>
</html><?php }} ?>