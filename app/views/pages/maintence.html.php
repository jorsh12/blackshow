

<?php 

$image = $this->html->image('reparacion.jpg');
$title = $t('Reparación y Mantenimiento');
echo $this->_render('element', 'layout_modulos', compact('image', 'title')); ?>