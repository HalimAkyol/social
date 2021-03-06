<?php

//function.php

function wrap_tag($value)
{
	return '<b>'.$value.'</b>';
}

function make_avatar($character)
{
    $path = "avatar/". time() . ".png";
	$image = imagecreate(200, 200);
	$red = rand(0, 255);
	$green = rand(0, 255);
	$blue = rand(0, 255);
    imagecolorallocate($image, $red, $green, $blue);  
    $textcolor = imagecolorallocate($image, 255,255,255);  

    imagettftext($image, 100, 0, 55, 150, $textcolor,'font/arial.ttf', $character);  
    // header("Content-type: image/png");  
    imagepng($image, $path);
    imagedestroy($image);
    return $path;
}


function Get_user_avatar($user_id, $connect)
{
	$query = "SELECT user_avatar FROM register_user WHERE register_user_id = '".$user_id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		return '<img src="'.$row["user_avatar"].'" width="25" class="img-thumbnail img-circle" />';
	}
}
function Get_user_avatar_big($user_id, $connect)
{
	$query = "SELECT user_avatar,user_name,user_country 
			  FROM register_user 
			  WHERE register_user_id = '".$user_id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		// return '<img src="'.$row["user_avatar"].'" width="55" class="img-thumbnail img-circle" />';
		return $row["user_avatar"];
	}
}
function get_user_name($user_id, $connect)
{
	$user_name='';
	$query = "SELECT user_name FROM register_user WHERE register_user_id = '$user_id'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		 return $row['user_name'];
	}
}

function Get_request_status($connect,$from_user,$register_id)
{
	$output='';
	$query="SELECT request_status From friend_request 
			Where ((request_from_id='".$from_user."' AND request_to_id='".$register_id."')
						OR (request_from_id='".$register_id."' AND request_to_id='".$from_user."')) AND request_status!='Confirm'";
	$statement=$connect->prepare($query);
	$statement->execute();
	$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row) {
		$output= $row['request_status'];
	}
	return $output;

}
function view_list_frineds($connect,$session_id,$register_id)
{
	$query = "
				SELECT * FROM friend_request 
				LEFT JOIN register_user ON friend_request.request_from_id=register_user.register_user_id
				WHERE friend_request.request_from_id='".$register_id."'AND register_user.register_user_id='".$register_id."' 
			    AND friend_request.request_status = 'Confirm' ORDER BY request_id DESC
				";
		$statement=$connect->prepare($query);
		$status=$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row) {
			return $row['user_name'];
		}
}
function friend_status($user_id,$connect)
{
					$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
					$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
					$user_last_activity = fetch_user_last_activity($user_id, $connect);
					if($user_last_activity > $current_timestamp)
					{
						// return '<span class="label label-success">Online</span>';
						return true;

					}
					else
					{
						// return '<span class="label label-danger">Offline</span>';
						return false;
					}
				
}
function Request_confirm($connect,$from_user,$register_id)
{
	$output='';
	$query="SELECT request_status From friend_request 
			Where request_from_id='".$from_user."' AND request_to_id='".$register_id."' AND request_status='Confirm' ";
	$statement=$connect->prepare($query);
    $statement->execute();
	$result=$statement->fetchAll(PDO::FETCH_ASSOC);

	foreach ($result as $row) {
		 return $row['request_status'];
	}
}
function fetch_user_last_activity($user_id, $connect)
{
	$query = "
	SELECT * FROM login_data 
	WHERE user_id = '".$user_id."' 
	ORDER BY last_activity DESC 
	LIMIT 1
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['last_activity'];
	}
}
function Get_user_profile_data($user_id,$connect)
{
	$query="SELECT * FROM register_user Where register_user_id='".$user_id."'";
	return $connect->query($query);

}
function Get_user_profile_data_html($user_id,$connect)
{
	$result=Get_user_profile_data($user_id,$connect);

	foreach ($result as $row) {
		if ($row['user_avatar']!='') {
			$output='<div class="table-responsive">
						<table class="table">';
			$output.='
			<tr>
			<td colspan="2" align="center" style="padding:16px 0">
			<img src="'.$row['user_avatar'].'" width="175" class="img-thumbnail img-circle"></td></tr>
			';
			$output.='
			<tr><th>Ad Soyad?? : </th><td>'.$row['user_name'].'</td></tr>
			<tr><th>Email Adresi : </th><td>'.$row['user_email'].'</td></tr>
			<tr><th>Do??um Tarihi : </th><td>'.$row['user_birthdate'].'</td></tr>
			<tr><th>Cinsiyeti : </th><td>'.$row['user_gender'].'</td></tr>
			<tr><th>Adresi : </th><td>'.$row['user_address'].'</td></tr>
			<tr><th>??ehir : </th><td>'.$row['user_city'].'</td></tr>
			<tr><th>??lke : </th><td>'.$row['user_country'].'</td></tr>';
			$output.='
			</table>
			</div>';
			return $output;
		}
	}
}

function load_country_list()
{
	$output='';

	$countries=[
		'ABD Virjin Adalar??',
		'Afganistan',
		'Almanya',
		'Amerika Birle??ik Devletleri',
		'Amerikan Samoas??',
		'Andorra',
		'Angora',
		'Anguilla',
		'Antigua ve Barbuda',
		'Arjantin',
		'Arnavutluk',
		'Aruba',
		'Avustralya',
		'Avusturya',
		'Azerbeycan',
		'Aziz Pierre ve Miquelon',
		'T??rkiye',
		'Bahamalar',
		'Bahreyn',
		'Banglade??',
		'Barbados',
		'Bel??ika',
		'Belize',
		'Benin',
		'Beyaz rusya',
		'Bhutan',
		'Birle??ik Arap Emirlikleri',
		'bir t??r inek',
		'Bolivya',
		'Bosna Hersek',
		'Botsvana',
		'Brezilya',
		' Britanya Virjin Adalar??',
		'Brunei',
		'Bu??dan',
		'Bulgaristan',
		'Burkina Faso',
		'Burundi',
		'B??y??k Britanya',
		'Cayman adalar??',
		'Cebelitar??k',
		'Cezayir',
		'Cibuti',
		'Cocos Adalar??',
		'Cook Adalar??',
		'Curacao',
		'??ad',
		'??ek Cumhuriyeti',
		'??in',
		'Danimarka',
		'Dem. Cum. Kongo',
		'Do??u Timor',
		'Dominika',
		'Dominik Cumhuriyeti',
		'Ekvador',
		'Ekvator Ginesi',
		'Endonezya',
		'Eritre',
		'Ermenistan',
		'Estonya',
		'Etiyopya',
		'Falkland',
		'Faroe Adalar??',
		'Fas',
		'Fiji',
		'Fildi??i Sahilleri',
		'Filipinler',
		'Filistin',
		'Finlandiya',
		'Fransa',
		'Frans??z Polinezyas??',
		'Gabon',
		'Gambiya',
		'Gana',
		'Georgia',
		'Gine',
		'Gine-Bissau',
		'Grenada',
		'Gr??nland',
		'Guadeloupe',
		'Guam',
		'Guatemala',
		'Guyana',
		'Guyanas??',
		'G??ney Afrika',
		'G??ney Kore',
		'G??ney Sudan??n',
		'Haiti',
		'H??rvatistan',
		'Hindistan',
		'Hollanda',
		'Honduras',
		'Hong Kong',
		'Irak',
		'??ran',
		'??rlanda',
		'??spanya',
		'??srail',
		'??sve??',
		'??svi??re',
		'??talya',
		'??zlanda',
		'Jamaika',
		'Japonya',
		'Jersey',
		'Kambo??ya',
		'Kamerun',
		'Kanada',
		'Kanarya Adalar??',
		'Karada??',
		'Karayip Hollandas??',
		'Katar',
		'Kazakistan',
		'Kenya',
		'K??br??s',
		'K??rg??zistan',
		'Kiribati',
		'Kolombiya',
		'Komorlar',
		'Kongo Cumhuriyeti',
		'Kosova',
		'Kostarika',
		'Kuveyt',
		'Kuzey Kore',
		'Kuzey Mariana Adalar??',
		'K??ba',
		'Laos',
		'Letonya',
		'Liberya',
		'Libya',
		'Lihten??tayn',
		'Litvanya',
		'Lucia',
		'L??bnan',
		'L??ksemburg',
		'Macaristan',
		'Madagaskar',
		'Madeira',
		'Makao',
		'Makedonya',
		'Malawi',
		'Maldivler',
		'Malezya',
		'Mali',
		'Malta',
		'Man Adas??',
		'Marshall Adalar??',
		'Martinik',
		'Mauritius',
		'Mayotte',
		'Meksika',
		'M??s??r',
		'Mikronezya',
		'Mo??olistan',
		'Monako',
		'Montserrat',
		'Moritanya',
		'Mozambik',
		'Myanmar',
		'Namibya',
		'Nauru',
		'Nepal',
		'Nijer',
		'Nijerya',
		'Nikaragua',
		'Niue',
		'Noel ada',
		'Norfolk Adas??',
		'Norve??',
		'Orta Afrika',
		'??zbekistan',
		'Pakistan',
		'Palau',
		'Panama',
		'Papua',
		'Paraguay',
		'Peru',
		'Pitcairn',
		'Polonya',
		'Portekiz',
		'Porto-Riko',
		'R??union',
		'Romanya',
		'Ruanda',
		'Rusya',
		'Saint-Barthelemy',
		'Saint Helena', 
		'Ascension ve Tristan da Cunha',
		'Saint Kitts and Nevis',
		'Saint-Martin',
		'Saint Vincent ve Grenadinler',
		'Salvador',
		'Samoa',
		'San Marino',
		'Sao Tome ve Principe',
		'SDAC',
		'Senegal',
		'Sey??eller',
		'S??rbistan',
		'Sierra Leone',
		'Singapur',
		'Sint Maarten',
		'Slovakya',
		'Slovenya',
		'Solomon Adalar??',
		'Somali',
		'Sri Lanka',
		'Sudan',
		'Surinam',
		'Suriye',
		'Suudi Arabistan',
		'Svaziland',
		'??ili',
		'Tacikistan',
		'Tanzanya',
		'Tayland',
		'Tayvan',
		'Togo',
		'Tokelau',
		'Tonga',
		'Transdinyester',
		'Trinidad ve Tobago',
		'Tunus',
		'Turks ve Caicos',
		'Tuvalu',
		'T??rkiye',
		'T??rkmenistan',
		'Uganda',
		'Ukrayna',
		'Umman',
		'Uruguay',
		'??rd??n',
		'Vanuatu',
		'Vatikan',
		'Venezuela',
		'Vietnam',
		'Wallis ve Futuna',
		'Yemen'
	];
				foreach ($countries as $key => $value) {
					$output .= " <option value='".$value."'>".$value."</option>";
				}
				return $output;
}
 


function count_unseen_message($from_user_id, $to_user_id, $connect)
{
	$query = "SELECT * FROM chat_message WHERE from_user_id='$from_user_id' AND to_user_id='$to_user_id' AND status='1'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$count = $statement->rowCount();
	$output = '';
	if($count > 0)
	{
		$output = '<span class="label label-success">'.$count.'</span>';
	}
	return $output;
}

function fetch_is_type_status($user_id, $connect)
{
	$query = "SELECT is_type FROM login_data WHERE user_id='".$user_id."' ORDER BY last_activity DESC LIMIT 1	";	
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		if($row["is_type"] == 'yes')
		{
			$output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
		}else{ $output='';}
	}
	return $output;
}
function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
	$query = "
	SELECT * FROM chat_message 
	WHERE (from_user_id = '".$from_user_id."' 
	AND to_user_id = '".$to_user_id."') 
	OR (from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."') 
	ORDER BY timestamp asc
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output='';

	foreach($result as $row)
	{
		$user_name = '';
		$dynamic_background = '';
		$chat_message = '';
		if($row["from_user_id"] == $from_user_id)
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em>This message has been removed</em>';
				$user_name = '<b class="text-success">You</b>';
			}
			else
			{
				$chat_message =$row['chat_message'];
				$user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
			}
			$dynamic_background = 'class="msg-right"';
		}
		else
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em>This message has been removed</em>';
			}
			else
			{
				$chat_message =$row['chat_message'];
			}
			$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
			$dynamic_background = 'class="msg-left"';
		}
		$output.= '
		<div '.$dynamic_background.' >
			<p>'.$user_name.'&nbsp;&nbsp;&nbsp;'.$chat_message.'<br> <small style="float:right;"><em>'.$row['timestamp'].'</em></small>
			</p>
		</div>
		';
	}

	$query = "
	UPDATE chat_message 
	SET status = '0' 
	WHERE from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."' 
	AND status = '1'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $output;
}


?>