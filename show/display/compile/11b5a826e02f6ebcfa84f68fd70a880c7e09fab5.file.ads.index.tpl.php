<?php /* Smarty version Smarty-3.1.14, created on 2014-06-01 09:28:04
         compiled from "/Library/WebServer/Documents/phpg/phpbody/templates/default/admin/ads.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:858104923538a81a4093a06-78523394%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11b5a826e02f6ebcfa84f68fd70a880c7e09fab5' => 
    array (
      0 => '/Library/WebServer/Documents/phpg/phpbody/templates/default/admin/ads.index.tpl',
      1 => 1394975792,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '858104923538a81a4093a06-78523394',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'result' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_538a81a40d4202_01358138',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_538a81a40d4202_01358138')) {function content_538a81a40d4202_01358138($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>文章管理</title>
  </head>
<body>
<table>
	<td>标题</td><td>编辑</td><td>删除</td>
<?php if ($_smarty_tpl->tpl_vars['result']->value){?>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</td><td><a href='/?c=ads&a=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'>编辑</a></td><td><a href='/?c=ads&a=del&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'>删除</a></td>
	</tr>
<?php } ?>
<?php }?>
</table>
<a href="/?c=ads&a=gen">生成js</a><br/>
<a href="/?c=ads&a=add">添加</a>
</body>
</html><?php }} ?>