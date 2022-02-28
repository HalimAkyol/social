
<?php

//header.php
session_start();
if(!isset($_SESSION["user_id"]))
{
	header('location:login.php');
}
include('database_connection.php');
include('function.php');
if(isset($_POST["searchBtn"]))
{
	$search_query = preg_replace("#[^a-z 0-9?!]#i", "", $_POST["searchbar"]);

	header('location:search.php?query='.urlencode($search_query).'');
}
$user_name = '';
$user_id = '';
if(isset($_SESSION["user_name"], $_SESSION["user_id"]))
{
	$user_name = $_SESSION["user_name"];
	$user_id = $_SESSION["user_id"];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Make Social Network System in PHP Mysql using Ajax jQuery</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

  		<link rel="stylesheet" type="text/css" href="css/chatbox.css">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  		<link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">


  		<script src="http://code.jquery.com/jquery.js"></script>
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>  
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
  		<script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
  		
    	<style>

    		.wrapper-preview
    		{
    			padding: 50px;
			    background: #fff;
			    box-shadow: 0 1px 4px rgba(0,0,0,.25);
			    border-radius: 10px;
			    text-align:center;
    		}

    		.wrapper-box
    		{
    			padding: 20px;
			    margin-bottom: 20px;
			    background: #fff;
			    box-shadow: 0 1px 4px rgba(0,0,0,.25);
			    border-radius: 10px;
    		}

    		.wrapper-box-title
    		{
    			font-size: 20px;
			    line-height: 100%;
			    color: #000;
			    padding-bottom: 8px;
    		}

    		.wrapper-box-description
    		{
    			font-size: 14px;
			    line-height: 120%;
			    color: #000;
    		}

    		#friend_request_list li
    		{
    			padding:10px 12px;
    			border-bottom: 1px solid #eee;
    		}

    		.nopadding {
			   padding: 0 !important;
			   margin: 0 !important;
			}

    	</style>
	</head>
	<body vlink="#385898" alink="#385898" style="background-color: #f5f6fa">
		<nav class="navbar navbar-default col-md-12">
		  	<div class="container-fluid">
			    <div class="navbar-header">
			      	<a class="navbar-brand" href="home.php">Social Media</a>
			    </div>
			    
			    <form class="navbar-form navbar-left" method="post">
			    	<div class="input-group">
			    		<input type="text" class="form-control" id="searchbar" name="searchbar" placeholder="Search" autocomplete="off" />
			    		<div class="input-group-btn">
			    			<button class="btn btn-default" type="submit" name="searchBtn" id="searchBtn">
			    				<i class="glyphicon glyphicon-search"></i>
			    			</button>
			    		</div>
			    	</div>

			    	<div class="countryList" style="position: absolute;width: 235px;z-index: 1001;"></div>
			    </form>

			    <ul class="nav navbar-nav navbar-right">
			    	<li class="dropdown">
			    		<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" id="friend_request_area">
			    			<span id="unseen_friend_request_area"></span>
			    			<i class="fa fa-user-plus fa-2" aria-hidden="true"></i>
			    			<span class="caret"></span>
			    		</a>
			    		<ul class="dropdown-menu" id="friend_request_list" style="width: 300px; max-height: 350px;">

			    		</ul>
			    	</li>


			    	<li><a href="profile.php?action=view"><?php echo Get_user_avatar($_SESSION["user_id"], $connect);  ?> <b><?php echo $user_name; ?></b></a></li>
			    	<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>

			    </ul>
		  	</div>
		</nav>

		<div class="container">
