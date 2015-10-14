<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>帳號註冊</title>
    <!-- 最新編譯和最佳化的 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- 選擇性佈景主題 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url('css/blog.css');?>">
    <!-- 最新編譯和最佳化的 JavaScript -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header" >
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">我的動態</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url('');?>">首頁</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="<?php echo site_url('messages');?>">我的動態</a></li>
          <li><a href="#">我的朋友</a></li>
          <li><a href="#" >尋找使用者</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">設定 <span class="caret"></span></a>

              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo site_url('platform/login');?>">會員登入</a></li>
                <li><a href="<?php echo site_url('platform/register');?>">註冊帳號</a></li>
            </ul>

          </li>
        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>
    <div class='container'>
      <?php switch ($warning) {
        case 'error1':?>
          <div class="alert alert-info" role="alert">登入失敗，帳號密碼有誤</div>
        <?php break;
        case 'error2':?>
        <div class="alert alert-info" role="alert">填寫資料有誤</div>
        <?php break;
        default:

          break;
      }?>


      <div class='row'>
        <div class='col-md-4'></div>
        <div class='col-md-4'>
          <form action='<?php echo site_url('platform/register_post');?>' method='post'>

            <div class="form-group">
              <label for="name">輸入名稱</label>
              <input type="text" class="form-control" name='name' id="name" placeholder="請輸入名稱...">
            </div>
            <div class="form-group">
              <label for="account">輸入帳號</label>
              <input type="text" class="form-control" name='account' id="account" placeholder="請輸入帳號...">
            </div>
            <div class="form-group">
              <label for="password">輸入密碼</label>
              <input type="password" class="form-control" name='password' id="password" placeholder="請輸入密碼...">
            </div>
            <div class="form-group">
              <label for="repassword">確認密碼</label>
              <input type="password" class="form-control" name='repassword' id="repassword" placeholder="請輸入確認密碼...">
            </div>
            <hr>
            <div class='form-group text-right'>
              <button type="submit" class="btn btn-default">確定</button>
            </div>
          </form>
        </div>
        <div class='col-md-4'></div>
      </div>
    </div>
  </body>
</html>