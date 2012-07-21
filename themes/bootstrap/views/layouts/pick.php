<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
<div class="span3"> 
<!--<a class="btn btn-large widget" href="<?php echo $this->createUrl('pick/create') ?>" id="btn-pick">求接机</a>-->
<?php 
$this->widget('zii.widgets.CMenu',array(
	'items'=>array(
		array('label'=>'接机信息', 'url'=>array('pick/index')),
		array('label'=>'求接机', 'url'=>array('pick/create')),
		array('label'=>'谁来接我','url'=>array('pick/mine')),
		array('label'=>'我要接谁','url'=>array('pick/aspicker')),
	),
	'htmlOptions'=>array(
		'class'=>'nav nav-tabs nav-stacked'
	),
))
?>
<div class="well widget">
	<h4>接机小贴士</h4>
	<ul>
		<li>事项1</li>	
		<li>事项2</li>
		<li>事项3</li>
		<li>事项4</li>
	</ul>
</div>
</div>
<div class="span9">
<?php echo $content ?>
</div>
</div>
<?php $this->endContent() ?>
