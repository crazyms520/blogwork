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
        <form class="navbar-form navbar-left" role="search" action='<?php echo site_url('messages/search'); ?>' method='get'>
          <div class="form-group">
            <input type="text" class="form-control" name="keyword" placeholder="關鍵字.."  />
          </div>
          <button type="submit" class="btn btn-default ">搜尋</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">設定 <span class="caret"></span></a>

              <ul class="dropdown-menu" role="menu">
                <?php if($user_login){?>
                  <li><a href="#">個人資料</a></li>
                  <li><a href="<?php echo site_url('platform/logout');?>">會員登出</a></li>
                <?php }else{ ?>
                  <li><a href="<?php echo site_url('platform/login'); ?>">會員登入</a></li>
                  <li><a href="<?php echo site_url('platform/register');?>">註冊帳號</a></li>
              <?php } ?>
            </ul>

          </li>
        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
      <?php if (!$user_login) { ?>
        <div class="alert alert-danger" role="alert">請先登入！</div>
      <?php
        return;
      }?>

      <?php if($message = $this->session->flashdata('message')){?>
        <div class="alert alert-info" role="alert"><?php echo $message; ?></div>
      <?php } ?>
      <form action='<?php echo site_url('messages/messages_post');?>' method='post'>
        <div class='form-group'>

          <label for='content'>輸入動態吧！</label>
          <textarea class="form-control" rows="3" name='content' placeholder='在想些什麼？'></textarea>
        </div>

        <div class='form-group text-right'>
          <button type='submit' class='btn btn-default'>確定</button>
        </div>
      </form>
      <hr>
      <?php if(!$messages){ ?>
        <div class="alert alert-warning" role="alert">沒有任何動態！</div>
      <?php }?>
      <?php if ($messages){
        foreach($messages as $message){ ?>
          <div class="panel panel-default">
            <div class="panel-heading"><?php echo $message->name; ?></div>
              <div class="panel-body">
                <?php echo $message->content; ?>
              </div>
              <div class="panel-footer text-right"><?php echo $message->created_at;?></div>
          </div>
        <?php } ?>
      <?php } ?>
      <?php echo $pagination; ?>
    </div>





  </body>
</html>