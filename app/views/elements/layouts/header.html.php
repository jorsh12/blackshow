<head>
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<?php echo $this->html->charset();?>
	<title>Application &gt; <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('../libs/bootstrap/dist/css/bootstrap.min',
		//'//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css',
		//'//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.1/simplex/bootstrap.min.css',
		//'//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.1/paper/bootstrap.min.css',
		//'//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.1/slate/bootstrap.min.css',
		//'//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.1/flatly/bootstrap.min.css',
		//'//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.1/journal/bootstrap.min.css',
		//'//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.1/readable/bootstrap.min.css',
		//'//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.1/lumen/bootstrap.min.css',
		//'//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.1/sandstone/bootstrap.min.css',
		//'//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.1/spacelab/bootstrap.min.css',
		//'//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.1/cosmo/bootstrap.min.css',
		//'//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.1/darkly/bootstrap.min.css',
		//'http://bootswatch.com/cerulean/bootstrap.min.css',
		'main', 
		'//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css')); ?>
	<?php echo $this->html->script('../libs/requirejs/require'); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->styles(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>