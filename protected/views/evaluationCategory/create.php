<?php
/* @var $this EvaluationCategoryController */
/* @var $model EvaluationCategory */

$this->breadcrumbs=array(
	'Evaluation Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EvaluationCategory', 'url'=>array('index')),
	array('label'=>'Manage EvaluationCategory', 'url'=>array('admin')),
);
?>

<h1>Create EvaluationCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>