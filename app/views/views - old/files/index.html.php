<h2><?=$this->title('Files');?></h2>

<?php
$this->breadcrumbs->add('Files', 'Files::index');
echo $this->breadcrumbs->create();
?>

<div class="btn-group">
<?=$this->html->link('New file', [
	'Files::add',
], [
	'class' => 'btn btn-default',
	'icon' => 'plus'
]);?>
</div>

<div class="table-responsive">
<table class="table files">
	<thead>
		<tr>
			<th>ID</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($files as $file): ?>
		<tr id="file-<?=$file->id;?>" class="file">
			<td><?=$file->id;?></td>
			<td>
				<div class="btn-group">
					<?=$this->html->link('View', [
						'Files::view',
						'id' => $file->id
					], [
						'class' => 'btn btn-default',
						'icon' => 'eye'
					]);?>
					<?=$this->html->link('Edit', [
						'Files::edit',
						'id' => $file->id
					], [
						'class' => 'btn btn-default',
						'icon' => 'pencil'
					]);?>
					<?=$this->html->link('Delete', [
						'Files::delete',
						'id' => $file->id
					], [
						'class' => 'btn btn-default confirm',
						'icon' => 'trash'
					]);?>
				</div>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>

<?php echo $this->pagination->paginate($pagination); ?>
