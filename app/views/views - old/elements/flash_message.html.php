<?php
/**
 * li3_flash_message plugin for Lithium: the most rad php framework.
 *
 * @copyright     Copyright 2010, Michael Hüneburg
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<div class="alert<?php if(!empty($type)): ?> alert-<?=$type; ?><?php else:?>info<?php endif; ?><?php if(!empty($class)): ?> <?=$class; ?><?php endif; ?>">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<?php if(!empty($title)): ?>
		<strong><?=$title; ?></strong>
	<?php endif; ?>
	<p><?=$message; ?></p>
</div>
