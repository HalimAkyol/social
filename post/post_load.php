<?php 
include '../database_connection.php';
include '../function.php';
session_start();

$query='SELECT distinct( posts_table.posts_id),posts_table.post_content, posts_table.user_id FROM posts_table 
		INNER JOIN friend_request ON posts_table.user_id=friend_request.request_from_id OR 
									 posts_table.user_id=friend_request.request_to_id
				WHERE (friend_request.request_from_id = "'.$_SESSION['user_id'].'" OR friend_request.request_to_id = "'.$_SESSION['user_id'].'") 
		AND friend_request.request_to_id!="'.$_SESSION['user_id'].'"
		AND friend_request.request_status = "Confirm" ORDER BY posts_id desc ';

$statement=$connect->prepare($query);
$statement->execute();

if($statement->rowCount()>0)
{
	$html='';

	foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $row) {

		$post_content=$row['post_content'];
		$user_id=$row['user_id'];
		$query="SELECT * FROM register_user Where register_user_id='".$user_id."'";
		$statement=$connect->prepare($query);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);


		foreach ($result as $row) {
			$user_name= $row['user_name'];
		}

		$html .= '
		<div class="panel panel-default">
		<div class="panel-heading">
		<div class="row">
		<div class="col-md-9">
		'.Get_user_avatar($user_id,$connect).'&nbsp;<a href="#"><b>'.$user_name.'</b></a> 
		<span class="text-muted">has share post</span>
		</div>
		</div>
		</div>
		<div class="panel-body" style="font-size:20px;">
		'.$post_content.'
		</div>
		</div>
		';
	}
	echo $html;
}else{

	$query="SELECT * FROM posts_table INNER JOIN register_user ON posts_table.user_id=register_user.register_user_id WHERE user_id='".$_SESSION['user_id']."'";
	$statement=$connect->prepare($query);
	$statement->execute();
	foreach ($statement->fetchAll() as $row) {

		@$html .= '
		<div class="panel panel-default">
		<div class="panel-heading">
		<div class="row">
		<div class="col-md-9">
		'.Get_user_avatar($row['user_id'],$connect).'&nbsp;<a href="#"><b>'.$row['user_name'].'</b></a> 
		<span class="text-muted">has share post</span>
		</div>
		</div>
		</div>
		<div class="panel-body" style="font-size:20px;">
		'.$row['post_content'].'
		</div>
		</div>
		';
	}
	echo @$html;
}

 ?>