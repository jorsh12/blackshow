<h2>
<?php
if (${:singular}->exists()) {
	echo $this->title("Edit {:singular} {${:singular}->id}");
} else {
	echo $this->title('New {:singular}');
}
?>
</h2>

<?php
$this->breadcrumbs->add('{:name}', '{:name}::index');
if (${:singular}->exists()) {
	$this->breadcrumbs->add(
		"{:singular} {${:singular}->id}",
		['{:name}::view', 'id' => ${:singular}->id]
	);
	$this->breadcrumbs->add(
		'Edit',
		['{:name}::edit', 'id' => ${:singular}->id]
	);
} else {
	$this->breadcrumbs->add(
		'New {:singular}',
		'{:name}::add'
	);
}
echo $this->breadcrumbs->create();
?>

<div class="well">
<?=$this->form->create(compact('{:singular}')); ?>
<fieldset>
	<legend>{:name}</legend>
	<?=$this->form->fromEntity('{:singular}', []); ?>
	<?=$this->form->submit('Save'); ?>
</fieldset>
<?=$this->form->end(); ?>
</div>
