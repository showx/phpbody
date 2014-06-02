<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>新建文章</title>
    <link rel="stylesheet" type="text/css" href="/static/js/kindeditor/themes/default/default.css"/>
  </head>
<body>
<{if $edit=='ok'}>
<form method="post" name="tts" action="/index.php?c=ads&a=edit&onedit=1">
   <input type ="hidden" name="id" value="<{$result.id}>">
<{else}>
<form method="post" name="tts" action="/index.php?c=<{$c}>&a=padd">
<{/if}>

  标题：<input type="text" name="title" value='<{$result.title}>'/><br/>
  内容：<textarea id="editor_id" name="content" style="width:700px;height:300px;">
  <{$result.content}>
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
</html>