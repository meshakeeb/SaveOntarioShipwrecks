<p>&nbsp;</p>

<h4>Chapters</h4>

<p>&nbsp;</p>

<div class="panel-group">

	<?php foreach ( \Ontario\Choices::get_chapters() as $chapter_id => $chapter_title ) : ?>

	<div class="panel panel-default">

		<div class="panel-heading">

			<div class="panel-title">
				<?php echo $chapter_title; ?>
				<small class="pull-right">
					<a href="/dashboard/member-management?chapter=<?php echo $chapter_id; ?>">Manage List</a>
					&nbsp; | &nbsp;
					<a href="/dashboard/members?chapter=<?php echo $chapter_id; ?>">Manage Permissions</a>
				</small>
			</div>

		</div>

		<div id="collapse<?php echo $u->ID; ?>" class="panel-collapse collapse">
			<div class="panel-body"></div>
		</div>

	</div>

	<?php endforeach; ?>

</div>
