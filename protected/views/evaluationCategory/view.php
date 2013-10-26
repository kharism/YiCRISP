<?php
/* @var $this EvaluationCategoryController */
/* @var $model EvaluationCategory */

$this->breadcrumbs=array(
	'Evaluation Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EvaluationCategory', 'url'=>array('index')),
	array('label'=>'Create EvaluationCategory', 'url'=>array('create')),
	array('label'=>'Update EvaluationCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EvaluationCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EvaluationCategory', 'url'=>array('admin')),
);
?>

<h1>View EvaluationCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'evaluation',
		'mistakes',
		'time',
	),
)); ?>
