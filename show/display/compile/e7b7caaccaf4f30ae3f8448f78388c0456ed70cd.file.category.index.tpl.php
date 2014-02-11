<?php /* Smarty version Smarty-3.1.14, created on 2014-02-09 21:41:46
         compiled from "/Library/WebServer/Documents/phpg/phpbody/show/display/templates/category.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:70058491052f767e9004e12-81793242%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7b7caaccaf4f30ae3f8448f78388c0456ed70cd' => 
    array (
      0 => '/Library/WebServer/Documents/phpg/phpbody/show/display/templates/category.index.tpl',
      1 => 1391953304,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70058491052f767e9004e12-81793242',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52f767e902dae9_80335707',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52f767e902dae9_80335707')) {function content_52f767e902dae9_80335707($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>查看栏目</title>
    <link rel="stylesheet" type="text/css" href="/static/js/treeview/jquery.treeview.css"/>
    <script type="text/javascript" src="/static/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/static/js/treeview/jquery.treeview.js"></script>
  </head>
  <body>
  	<div id="wrapper">
  		<div id="left">
  		</div>
  		<div id="content">
  			<ul id="navigation">
          <li><a href="?1">Item 1</a>
            <ul>
              <li><a href="?1.0">Item 1.0</a>
                <ul>
                  <li><a href="&aa=dd">Item 1.0.0</a></li>
                </ul>
              </li>
              <li><a href="?1.1">Item 1.1</a></li>
              <li><a href="?1.2">Item 1.2</a>
                <ul>
                  <li><a href="?1.2.0">Item 1.2.0</a>
                  <ul>
                    <li><a href="?1.2.0.0">Item 1.2.0.0</a></li>
                    <li><a href="?1.2.0.1">Item 1.2.0.1</a></li>
                    <li><a href="?1.2.0.2">Item 1.2.0.2</a></li>
                  </ul>
                </li>
                  <li><a href="?1.2.1">Item 1.2.1</a>
                  <ul>
                    <li><a href="?1.2.1.0">Item 1.2.1.0</a></li>
                  </ul>
                </li>
                  <li><a href="?1.2.2">Item 1.2.2</a>
                  <ul>
                    <li><a href="?1.2.2.0">Item 1.2.2.0</a></li>
                    <li><a href="?1.2.2.1">Item 1.2.2.1</a></li>
                    <li><a href="?1.2.2.2">Item 1.2.2.2</a></li>
                  </ul>
                </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
        <script language="javascript">
        $(document).ready(function(){
        $("#navigation").treeview({
          persist: "location",
          collapsed: true,
          unique: true
        });
      });
        </script>
  		</div>
  	</div>
  </body>
</html>
<?php }} ?>