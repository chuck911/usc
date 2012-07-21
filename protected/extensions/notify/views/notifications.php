<ul class="notifications">
<?php foreach ($this->notifications as $notification): ?>
	<li><?php $this->render($notification->type,json_decode($notification->data,true)) ?></li>
<?php endforeach ?>
</ul>
