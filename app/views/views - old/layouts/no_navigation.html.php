<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<html>
	
	<?php echo $this->_render('element', 'layouts/header'); ?>

	<body>

		<?php echo $this->flashMessage->show(); ?>
		<div class='container contenedor-main image-fondo'>
			<?php echo $this->content(); ?>
		</div>
			
	</body>
</html>