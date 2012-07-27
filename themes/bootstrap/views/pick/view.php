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
			<?php if (!count($pick->applications)): ?>
				暂无
			<?php endif ?>
			<ul>
				<?php foreach ($pick->applications as $application): ?>
					<li>
						<?php echo $application->user->link ?>
						<?php if ($application->confirm==1): ?>
							<span class="label label-warning">已确认</span>
						<?php elseif($application->confirm==2): ?>
							<span class="label label-info">管理员指派</span>
						<?php else: ?>
							<span class="label">未确认</span>	
						<?php endif ?>
					</li>		
				<?php endforeach ?>
			</ul>
		</div>
<?php if (Yii::app()->user->checkAccess('Pick.Assign')): ?>
		<form id="pickers" action="<?php echo $this->createUrl('pick/assign',array('id'=>$pick->id)) ?>" method="POST">
			<h4>管理员安排：</h4>
			<input type="hidden" id="assigned" name="assigned"/>
			<?php 
			$this->widget('ext.select2.ESelect2',array(
				// 'name'=>'assigned',
				'selector'=>'#assigned',
				'options'=>array(
					'placeholder'=>'输入名称',
					'minimumInputLength'=>1,
					'ajax'=>array(
						'url'=>$this->createUrl('/message/suggest/user'),
						'dataType'=>'jsonp',
						'data'=>'js:function(term,page){
							return { name_startsWith: term };
						}',
						'results'=>'js:function(data,page){
							return {results: data.users};
						}',
					),
					'formatResult'=>'js:function(data){return data.name;}',
					'formatSelection'=>'js:function(data){return data.name;}'
				)
			)); 
			?>
			<button class="btn btn-info" style="margin-top:10px;">指派此同学</button>
		</form>
	
<?php endif ?>
	</div>
</div>
