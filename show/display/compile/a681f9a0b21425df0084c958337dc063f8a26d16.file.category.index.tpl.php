<?php /* Smarty version Smarty-3.1.14, created on 2014-06-01 10:04:27
         compiled from "/Library/WebServer/Documents/phpg/phpbody/templates/default/admin/category.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1480038195538a898791dec1-82356434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a681f9a0b21425df0084c958337dc063f8a26d16' => 
    array (
      0 => '/Library/WebServer/Documents/phpg/phpbody/templates/default/admin/category.index.tpl',
      1 => 1401588265,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1480038195538a898791dec1-82356434',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_538a89879515f5_38037597',
  'variables' => 
  array (
    'menu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_538a89879515f5_38037597')) {function content_538a89879515f5_38037597($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>查看栏目</title>
    <link rel="stylesheet" type="text/css" href="/static/js/treeview/jquery.treeview.css"/>
    <script type="text/javascript" src="/static/jsdev/labjs/LAB.js"></script>
    <script>
      $LAB
      .script("/static/js/jquery-1.7.2.min.js").wait()
      .script("/static/js/treeview/jquery.treeview.js")
      .script("/static/pagejs/lab1.js");
    </script>
  
  </head>
  <body>
  	<div id="wrapper">
  		<div id="left">
  		</div>
  		<div id="content">
  			<ul id="navigation">
         <?php echo $_smarty_tpl->tpl_vars['menu']->value;?>

        </ul>
        <script language="javascript">
        
        </script>
  		</div>
        <?php echo $_smarty_tpl->getSubTemplate ("category.add.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  	</div>
  </body>
</html>
<?php }} ?>