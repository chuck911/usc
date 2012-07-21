<div class="clearfix">
<h2 class="pull-left">确认请求接机 #<?php echo $pick->id; ?></h2>
</div>

<?php $this->renderPartial('_view',array('pick'=>$pick)) ?>
<p class="help-block">【留几句话，表明你的诚意吧】</p>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'pick-application-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->textAreaRow($application,'message',array('class'=>'span9','rows'=>5)); ?>
<?php echo $form->hiddenField($application,'pickID') ?>
<div class="pull-right">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'发送请求',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
