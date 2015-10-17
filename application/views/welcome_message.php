<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>首頁</title>
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
	        <li><a href="#">我的朋友</a></li>
	        <li><a href="<?php echo site_url('users'); ?>">尋找使用者</a></li>
	      </ul>
	      <!-- <form class="navbar-form navbar-left" role="search">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="關鍵字">
	        </div>
	        <button type="submit" class="btn btn-default">搜尋</button>
	      </form> -->
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
			<?php if($message = $this->session->flashdata('message')){?>
        <div class="alert alert-info" role="alert"><?php echo $message ?></div>
      <?php } ?>
			<div class="page-header">
			  <h1>首頁<small>動態練習</small></h1>
			</div>

			<?php if($user_login){
				echo "Hi，".$user->account."(".$user->name.")！";
		 	}else{
		 		echo "您尚未登入！";
		 	} ?>
		</div>

	</body>
</html>