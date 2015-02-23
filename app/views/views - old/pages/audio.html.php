

<?php 
$image = $this->html->image('audio.jpg');
$title = $t('Audio');
echo $this->_render('element', 'layout_modulos', compact('image', 'title')); ?>