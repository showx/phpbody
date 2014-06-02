<?php /* Smarty version Smarty-3.1.14, created on 2014-06-01 10:04:30
         compiled from "/Library/WebServer/Documents/phpg/phpbody/templates/default/admin/group.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:276265698538a81ab105316-81517216%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a1af1a650de6325178c8cc3b8b732743c0b7620' => 
    array (
      0 => '/Library/WebServer/Documents/phpg/phpbody/templates/default/admin/group.index.tpl',
      1 => 1394024689,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '276265698538a81ab105316-81517216',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_538a81ab1404c6_77336271',
  'variables' => 
  array (
    'group' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_538a81ab1404c6_77336271')) {function content_538a81ab1404c6_77336271($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>组管理</title>
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
    <table>
      <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['group']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
       <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['groupid'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['groupname'];?>
</td>
        <td><a href="?c=admin&a=setting&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['groupid'];?>
">设置权限</a></td>
        <td><a href="?c=admin&a=del&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['groupid'];?>
">删除该组和组下成员</a></td>
       </tr>
      <?php } ?>
    </table>
  	</div>
  </body>
</html>
<?php }} ?>