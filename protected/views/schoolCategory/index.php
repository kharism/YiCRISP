<?php
/* @var $this SchoolCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'School Categories',
);

$this->menu=array(
	array('label'=>'Create SchoolCategory', 'url'=>array('create')),
	array('label'=>'Manage SchoolCategory', 'url'=>array('admin')),
);
?>

<h1>School Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
