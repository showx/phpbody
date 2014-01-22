<?php /* Smarty version Smarty-3.1.14, created on 2014-01-22 21:38:18
         compiled from "/Library/WebServer/Documents/phpg/phpbody/show/display/templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170946756352dfc9cad05ce3-63139259%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7db59946a68727a2e19aab1a1b67c2321c57100' => 
    array (
      0 => '/Library/WebServer/Documents/phpg/phpbody/show/display/templates/login.tpl',
      1 => 1388933020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170946756352dfc9cad05ce3-63139259',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52dfc9cad30b34_07052015',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52dfc9cad30b34_07052015')) {function content_52dfc9cad30b34_07052015($_smarty_tpl) {?><!DOCTYPE html>
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