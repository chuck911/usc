<h2><?php echo $user->name; ?></h2>
<?php echo CHtml::link('发站内邮件',array('/message/compose','id'=>$user->id),array('class'=>'btn btn-primary')) ?>

