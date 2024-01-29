<?php
    session_start();
    if (!isset($_SESSION['sAccount']))
	header('Location: login.php');
?>
<!DOCTYPE html>
<html >	
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>後台管理系統</title>
	
	<!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="logo/fav.png">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="logo/fav.png">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="logo/fav.png">
    <!-- Standard iPad Touch Icon--> 
    <link rel="apple-touch-icon" sizes="72x72" href="logo/fav.png">
    <!-- Standard iPhone Touch Icon--> 
    <link rel="apple-touch-icon" sizes="57x57" href="logo/fav.png">
	
	<!-- Styles -->
    <link href="assets/fontAwesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/mmc-chat.css" rel="stylesheet" />
    <link href="assets/css/lib/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/nixon.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
	
		<style type="text/css">

	</style>
    <script>
        function deleteConfirm(filename,id){
            if(confirm("警告:\n確定刪除編號為 " + id + "的資料?") == 1){
                location.replace(filename + "?mode=delete&id="+id);
            }else{
                return false;
            }
        }
        function redirectDiallog(filename,msg){
            alert(msg);
            location.replace(filename);

        }
    </script>
</head>

<body>
    <?php
    $a = explode("/",$_SERVER['SCRIPT_NAME']);//將$_SERVER['SCRIPT_NAME']以/為分界分別放進$a, a此時為陣列
    $tempfilename = $a [count($a) -1 ];
    ?>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <li <?php if ($tempfilename=="index.php") {echo 'class="active"'; }?>><a href="index.php"><i class="ti-home"></i> 管理者首頁</a> </li>		 
					<li <?php if ($tempfilename=="admin.php") {echo 'class="active"'; } ?>><a href="admin.php"><i class="ti-control-record"></i> 1.管理者帳號維護</a></li>
                    <li <?php if ($tempfilename=="member.php") {echo 'class="active"'; } ?>><a href="member.php"><i class="ti-control-record"></i> 2.會員帳號維護</a></li>	
                    <li <?php if ($tempfilename=="ch06-1.php") {echo 'class="active"'; } ?>><a href="ch06-1.php"><i class="ti-control-record"></i> 3.與MySQL資料連結</a></li>
                    <li <?php if ($tempfilename=="product.php") {echo 'class="active"'; } ?>><a href="product.php"><i class="ti-control-record"></i> 4.查詢商品資料</a></li>	                                        	
					<li><a href="login.php?st=logout"><i class="ti-close"></i> 登出</a></li>
                </ul>
            </div>
        </div>
    </div><!-- /# sidebar -->




    <div class="header">
        <div class="pull-left">
                        <div class="logo">
                <a href="index.php">
                     <span style="font-size:18px;color:#fff; font-weight"><img id="logoImg" src="logo/logoSmall.png" data-logo_big="logo/logoSmall.png" data-logo_small="logo/logoSmall.png"  />後台管理系統</span>
                </a>
            </div>
            <div class="hamburger sidebar-toggle">
                <span class="ti-menu"></span>
            </div>
        </div>

        
    </div>

	
    <!-- END chat Sidebar-->


    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 p-0">
                        <div class="page-header">
							<div class="page-title">
								<h1><?=$_SESSION['aname']?>您好！登入時間：<?=$_SESSION['sLogintime']?></h1>
							</div>
						</div>
                    </div>
                    
                </div>
				<div class="main-content"> 