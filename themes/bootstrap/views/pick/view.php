<div class="clearfix">
	<h2 class="pull-left">接机信息 #<?php echo $pick->id; ?></h2>
	<?php 
	if($pick->userID==Yii::app()->user->id)
		echo  CHtml::link('修改信息',array('pick/update','id'=>$pick->id),array('class'=>'btn btn-large i-pick-btn'));
	elseif(Yii::app()->user->id && User::current()->hasRequestToPick($pick->id))
		echo CHtml::link('我要接','javascript:void(0)',array('class'=>'btn btn-warning btn-large i-pick-btn'));
	else
		echo CHtml::link('我来接',array('pick/apply','id'=>$pick->id),array('class'=>'btn btn-success btn-large i-pick-btn'));
	?>
	
</div>

<div class="row">
	<div class="span6">
		<?php $this->renderPartial('_view',array('pick'=>$pick)) ?>
	</div>
	<div class="span3">
		<div class="well widget" id="pickers">
		<h4>打算接ta的人：</h4>
		<ul>
			<?php foreach ($pick->applications as $application): ?>
			<li>
				<a href="#">
					<?php echo CHtml::image($application->user->avatar,$application->user->name) ?>
					<?php echo $application->user->name ?>
				</a>
				<?php if ($application->confirm): ?>
					<span class="label label-warning">已确认</span>	
				<?php else: ?>
					<span class="label">未确认</span>	
				<?php endif ?>
			</li>		
			<?php endforeach ?>
		</ul>
		<div>
	</div>
</div>
