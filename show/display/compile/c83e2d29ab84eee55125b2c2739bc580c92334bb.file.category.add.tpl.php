<?php /* Smarty version Smarty-3.1.14, created on 2014-06-01 10:04:27
         compiled from "/Library/WebServer/Documents/phpg/phpbody/templates/default/admin/category.add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2025059309538a8a2bc6f2d8-95032234%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c83e2d29ab84eee55125b2c2739bc580c92334bb' => 
    array (
      0 => '/Library/WebServer/Documents/phpg/phpbody/templates/default/admin/category.add.tpl',
      1 => 1394024689,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2025059309538a8a2bc6f2d8-95032234',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_538a8a2bc72e47_01579996',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_538a8a2bc72e47_01579996')) {function content_538a8a2bc72e47_01579996($_smarty_tpl) {?><form method="post" action="/index.php?c=<?php echo $_smarty_tpl->tpl_vars['c']->value;?>
&a=add">
  栏目名:<input type="text" name="name"/>
  parentid:<input type="text" name="parentid"/>
  <input type="submit" name="sub" value="新建"/>
</form><?php }} ?>