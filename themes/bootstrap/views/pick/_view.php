<table class="detail-view table table-striped table-condensed" id="pick-details">
	<tbody>
		<tr class="odd">
			<th><?php echo CHtml::image($pick->user->avatar); ?></th>
			<td><?php echo CHtml::link($pick->user->name) ?></td>
		</tr>
		<tr class="even"><th>航空公司</th><td><?php echo $pick->company ?></td></tr>
		<tr class="even"><th>航班号</th><td><?php echo $pick->flightNum ?></td></tr>
		<tr class="odd"><th>出发机场</th><td><?php echo $pick->from ?></td></tr>
		<tr class="even"><th>到达机场</th><td><?php echo $pick->to ?></td></tr>
		<tr class="odd"><th>到达时间</th><td><?php echo $pick->arrivalTime ?></td></tr>
		<tr class="odd"><th>到达日期</th><td><?php echo $pick->arrivalDate ?></td></tr>
		<tr class="odd"><th>留言</th><td><?php echo $pick->info ?></td></tr>
	</tbody>
</table>

