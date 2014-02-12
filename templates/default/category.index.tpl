<!DOCTYPE html>
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
