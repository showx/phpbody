<?php /* Smarty version Smarty-3.1.14, created on 2014-02-09 21:01:23
         compiled from "/Library/WebServer/Documents/phpg/phpbody/show/display/templates/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:143231002052f767e353fdb1-13181461%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '61244741e6e6df352e9fcdb88b39018afc065920' => 
    array (
      0 => '/Library/WebServer/Documents/phpg/phpbody/show/display/templates/admin.tpl',
      1 => 1391950880,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143231002052f767e353fdb1-13181461',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52f767e3581e71_26049415',
  'variables' => 
  array (
    'name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52f767e3581e71_26049415')) {function content_52f767e3581e71_26049415($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>管理后台</title>

    <link href="/static/css/bootstrap.css" rel="stylesheet">

    <link href="/static/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/font-awesome/css/font-awesome.min.css">
  </head>
  <body>
    <div id="wrapper">
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">管理后台</a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i>首页</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>栏目管理<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a target="pwrapper" href="?c=category&a=index">查看栏目</a></li>
                <li><a href="#">新建栏目</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>文章管理<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a target="pwrapper" href="?c=content&a=index">查看文章</a></li>
                <li><a href="#">新建文章</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-gear"></i>设置</a></li>
                <li class="divider"></li>
                <li><a href="?c=admin&a=logout"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">
        <iframe id="pwrapper" name="pwrapper" width="1000px" height="800px" frameborder="0" src=""></iframe>
      </div>
    </div> <!-- wrapper-->

    <!-- JavaScript -->
    <script src="/static/js/jquery-1.7.2.min.js"></script>
    <script src="/static/js/bootstrap.js"></script>

    <script src="/static/js/tablesorter/jquery.tablesorter.js"></script>
    <script src="/static/js/tablesorter/tables.js"></script>

  </body>
</html>
<?php }} ?>