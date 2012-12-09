<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>求接</th>
			<!--<th>航空公司</th>
			<th>航班</th> -->
			<th>出发机场</th>
			<th>到达机场</th>
			<th>到达日期</th>
			<th>到达时间</th>
			<th>操作</th>
			<th>查看详细</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($dataProvider->getData() as $pick): ?>
		<tr>
		<td><?php echo $pick->user->link ?></td>
		<!--<td><?php echo $pick->company ?></td>
		<td><?php echo $pick->flightNum ?></td> -->
		<td><?php echo $pick->from ?></td>
		<td><?php echo $pick->to ?></td>
		<td><?php echo $pick->arrivalDate ?></td>
		<td><?php echo $pick->arrivalTime ?></td>
		<td><?php
			if($pick->userID==Yii::app()->user->id)
				echo  CHtml::link('修改信息',array('pick/update','id'=>$pick->id),array('class'=>'btn'));
			elseif(Yii::app()->user->id && User::current()->hasRequestToPick($pick->id))
				echo '<span class="label label-warning">我要接</span>';
			else
				echo CHtml::link('我来接',array('pick/apply','id'=>$pick->id),array('class'=>'btn btn-success')); ?></td>
		<td><?php echo CHtml::link('查看详细',array('pick/view','id'=>$pick->id),array('class'=>'btn')) ?></td>
		</tr>
	<?php endforeach ?>

	</tbody>
</table>
