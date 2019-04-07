<p>Good Day {$user_info->last_name}, {$user_info->first_name}</p>

<p>Your membership account has been updated.</p>

<p>You can now: </p>
<ul>
<?php
	
	if($_POST['role'] === "bolt_chapter_editor"){
		echo "<li>Manage the whole Chapter as editor</li>";
	} else {	

		$user_cap['allow_chapter'] = "manage the chapter";
		$user_cap['allow_buoy_status'] = "manage the buoy status";
	    $user_cap['allow_buoy_site'] = "manage the buoy site";
	    $user_cap['allow_events'] = "post an event";
	    $user_cap['allow_newsletter'] = 'send newsletter to our chapter members';	

		foreach( $_POST['boltcap'] as $c){
			echo  '<li>'.$user_cap[$c].'</li>';
		}
	}
?>		
</ul>