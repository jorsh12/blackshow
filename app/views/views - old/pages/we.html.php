

<?php

$image = $this->html->image('nosotros.jpg');
$title = $t('Nosotros');
echo $this->_render('element', 'layout_modulos', compact('image', 'title')); ?>