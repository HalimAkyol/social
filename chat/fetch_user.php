<?php 

include'../database_connection.php'; 
include '../function.php';
session_start();

if($_POST["action"] == 'view_list_friends')
{
		$condition = '';
		if(!empty($_POST["query"]))
		{
			$search_query = preg_replace('#[^a-z 0-9?!]#i', '', $_POST["query"]);
			$search_array = explode(" ", $search_query);
			$condition = ' AND (';
			foreach($search_array as $search)
			{
				if(trim($search) != '')
				{
					$condition .= "register_user.user_name LIKE '%".$search."%' OR ";
				}
			}
			$condition = substr($condition, 0, -4) . ") ";
		}
		$query = "
		SELECT register_user.user_name, friend_request.request_from_id, friend_request.request_to_id FROM register_user 
		INNER JOIN friend_request 
		ON  register_user.register_user_id = friend_request.request_to_id 
		WHERE (friend_request.request_from_id = '".$_SESSION["user_id"]."' OR friend_request.request_to_id = '".$_SESSION["user_id"]."') 
		AND register_user.register_user_id != '".$_SESSION["user_id"]."'
		AND friend_request.request_status = 'Confirm' 
		".$condition."
		GROUP BY register_user.user_name 
		ORDER BY friend_request.request_id DESC
		";	
		$statement = $connect->prepare($query);
		$statement->execute();
		$html = '';
		if($statement->rowCount() > 0)
		{
			$count = 0;
			foreach($statement->fetchAll() as $row)
			{
				$temp_user_id = 0;

				if($row["request_from_id"] == $_SESSION["user_id"])
				{
					$temp_user_id = $row["request_to_id"];
				}
				else
				{
					$temp_user_id = $row["request_from_id"];
				}
				$status=friend_status($temp_user_id,$connect);

				if ($status) {
					$state='<i class="fa fa-solid fa-circle state" style="color:green;"></i>';
				}else{
					$state='<i class="fa fa-solid fa-circle state" style="color:maroon;"></i>';
				}

				$is_type=fetch_is_type_status($temp_user_id,$connect);

				// $count++;

				// if($count == 1)
				// {
				// 	$html .= '<div class="row">';
				// }

				$html .= '

				<div id="sidebar-user-box" class="'.$temp_user_id.'">
					<img src="'.Get_user_avatar_big($temp_user_id,$connect).'" width="35" class="img-thumbnail img-circle user" />
					<span id="slider-username">'.get_user_name($temp_user_id,$connect).'</span>'.count_unseen_message($temp_user_id, $_SESSION['user_id'], $connect).'
					'.$state.'
				</div> 



				
				
				';
				// <span class="badge badge-primary badge-pill">'.$state.'</span>
				// if($count == 3)
				// {
				// 	$html .= '</div>';
				// 	$count = 0;
				// }


			}
		}
		else
		{
			$html = '<h4 align="center">No Friends Found</h4>';
		}
		echo $html;
}



// <div id="sidebar-user-box" class="100" >
// <img src="'.Get_user_avatar_big($temp_user_id, $connect).'" width="35" class="img-thumbnail img-circle" />
// <span id="slider-username">'.get_user_name($temp_user_id,$connect).'</span>
// '.$state.'
// </div> 



// <div class="col-md-4 start_chat" data-touserid='.$temp_user_id.' data-tousername='.$row['user_name'].' style="margin-bottom:12px; cursor:pointer;">'.$state.'
// 					'.Get_user_avatar_big($temp_user_id, $connect).''.count_unseen_message($temp_user_id, $_SESSION['user_id'], $connect).'
// 					<div align="center"><b><a href="#" style="font-size:12px;"></a></b>'.$is_type.'</div>
// 				</div>

?>