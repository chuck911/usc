<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Messages:inbox"); ?>

<h2>收件箱</h2>

<?php if ($messagesAdapter->data): ?>
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-delete-form',
		'enableAjaxValidation'=>false,
		'action' => $this->createUrl('delete/')
	)); ?>

	<table class="table">
		<tr>
			<th>来自</th>
			<th>主题</th>
			<th>时间</th>
		</tr>
		<?php foreach ($messagesAdapter->data as $index => $message): ?>
			<tr class="<?php echo $message->is_read ? 'read' : 'unread' ?>">
				<td>
					<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
					<?php echo $form->hiddenField($message,"[$index]id"); ?>
					<?php echo $message->getSenderName(); ?>
				</td>
				<td><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
				<td><span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
			</tr>
		<?php endforeach ?>
	</table>

	<div>
		<?php echo CHtml::submitButton('删除所选邮件'); ?>
	</div>

<?php $this->endWidget(); ?>
	<?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
<?php endif; ?>
