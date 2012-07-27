<h2>设置</h2>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>64)); ?>
	
	<label>性别</label>
	<?php echo $form->dropDownList($model,'gender',array('男'=>'男','女'=>'女','-'=>'保密')); ?>

	<div>
	<label>家乡</label>
	<?php echo $form->textField($model,'homeProvince',array('class'=>'span1')); ?> 省
	<?php echo $form->textField($model,'homeCity',array('class'=>'span1')); ?>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? '新建' : '保存',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
