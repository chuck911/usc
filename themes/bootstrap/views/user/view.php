<h2><?php echo $user->name; ?></h2>

<a class="btn btn-primary" href="<?php echo $this->createUrl('/message/compose',array('id'=>$user->id)) ?>">发站内邮件</a>

<table class="table" id="user-details">
	<tbody>
		<tr><th style="width:30px;">性别</th><td><?php echo $user->gender ?></td></tr>
		<tr><th style="width:30px;">家乡</th><td><?php echo $user->homeProvince.' '.$user->homeCity ?></td></tr>
	</tbody>
</table>

