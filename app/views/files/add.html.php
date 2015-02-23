<h2>
<?php
if ($file->exists()) {
	echo $this->title("Edit file {$file->id}");
} else {
	echo $this->title('New file');
}
?>
</h2>

<?php
$this->breadcrumbs->add('Files', 'Files::index');
if ($file->exists()) {
	$this->breadcrumbs->add(
		"file {$file->id}",
		['Files::view', 'id' => $file->id]
	);
	$this->breadcrumbs->add(
		'Edit',
		['Files::edit', 'id' => $file->id]
	);
} else {
	$this->breadcrumbs->add(
		'New file',
		'Files::add'
	);
}
echo $this->breadcrumbs->create();
?>

<div class="well">
<?=$this->form->create($file, ['type' => 'file']);?>
<fieldset>
	<legend>Files</legend>
	<?=$this->form->field('file', ['type' => 'file']);?>
	<?=$this->form->submit('Save'); ?>
</fieldset>
<?=$this->form->end(); ?>
</div>
