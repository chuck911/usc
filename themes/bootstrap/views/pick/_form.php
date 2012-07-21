<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/assets/datepicker.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/bootstrap-datepicker.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/assets/timepicker.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/bootstrap-timepicker.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/bootstrap-datepicker.zh-CN.js');
Yii::app()->clientScript->registerScript('datepicker','$(".datepicker").datepicker({format:"yyyy-mm-dd",language:"zh-CN",autoclose:true});');
Yii::app()->clientScript->registerScript('timepicker','$(".timepicker").timepicker({minuteStep:5,defaultTime:"value",showMeridian:false});');
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'pick-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"> <span class="required">*</span>为必填项</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'company',array('class'=>'span5','maxlength'=>32)); ?>
	<?php echo $form->textFieldRow($model,'flightNum',array('class'=>'span3','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'from',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'to',array('class'=>'span5','maxlength'=>32)); ?>

	<label for="Pick_arrivalTime" class="required">到达时间 <span class="required">*</span></label>
	<input class="span5 timepicker" name="Pick[arrivalTime]" id="Pick_arrivalTime" type="text" value="<?php echo substr($model->arrivalTime,0,5) ?>">
	
	<label for="Pick_arrivalDate" class="required">到达日期 <span class="required">*</span></label>
	<input class="span5 datepicker" name="Pick[arrivalDate]" id="Pick_arrivalDate" type="text" value="<?php echo $model->arrivalDate ?>">

	<?php echo $form->textAreaRow($model,'info',array('class'=>'span6','rows'=>4)); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? '填写完毕' : '保存修改',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
