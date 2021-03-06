<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $this->pageTitle ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl.'/assets/app.css' ?>" type="text/css">
</head>
<body>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a href="/index.php" class="brand"><?php echo CHtml::encode(Yii::app()->name); ?></a>
			<?php
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
					// array('label'=>'Home', 'url'=>array('/site/index')),
					// array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'接机', 'url'=>array('/pick/index')),
					array('label'=>'权限管理','url'=>array('/rights'),'visible'=>Yii::app()->user->checkAccess('Admin')),
					array('label'=>'用户管理','url'=>array('/user/admin'),'visible'=>Yii::app()->user->checkAccess('Admin')),
				),
				'htmlOptions'=>array('class'=>'nav'),
			));
			?>
			<ul class="pull-right nav">
				<?php if(!Yii::app()->user->isGuest): ?>
				<li id="mail-btn"><a href="<?php echo $this->createUrl('/message/inbox') ?>" title="邮件">
					<span>
					<?php if (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())): ?>
					<?php echo Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()); ?>
					<?php endif; ?>	
					</span></a></li>
				<li><a href="<?php echo $this->createUrl('/notification') ?>" title="提醒">
					<?php $this->widget('ext.notify.NotifyLabel') ?></a></li>
				
				<li class="divider-vertical"></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<img height="19" src="<?php echo User::current()->avatar ?>" alt="头像">
						<?php echo User::current()->name ?> <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li class=""><?php echo CHtml::link('设置',array('user/setting','id'=>User::current()->id)) ?></li>
						<li class=""><?php echo CHtml::link('我的主页',array('user/view','id'=>User::current()->id)) ?></li>
						<li class="divider"></li>
						<li class=""><a href="/index.php/site/logout">登出</a></li>
					</ul>
				</li>
			<?php else: ?>
				<li><?php echo CHtml::link('登录',array('site/login')) ?></li>
			<?php endif ?>
			</ul>
		</div>
	</div>
</div>
	<div class="container">
	<?php echo $content ?>
	</div>
</body>
</html>
