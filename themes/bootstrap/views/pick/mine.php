<h2>谁来接我</h2>

<?php foreach ($dataProvider->getData() as $pick): ?>
<h4><?php echo CHtml::link('接机信息#'.$pick->id,array('pick/view','id'=>$pick->id)) ?></h4>
<table class="pickers table">
<thead>
	<tr>
		<td class="picker">接机人</td>
		<td>留言</td>
		<td class="actions"></td>
	</tr>
</thead>
	<?php foreach ($pick->applications as $application): ?>
	<tr>
		<td>
		<?php echo $application->user->link ?>
		</td>
		<td>
		<?php echo CHtml::encode($application->message) ?>
		</td>
		<td>
			<?php if ($application->confirm): ?>
			<span class="label label-warning">已确认</span>	
			<?php else: ?>
			<a class="confirm-btn btn" href="#" id="confirm-<?php echo $application->id ?>">选ta接我</a>	
			<?php endif ?>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php endforeach ?>

<div class="modal hide" id="confirm">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>确认由ta来接</h3>
  </div>
	<form action="<?php echo $this->createUrl('pick/confirm') ?>">
  <div class="modal-body">
			<label>捎句话吧</label>
			<input name="application_id" value="" type="hidden" id="application_id">
			<textarea class="span7" rows="4" name="pick_confirm" id="pick-confirm"></textarea>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">取消</a>
    <button type="submit" class="btn btn-primary">确认</button>
  </div>
	</form>
</div>
<script>
$(function(){
	$('.confirm-btn').click(function(){
		$('#application_id').val($(this).attr('id').replace('confirm-',''));
		$('#confirm').modal();
		return false;
	});
});
</script>

