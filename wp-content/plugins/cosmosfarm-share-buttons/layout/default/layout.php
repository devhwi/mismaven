<?php if(!defined('ABSPATH')) exit;?>
<div class="cosmosfarm-share-buttons cosmosfarm-share-buttons-default cosmosfarm-align-<?php echo $align?>">
	<?php foreach($option->active as $key=>$value):?>
	<button class="cosmosfarm-share-button cosmosfarm-<?php echo $value?>" onclick="return cosmosfarm_share('<?php echo $value?>', '<?php echo $url?>', '<?php echo $title?>');"><?php echo $option->sns[$value]?></button>
	<?php endforeach?>
</div>