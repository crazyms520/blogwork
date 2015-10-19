<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>所有使用者</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="<?php echo base_url('css/blog.css');?>">

  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <style type="text/css">
  </style>
</head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url(''); ?>">首頁</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="<?php echo site_url('messages');?>">我的動態</a></li>
          <li class='active'><a href="<?php echo site_url('friends'); ?>">我的朋友</a></li>
          <li><a href="<?php echo site_url('users'); ?>">尋找使用者</a></li>
        </ul>
        <form class="navbar-form navbar-left" role="search" action='<?php echo site_url('friends');?>' method='get'>
          <div class="form-group">
            <input type="text" class="form-control" name='keyword' placeholder="關鍵字" value="<?php echo $keyword; ?>">
          </div>
          <button type="submit" class="btn btn-default">搜尋</button>
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
    <div class='container'>
      <?php if (!$user_login) { ?>
        <div class="alert alert-danger" role="alert">請先登入！</div>
      <?php
        return;
      }?>
      <?php if (!$friends) { ?>
        <div class="alert alert-warning" role="alert">沒有任何好友！</div>
      <?php
        // return;
      }?>
      <?php if ($message = $this->session->flashdata('message')){ ?>
        <div class="alert alert-info" role="alert"><?php echo $message; ?></div>
      <?php } ?>

      <div class='row'>
        <?php foreach ($friends as $friend) { ?>
          <div class='col-xs-6 col-sm-4 col-md-3'>
            <div class='thumbnail'>
              <img src="<?php echo base_url("images/default-avatar.png"); ?>">
              <div class='caption'>
                <p><?php echo $friend->account."($friend->name)"; ?></p>
                <hr>
                <p class='text-right'></p>
                <?php if($friend->get_friend){ ?>
                  <p class='text-right'><a href='<?php echo  site_url("friends/delete_friends?friend_id=$friend->friend_id"); ?>' class='btn btn-danger' role='button'>刪除好友</a></p>
                <?php }else {?>
                  <p class='text-right'><a href='<?php echo site_url("users/insert_friends?friend_id=$friend->friend_id"); ?>' class='btn btn-primary' role='button'>加入好友</a></p>
                <?php } ?>
              </div>
            </div>
          </div>
      <?php } ?>
      </div>
            <?php echo $pagination; ?>
  </body>
</html>