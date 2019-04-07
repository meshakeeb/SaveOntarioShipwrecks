<form id="post" class="acf-form" action="" method="post">
	
	<?php if ( isset($_GET['edit']) ) : ?>
		<?php 
			if ( get_post( $_GET['edit'] )->post_author != get_current_user_id() ) { 
			$post_id = "new_post";	  
		?>
			<p>&nbsp;</p>
			<div class="alert alert-danger"><strong>ERROR:</strong> You cannot edit this gallery. Only the author of this gallery can edit this.</div>
		<?php } else { 
			$post_id = $_GET['edit'];
		?>
			<p>&nbsp;</p>
			<div class="alert alert-info">Edit this gallery.</div>			
		<?php } ?>	
	<?php else :  $post_id = 'new_post'; ?>		
	<?php endif; ?>	

	<section class="order-summary card">
		<?php 

			acf_form( 
				array( 
					'id' => 'bolt_user_gallery', 
					'post_id' => $post_id,
					'new_post' => array( 
										'post_title' => 'temp', 
										'post_type' => 'bolt_user_gallery' 
								  ),							
					'form' => false,
					'html_updated_message'	=> '<div class="alert alert-success">Submit success</div>',							
				) 
			); 
		?>
	</section>	

	

	<section class="submit card">
		<div class="acf-form-submit">
		    <p align="center"><input type="submit" class="acf-button button button-primary button-large btn button-primary btn-xl btn-danger" value="Submit">
		    <span class="acf-spinner"></span></p>
		</div>
	</section>
		
</form>