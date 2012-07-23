<a><?php echo CHtml::link(CHtml::image($pickedAvatar,$pickedName,array('class'=>'avatar')).' '.$pickedName,array('user/view','id'=>$pickedID)) ?></a> 选择了你接<?php echo $pickedTa ?>
<span class="actions">
<?php echo CHtml::link('查看',array('pick/aspicker'),array('class'=>'btn btn-primary')); ?>	
</span>
