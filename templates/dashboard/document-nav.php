<?php
/**
 * Page header with breadcrumb
 *
 * @since   1.0.0
 * @package Ontario
 * @author  BoltMedia <info@boltmedia.ca>
 */

$current_user = wp_get_current_user();
$can_manage   = $current_user->has_cap( 'administrator' ) || $current_user->has_cap( 'provincial_membership' );
if ( $can_manage ) : ?>
<div class="col-md-6">
	<a href="<?php echo home_url( 'resources/member-documents/' ); ?>" class="item">
		<div class="content">
			<h4>Manage Documents</h4>
			<p>Add, edit or remove member documents.</p>
			<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
		</div>
	</a>
</div>
<?php endif; ?>

<div class="<?php echo $can_manage ? 'col-md-6' : 'col-md-12'; ?>">
	<a href="<?php echo home_url( 'resources/member-documents/' . ( $can_manage ? '?view=1' : '' ) ); ?>" class="item">
		<div class="content">
			<h4>View Documents</h4>
			<p>View all documents that have been uploaded.</p>
			<span class="rmore">Go <i class="fa fa-arrow-right"></i></span>
		</div>
	</a>
</div>
