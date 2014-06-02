<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>友情链接</title>
  </head>
<body>
<{if $edit=='ok'}>
<form method="post" name="tts" action="/index.php?c=ads&a=friendedit&onedit=1">
   <input type ="hidden" name="id" value="<{$result.id}>">
<{else}>
<form method="post" name="tts" action="/index.php?c=<{$c}>&a=<{$a}>">
<{/if}>

  标题：<input type="text" name="title" value='<{$result.title}>'/><br/>
  地址：<input type="text" name="url" value='<{$result.url}>'/><br/>
  <input type="submit" name="sub" value="新建"/>
</form>
</body>
</html>