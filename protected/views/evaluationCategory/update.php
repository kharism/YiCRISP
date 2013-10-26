<?php
/* @var $this EvaluationCategoryController */
/* @var $model EvaluationCategory */

$this->breadcrumbs=array(
	'Evaluation Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EvaluationCategory', 'url'=>array('index')),
	array('label'=>'Create EvaluationCategory', 'url'=>array('create')),
	array('label'=>'View EvaluationCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EvaluationCategory', 'url'=>array('admin')),
);
?>

<h1>Update EvaluationCategory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>