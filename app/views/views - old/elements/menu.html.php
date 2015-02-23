
<?php
	$request = $this->_request;
	$isActive = function($action) use ($request) {
		if ($action === $request->params["action"]) {
			return ' active';
		}
		return '';
	};
?>

<?php echo $this->_render('element', 'menu_otras_acciones'); ?>

<div class='row'>
	<nav class='navbar-custom' role="navigation">
		<div class="navbar-header">
			<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".blackshow-nav" >
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
			</button>

			<?=$this->html->link($this->html->image('logo_BlackShow_mod.png'), [
				'Pages::home',
			], [
				'class' => 'navbar-brand image-logo-menu',
				'icon' => '',
				'style' => 'display:none'
			]);?>
		</div>

		<div class='navbar navbar-custom collapse navbar-collapse blackshow-nav'>
			<ul class="nav navbar-nav navbar-right">
				<li class='<?php echo $isActive("we"); ?>'>
					<?=$this->html->link($t('Nosotros'), [
						'Pages::we',
					], [
						'class' => 'pull-right',
						'icon' => 'institution'
					]);?>
				</li>
				<li class='<?php echo $isActive("audio"); ?>'>
					<?=$this->html->link($t('Audio'), [
						'Pages::audio',
					], [
						'class' => 'pull-right',
						'icon' => 'file-audio-o'
					]);?>
				</li>	
				<li class='<?php echo $isActive("lighting"); ?>'>
					<?=$this->html->link($t('Iluminación'), [
						'Pages::lighting',
					], [
						'class' => 'pull-right',
						'icon' => 'lightbulb-o'
					]);?>
				</li>	
				<li class='<?php echo $isActive("video"); ?>'>
					<?=$this->html->link($t('Video'), [
						'Pages::video',
					], [
						'class' => 'pull-right',
						'icon' => 'video-camera'
					]);?>
				</li>
				<li class='<?php echo $isActive("maintence"); ?>'>
					<?=$this->html->link($t('Reparación y Mantenimiento'), [
						'Pages::maintence',
					], [
						'class' => 'pull-right',
						'icon' => 'wrench'
					]);?>
				</li>
				<li class='<?php echo $this->_request->params['controller'] === "ContactUs" ? "active" : ""; ?>'>
					<?=$this->html->link($t('Contacto'), [
						'ContactUs::add',
					], [
						'class' => 'pull-right',
						'icon' => 'comments'
					]);?>
				</li>
			</ul>
		</div>
	</nav>
</div>



<script>
require([
	'<?=$this->url('/js/main.js');?>',
], function (common) {
	require(['<?=$this->url('/js/menu.js');?>']);
});
</script>


