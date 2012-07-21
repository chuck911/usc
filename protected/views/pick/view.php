<?php
$this->breadcrumbs=array(
	'Picks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pick','url'=>array('index')),
	array('label'=>'Create Pick','url'=>array('create')),
	array('label'=>'Update Pick','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Pick','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pick','url'=>array('admin')),
);
?>

<h1>View Pick #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'userID',
		'flightNum',
		'from',
		'to',
		'arrivalTime',
	),
)); ?>
