<h2>用户管理</h2>

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		array('name'=>'avatar','type'=>'image'),
		'gender',
		/*'homeProvince',
		
		'homeCity',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'template'=>'{view} {delete}',
		),
	),
)); ?>
