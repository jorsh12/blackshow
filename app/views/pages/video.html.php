

<?php 

$image = $this->html->image('video.jpg');
$title = $t('Video');
echo $this->_render('element', 'layout_modulos', compact('image', 'title')); ?>