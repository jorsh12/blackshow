

<?php

$action = 'contact_us';

if ($this->_options['controller'] !== 'contact_us') {
	$action = $this->_options['action'];
}

?>

<h3><?=$title ?></h3>
<div class='col-md-5 col-xs-4 equal container-texto-right<?php if ($action === 'contact_us' ||  $action === 'audio' || $action === 'maintence') echo '-completo' ?>'>
	
		<?php if(app\models\Users::current()): ?>
			<?=$this->form->create(compact('texto'), array('action' => 'updateTexto'));?>
			<?=$this->form->hidden('id', array('value' => $texto->id));?>
			<?=$this->form->hidden('page', array('value' => $action));?>
			<?=$this->form->hidden('language', array('value' => isset($this->_request->params['locale']) ? $this->_request->params['locale'] : 'default'));?>
			<div class='form-group'>
				<?=$this->form->textarea('content', array(
					'value' => nl2br($texto->content),
					'class' => 'form-control textjqte',
					'rows' => '14'
				));
				?>
			</div>
			<div class='form-group'>
				<?=$this->form->submit($t('Guardar'));?>
			</div>

			<?php $this->html->style([
				'/libs/jqte/jQuery-TE_v.1.3.2/jquery-te-1.3.2.css',
			], [
				'inline' => false
			]); ?>

			<?php ob_start(); ?>
			<script>
			require([
				'<?=$this->url('/js/main.js');?>',
			], function (common) {
				require(['<?=$this->url('/js/texteditor.js');?>']);
			});
			</script>
			<?php $this->scripts(ob_get_clean()); ?>

		<?php else: ?>
			<?php echo nl2br($texto->content); ?>
		<?php endif; ?>
	
</div>