<?php
/* @var $this CategoryTestTwoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Category Test Twos',
);

$this->menu=array(
	array('label'=>'Create CategoryTestTwo', 'url'=>array('create')),
	array('label'=>'Manage CategoryTestTwo', 'url'=>array('admin')),
);
?>

<h1>Category Test Twos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
