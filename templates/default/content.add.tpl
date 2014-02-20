<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>新建文章</title>
    <link rel="stylesheet" type="text/css" href="/static/js/kindeditor/themes/default/default.css"/>
  </head>
<body>
<form method="post" name="tts" action="/index.php?c=<{$c}>&a=padd">
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
</html>