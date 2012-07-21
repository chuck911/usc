<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
<div class="span3"> 
<!--<a class="btn btn-large widget" href="<?php echo $this->createUrl('pick/create') ?>" id="btn-pick">求接机</a>-->
<?php if($this->user) echo CHtml::image($this->user->avatar()) ?>
<?php 
$this->widget('zii.widgets.CMenu',array(
	'items'=>array(
		//array('label'=>'接机信息', 'url'=>array('pick/index')),
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
