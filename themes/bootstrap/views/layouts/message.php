<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
<div class="span3"> 
<?php 
$this->widget('zii.widgets.CMenu',array(
	'items'=>array(
		array('label'=>'收件箱', 'url'=>array('/message/inbox')),
		array('label'=>'发件箱', 'url'=>array('/message/sent/sent')),
		array('label'=>'新邮件', 'url'=>array('/message/compose')),
	),
	'htmlOptions'=>array(
		'class'=>'nav nav-tabs nav-stacked'
	),
))
?>

</div>
<div class="span9">
<?php echo $content ?>
</div>
</div>
<?php $this->endContent() ?>
