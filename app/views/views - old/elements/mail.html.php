
<?php echo $this->html->style(array(
	'//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css',
)); ?>

<h3 class='well'>Categoria</h3>
<?=$data['category'] ?>

<h3 class='well'>Nombre completo</h3>
<?=$data['name']; ?>

<h3 class='well'>Ciudad</h3>
<?=$data['city']; ?>

<h3 class='well'>Telefono</h3>
<?=$data['fhone']; ?>

<h3 class='well'>Email</h3>
<?=$data['email']; ?>

<h3 class='well'>Comentarios</h3>
<?=$data['comments']; ?>

<br />