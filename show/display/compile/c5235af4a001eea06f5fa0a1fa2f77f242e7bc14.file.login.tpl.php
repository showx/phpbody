<?php /* Smarty version Smarty-3.1.14, created on 2014-06-01 09:21:23
         compiled from "/Library/WebServer/Documents/phpg/phpbody/templates/default/admin/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:575523449538a8013bb8161-54313691%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5235af4a001eea06f5fa0a1fa2f77f242e7bc14' => 
    array (
      0 => '/Library/WebServer/Documents/phpg/phpbody/templates/default/admin/login.tpl',
      1 => 1392207517,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '575523449538a8013bb8161-54313691',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_538a8013bf55e3_08100906',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_538a8013bf55e3_08100906')) {function content_538a8013bf55e3_08100906($_smarty_tpl) {?><!DOCTYPE html>
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