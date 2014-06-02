<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>文章管理</title>
  </head>
<body>
<table>
	<td>标题</td><td>编辑</td><td>删除</td>
<{if $result}>
<{foreach from=$result item=item}>
	<tr>
		<td><{$item.title}></td><td><a href='/?c=ads&a=friendedit&id=<{$item.id}>'>编辑</a></td><td><a href='/?c=ads&a=frienddel&id=<{$item.id}>'>删除</a></td>
	</tr>
<{/foreach}>
<{/if}>
</table>
<a href="/?c=ads&a=friendadd">添加</a>
</body>
</html>