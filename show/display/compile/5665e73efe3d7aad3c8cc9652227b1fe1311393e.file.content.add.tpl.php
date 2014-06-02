<?php /* Smarty version Smarty-3.1.14, created on 2014-06-01 09:21:39
         compiled from "/Library/WebServer/Documents/phpg/phpbody/templates/default/admin/content.add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1006312667538a802387d753-34770738%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5665e73efe3d7aad3c8cc9652227b1fe1311393e' => 
    array (
      0 => '/Library/WebServer/Documents/phpg/phpbody/templates/default/admin/content.add.tpl',
      1 => 1392905999,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1006312667538a802387d753-34770738',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_538a80238ac5b4_96923363',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_538a80238ac5b4_96923363')) {function content_538a80238ac5b4_96923363($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>新建文章</title>
    <link rel="stylesheet" type="text/css" href="/static/js/kindeditor/themes/default/default.css"/>
  </head>
<body>
<form method="post" name="tts" action="/index.php?c=<?php echo $_smarty_tpl->tpl_vars['c']->value;?>
&a=padd">
  栏目：<input type="text" name="categoryid"/><br/>
  标题：<input type="text" name="title"/><br/>
  标签：<input type="text" name="tags"/><br/>
  内容：<textarea id="editor_id" name="content" style="width:700px;height:300px;">
  在这里输入文字。。。
</textarea>
<script type="text/javascript" src="/static/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/static/js/kindeditor/kindeditor-all.js"></script>
<script>
    KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
</script>
  <input type="submit" name="sub" value="新建"/>
</form>
</body>
</html><?php }} ?>