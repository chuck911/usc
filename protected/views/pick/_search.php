<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'userID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'flightNum',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'from',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'to',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'arrivalTime',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
