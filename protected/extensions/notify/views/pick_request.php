<a><?php echo CHtml::link(CHtml::image($pickerAvatar,$pickerName,array('class'=>'avatar')).' '.$pickerName,array('user/view','id'=>$pickerID)) ?></a> 想要接你!
<span class="actions">
<?php echo CHtml::link('查看',array('pick/mine'),array('class'=>'btn btn-primary')); ?>	
</span>
