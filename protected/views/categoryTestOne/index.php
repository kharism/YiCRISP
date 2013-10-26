<?php
/* @var $this CategoryTestOneController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Category Test Ones',
);

$this->menu=array(
	array('label'=>'Create CategoryTestOne', 'url'=>array('create')),
	array('label'=>'Manage CategoryTestOne', 'url'=>array('admin')),
);
?>

<h1>Category Test Ones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
