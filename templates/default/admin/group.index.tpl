<!DOCTYPE html>
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
      <{foreach from=$group item=item}>
       <tr>
        <td><{$item.groupid}></td>
        <td><{$item.groupname}></td>
        <td><a href="?c=admin&a=setting&id=<{$item.groupid}>">设置权限</a></td>
        <td><a href="?c=admin&a=del&id=<{$item.groupid}>">删除该组和组下成员</a></td>
       </tr>
      <{/foreach}>
    </table>
  	</div>
  </body>
</html>
