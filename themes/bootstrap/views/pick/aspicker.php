<h2>我要接谁</h2>

<table class="pickers table">
<thead>
	<tr>
		<td class="picker">要接</td>
		<td>确认留言</td>
		<td class="actions"></td>
	</tr>
</thead>
<?php foreach ($dataProvider->getData() as $application): ?>
	<tr>
		<td><?php echo CHtml::link(CHtml::image($application->pick->user->avatar).' '.$application->pick->user->name,'#') ?></td>
		<td><?php echo $application->confirmText ?></td>
		<td>
		<?php if ($application->confirm): ?>
			<span class="label label-warning">已确认</span>	
		<?php else: ?>
			<span class="label">未确认</span>	
		<?php endif ?>
		</td>
	</tr>
<?php endforeach ?>
</table>
