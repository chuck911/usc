<?php
$this->breadcrumbs=array(
	'Picks',
);

$this->menu=array(
	array('label'=>'Create Pick','url'=>array('create')),
	array('label'=>'Manage Pick','url'=>array('admin')),
);
?>

<h1>Picks</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
