<?php
/* @var $this EvaluationCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Evaluation Categories',
);

$this->menu=array(
	array('label'=>'Create EvaluationCategory', 'url'=>array('create')),
	array('label'=>'Manage EvaluationCategory', 'url'=>array('admin')),
);
?>

<h1>Evaluation Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
