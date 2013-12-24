<?php /* Smarty version Smarty-3.1.14, created on 2013-10-31 16:33:03
         compiled from "E:\workplace\showcms\show\display\templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8924527211eb71ec71-87591556%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d358e7b8532d46c8446fb80f11212e8712b9cd4' => 
    array (
      0 => 'E:\\workplace\\showcms\\show\\display\\templates\\login.tpl',
      1 => 1383208381,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8924527211eb71ec71-87591556',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_527211eb84ff43_49532838',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_527211eb84ff43_49532838')) {function content_527211eb84ff43_49532838($_smarty_tpl) {?><!DOCTYPE html>
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