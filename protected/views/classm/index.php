<?php
/* @var $this ClassmController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Classms',
);

$this->menu=array(
	array('label'=>'Create Classm', 'url'=>array('create')),
	array('label'=>'Manage Classm', 'url'=>array('admin')),
);
?>

<h1>Classms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
