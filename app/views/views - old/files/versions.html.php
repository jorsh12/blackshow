<h2><?=$this->title("file {$file->id} Versions");?></h2>

<?php
$this->breadcrumbs->add('Files', 'Files::index');
$this->breadcrumbs->add(
	"file {$file->id}",
	['Files::view', 'id' => $file->id]
);
$this->breadcrumbs->add(
	'Versions',
	['Files::versions', 'id' => $file->id]
);
echo $this->breadcrumbs->create();
?>

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

<?=$this->element->logEntries(compact('entries')); ?>

<h3>Actual version</h3>
<?php dump($file->data()); ?>
