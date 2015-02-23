
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
	<div class='col-md-2 col-sm-2 col-xs-3'>
		<?=$this->html->link($this->html->image('logo_BlackShow_mod.png'), [
				'Pages::home',
			], [
				'class' => 'image-logo',
				'icon' => '',
			]);?>
	</div>

	<div class='col-md-9 col-sm-9 col-xs-9'>
		<nav class='navbar-custom' role="navigation">
			<div class="navbar-header">
				<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".blackshow-nav" >
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
				</button>				
			</div>

			<div class='navbar navbar-custom collapse navbar-collapse blackshow-nav'>
				<ul class="nav navbar-nav">
					<li class='<?php echo $isActive("we"); ?>'>
						<?=$this->html->link($t('Nosotros'), [
							'Pages::we',
						], [
							'class' => '',
							'icon' => 'institution'
						]);?>
					</li>
					<li class='<?php echo $isActive("audio"); ?>'>
						<?=$this->html->link($t('Audio'), [
							'Pages::audio',
						], [
							'class' => '',
							'icon' => 'file-audio-o'
						]);?>
					</li>	
					<li class='<?php echo $isActive("lighting"); ?>'>
						<?=$this->html->link($t('Iluminación'), [
							'Pages::lighting',
						], [
							'class' => '',
							'icon' => 'lightbulb-o'
						]);?>
					</li>	
					<li class='<?php echo $isActive("video"); ?>'>
						<?=$this->html->link($t('Video'), [
							'Pages::video',
						], [
							'class' => '',
							'icon' => 'video-camera'
						]);?>
					</li>
					<li class='<?php echo $isActive("maintence"); ?>'>
						<?=$this->html->link($t('Reparación y Mantenimiento'), [
							'Pages::maintence',
						], [
							'class' => '',
							'icon' => 'wrench'
						]);?>
					</li>
					<li class='<?php echo $this->_request->params['controller'] === "ContactUs" ? "active" : ""; ?>'>
						<?=$this->html->link($t('Contacto'), [
							'ContactUs::add',
						], [
							'class' => '',
							'icon' => 'comments'
						]);?>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>



<script>
require([
	'<?=$this->url('/js/main.js');?>',
], function (common) {
	require(['<?=$this->url('/js/menu.js');?>']);
});
</script>


