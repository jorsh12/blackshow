<h2><?=$this->title('{:name}');?></h2>

<?php
$this->breadcrumbs->add('{:name}', '{:name}::index');
echo $this->breadcrumbs->create();
?>

<div class="btn-group">
<?=$this->html->link('New {:singular}', [
	'{:name}::add',
], [
	'class' => 'btn btn-default',
	'icon' => 'plus'
]);?>
</div>

<div class="table-responsive">
<table class="table {:plural}">
	<thead>
		<tr>
			<th>ID</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach (${:plural} as ${:singular}): ?>
		<tr id="{:singular}-<?=${:singular}->id;?>" class="{:singular}">
			<td><?=${:singular}->id;?></td>
			<td>
				<div class="btn-group">
					<?=$this->html->link('View', [
						'{:name}::view',
						'id' => ${:singular}->id
					], [
						'class' => 'btn btn-default',
						'icon' => 'eye'
					]);?>
					<?=$this->html->link('Edit', [
						'{:name}::edit',
						'id' => ${:singular}->id
					], [
						'class' => 'btn btn-default',
						'icon' => 'pencil'
					]);?>
					<?=$this->html->link('Delete', [
						'{:name}::delete',
						'id' => ${:singular}->id
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
