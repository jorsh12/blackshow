<h2><?=$this->title("file {$file->id}");?></h2>

<?php
$this->breadcrumbs->add('Files', 'Files::index');
$this->breadcrumbs->add(
	"file {$file->id}",
	['Files::view', 'id' => $file->id]
);
echo $this->breadcrumbs->create();
?>

<div class="btn-group">
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
	<?=$this->html->link('Versions', [
		'Files::versions',
		'id' => $file->id
	], [
		'class' => 'btn btn-default confirm',
		'icon' => 'users'
	]);?>
</div>

<dl class="file">
	<dt>ID</dt>
	<dd><?=$file->id;?></dd>

	<dt>Created By</dt>
	<dd>
		<?=$this->html->link($file->createdBy->email, [
			'Users::view',
			'id' => $file->createdBy->id
		]);?>
	</dd>
	<dt>Created At</dt>
	<dd><?=$this->time->to('words', $file->createdAt);?></dd>
	<dt>Created From IP</dt>
	<dd><?=$file->createdFromIp;?></dd>
	<dt>Updated By</dt>
	<dd>
		<?=$this->html->link($file->updatedBy->email, [
			'Users::view',
			'id' => $file->updatedBy->id
		]);?>
	</dd>
	<dt>Updated At</dt>
	<dd><?=$this->time->to('words', $file->updatedAt);?></dd>
	<dt>Updated From IP</dt>
	<dd><?=$file->updatedFromIp;?></dd>
</dl>

<?php dump($file->data()); ?>

<?=$this->html->link('Download', ['Files::view', 'name' => $file->name]);?>
