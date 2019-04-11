<?php
/**
 * Page header with breadcrumb
 *
 * @since   1.0.0
 * @package Ontario
 * @author  BoltMedia <info@boltmedia.ca>
 */
?>
<div class="page_header">

	<div class="container">

		<div class="row">

			<div class="col-sm-6">

				<h1><?php the_title(); ?></h1>

			</div>

			<div class="col-sm-6">

				<div class="bcrumbs">

					<ul>

						<li>
							<a href="<?php home_url(); ?>">Home</a>
						</li>

						<li>
							<span><?php the_title(); ?></span>
						</li>

					</ul>

				</div>

			</div>

		</div>

	</div>

</div>
