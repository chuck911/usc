<?php $this->pageTitle=Yii::app()->name . ' - ' . MessageModule::t("Compose Message"); ?>
<?php $isIncomeMessage = $viewedMessage->receiver_id == Yii::app()->user->getId() ?>

<table class="table table-condensed" id="view-message">
	<tbody>
		<tr>
			<?php if ($isIncomeMessage): ?>
			<td width="40px">来自: </td><td> <?php echo $viewedMessage->getSenderName() ?></td>
			<?php else: ?>
			<td width="40px">发给: </td><td><?php echo $viewedMessage->getReceiverName() ?></td>
			<?php endif; ?>	
		</tr>
		<tr>
			<td>时间: </td>
			<td><?php echo date('Y-m-d h:i:s', strtotime($viewedMessage->created_at)) ?></td>	
		</tr>
		<tr>
			<td>主题: </td>
			<td><h4><?php echo CHtml::encode($viewedMessage->subject) ?></h4></td>	
		</tr>
		<tr>
			<td>内容: </td>
			<td><?php echo CHtml::encode($viewedMessage->body) ?></td>	
		</tr>
	</tbody>
</table>


<?php if ($isIncomeMessage): ?>
	<h4>回复：</h4>
<?php else: ?>
	<h4>再发一封：</h4>
<?php endif; ?>

<div class="form">
	<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
		'id'=>'message-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<?php echo $form->errorSummary($message); ?>

	<?php echo $form->hiddenField($message,'receiver_id'); ?>

	<?php echo $form->textFieldRow($message,'subject'); ?>
	<?php echo $form->textAreaRow($message,'body',array('class'=>'span6','rows'=>4)); ?>
	<div>
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'回复',
		)); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>
