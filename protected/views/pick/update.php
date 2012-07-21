<?php
$this->breadcrumbs=array(
	'Picks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pick','url'=>array('index')),
	array('label'=>'Create Pick','url'=>array('create')),
	array('label'=>'View Pick','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Pick','url'=>array('admin')),
);
?>

<h1>Update Pick <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>