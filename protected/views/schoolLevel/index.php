<?php
/* @var $this SchoolLevelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'School Levels',
);

$this->menu=array(
	array('label'=>'Create SchoolLevel', 'url'=>array('create')),
	array('label'=>'Manage SchoolLevel', 'url'=>array('admin')),
);
?>

<h1>School Levels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
