
		</div>
		<br />
		<br />
	</body>
</html>

<script type="text/javascript" src="js/friend.js"></script>
<script type="text/javascript">

    update_chat_history_data();
    setInterval(function(){
        update_last_activity();
        update_chat_history_data();
    }, 5000);

    function update_last_activity()
    {
        $.ajax({
            url:"chat/update_last_activity.php",
            success:function()
            {
            }
        })
    }

	var arr=[];
	$(document).on('click', '#sidebar-user-box', function(){

        
    		// var to_user_id = $(this).data('touserid');
    		// var username = $(this).data('tousername');

            var userID = $(this).attr("class");
		 	var username = $(this).children().text();

    		if ($.inArray(userID, arr) != -1)
    		{
    			arr.splice($.inArray(userID, arr), 1);
    		}
    		arr.unshift(userID);
            fetch_user_chat_history(userID);
    		make_chat_dialog_box(userID, username);
    		$("body").append(  chatPopup  );
    		displayChatBox();
	});

    var chatPopup='';
function make_chat_dialog_box(to_user_id, username)
{
    chatPopup = '<div class="msg_box" style="width:250px;" rel="'+ to_user_id+'">';
    chatPopup+= '<div class="msg_head">'+username+'<div class="close">x</div> </div>';
    chatPopup+='<div class="msg_wrap"><div class="msg_body"><div class="msg_push" data-touserid='+to_user_id+' id="chat_history_'+to_user_id+'"></div></div>';
    chatPopup+='<div class="msg_footer"><textarea class="msg_input" id="msg_input_'+to_user_id+'" rows="3"></textarea></div></div></div>';
}

$(document).on('click', '.close', function() { 
      var chatbox = $(this).parents().parents().attr("rel") ;
      $('[rel="'+chatbox+'"]').remove();
      arr.splice($.inArray(chatbox, arr), 1);
      displayChatBox();
      return false;
  });

$(document).on('click','.msg_head',function () {
    var chatbox= $(this).parents().attr('rel');
    $('[rel="'+chatbox+'"] .msg_wrap').slideToggle('slow');
      return false;
});

function update_chat_history_data()
    {
        $('.msg_push').each(function(){
            var to_user_id = $(this).data('touserid');
            fetch_user_chat_history(to_user_id);
            
        });

        
    }

function fetch_user_chat_history(to_user_id)
    {
        $.ajax({
            url:"chat/fetch_user_chat_history.php",
            method:"POST",
            data:{to_user_id:to_user_id},
            success:function(data){
                $('#chat_history_'+to_user_id).html(data);
                $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
            }
        })
    }


function displayChatBox()
{ 
      i = 270 ; // start position
      j = 260;  //next position
      
      $.each( arr, function( index, value ) {  
        if(index < 4){
            $('[rel="'+value+'"]').css("right",i);
            $('[rel="'+value+'"]').show();
            i = i+j;    
        }
        else{
            $('[rel="'+value+'"]').hide();
        }
    });  
} 

$(document).on('keypress', 'textarea' , function(e) {       
    if (e.keyCode == 13 ) {   
        var msg = $(this).val(); 
        var to_user_id= $(this).attr('id');
            // $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
            
            if(msg.trim().length != 0){    
                var to_user_id = $(this).parents().parents().parents().attr("rel");
                var chatbox = $(this).parents().parents().parents().attr("rel") ;
                $.ajax({
                    url:"chat/insert_chat.php",
                    method:"POST",
                    data:{to_user_id:to_user_id, chat_message:msg},
                    success:function(data) {

                        // $(data).insertBefore('[rel="'+chatbox+'"] .msg_push');
                        $('#chat_history_'+to_user_id).html(data);
                    }
                });

                $(this).val('');                
            }
        }
});

    

</script>