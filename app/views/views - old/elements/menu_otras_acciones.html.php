
<div class='row'>
	<div class='col-xs-7 col-md-offset-9 well-lg image-home-login pull-right'>
		
		<!-- <div class='col-md-4'>
			<?php $color = isset($this->_request->params['color']) ? $this->_request->params['color'] : 'default'; ?>
			<?php echo $this->_render('element', 'change_color', compact('color')); ?>
		</div> -->
		<div class='col-md-2'>		
			<?php if($this->_request->params['action'] !== 'login'): ?>
				<?php if(app\models\Users::current()): ?>
					<?=$this->html->link($t('Salir'), [
						'Accounts::logout',
					], [
						'class' => 'logout',
						'icon' => 'reply'
					]);?>
				<?php endif;?>
			<?php else: ?>
				<?=$this->html->link($t('Inicio'), [
					'Pages::home',
				], [
					'class' => 'logout',
					'icon' => 'home'
				]);?>		
			<?php endif;?>
		</div>

		<div class='col-md-6'>
			<?php $language = isset($this->_request->params['locale']) ? $this->_request->params['locale'] : 'default'; ?>
			<?php echo $this->_render('element', 'change_language', compact('language')); ?>
		</div>
		<div class="col-md-4 clock">
		</div>
	</div>
</div>

<?php $this->html->style([
	'clock.css',	
], [
	'inline' => false
]); ?>

<script>
require([
	'<?=$this->url('/js/main.js');?>',
], function (common) {
	require(['<?=$this->url('/js/clock.js');?>']);
});
</script>
