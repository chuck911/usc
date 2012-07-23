<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Compose Message"); ?>

<h2>写新邮件</h2>

<div class="form">
	<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
		'id'=>'message-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<?php echo $form->errorSummary($model); ?>

	<label for="Message_receiver_id" class="required">收件人名称 <span class="required">*</span></label>
	<?php echo CHtml::textField('receiver', $receiverName) ?>
	<?php echo $form->hiddenField($model,'receiver_id'); ?>
	<?php echo $form->error($model,'receiver_id'); ?>

	<?php echo $form->textFieldRow($model,'subject'); ?>
	<?php echo $form->textAreaRow($model,'body',array('class'=>'span6','rows'=>4)); ?>

	<div>
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'发送',
		)); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>
