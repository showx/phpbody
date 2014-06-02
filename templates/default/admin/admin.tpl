<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHPBODY管理后台</title>

    <link href="/static/css/bootstrap.css" rel="stylesheet">

    <link href="/static/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/font-awesome/css/font-awesome.min.css">
  </head>
  <body>
    <div id="wrapper">
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">PHPBODY管理后台</a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i>首页</a></li>
            <li>
               <a target="pwrapper" href="?c=category&a=adminindex">查看栏目</a>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>文章管理<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a target="pwrapper" href="admin.php?c=content&a=adminindex">查看文章</a></li>
                <li><a target="pwrapper"  href="admin.php?c=content&a=add">新建文章</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>用户管理<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a target="pwrapper" href="admin.php?c=admin&a=group">管理用户组</a></li>
                <li><a target="pwrapper" href="admin.php?c=admin&a=user">管理用户</a></li>
                <li><a target="pwrapper" href="admin.php?c=admin&a=adminuser">管理后台用户</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>站内更新<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a target="pwrapper" href="admin.php?c=update&a=main">首页更新</a></li>
                <li><a target="pwrapper" href="admin.php?c=update&a=category">栏目更新</a></li>
                <li><a target="pwrapper" href="admin.php?c=update&a=content">内容更新</a></li>
                <li><a target="pwrapper" href="admin.php?c=update&a=tags">标签页更新</a></li>
                <li><a target="pwrapper" href="admin.php?c=lists&a=sitemap">生成网站地图</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>广告管理<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a target="pwrapper" href="admin.php?c=ads&a=index">查看广告</a></li>
                <li><a target="pwrapper" href="admin.php?c=ads&a=add">添加广告</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>友情链接管理<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a target="pwrapper" href="admin.php?c=ads&a=friendindex">查看链接</a></li>
                <li><a target="pwrapper" href="admin.php?c=ads&a=friendadd">添加链接</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><{$name}><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-gear"></i>设置</a></li>
                <li><a href="/admin.php?c=admin&a=password" target='_blank'><i class="fa fa-gear"></i>修改密码</a></li>
                <li class="divider"></li>
                <li><a href="admin.php?c=admin&a=logout"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">
        <iframe id="pwrapper" name="pwrapper" width="1000px" height="800px" frameborder="0" src="/admin.php?c=admin&a=info"></iframe>
      </div>
    </div> <!-- wrapper-->

    <!-- JavaScript -->
    <script src="/static/js/jquery-1.7.2.min.js"></script>
    <script src="/static/js/bootstrap.js"></script>

    <script src="/static/js/tablesorter/jquery.tablesorter.js"></script>
    <script src="/static/js/tablesorter/tables.js"></script>

  </body>
</html>
