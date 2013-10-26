<?php
/* @var $this ClassmController */
/* @var $model Classm */

$this->breadcrumbs=array(
	'Classms'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Classm', 'url'=>array('index')),
	array('label'=>'Create Classm', 'url'=>array('create')),
	array('label'=>'View Classm', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Classm', 'url'=>array('admin')),
);
?>

<h1>Update Classm <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>