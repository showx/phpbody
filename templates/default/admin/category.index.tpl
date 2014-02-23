<!DOCTYPE html>
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
         <{$menu}>
        </ul>
        <script language="javascript">
        
        </script>
  		</div>
        <{include file="admin/category.add.tpl"}>
  	</div>
  </body>
</html>
