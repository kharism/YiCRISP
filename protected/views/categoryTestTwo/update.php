<?php
/* @var $this CategoryTestTwoController */
/* @var $model CategoryTestTwo */

$this->breadcrumbs=array(
	'Category Test Twos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryTestTwo', 'url'=>array('index')),
	array('label'=>'Create CategoryTestTwo', 'url'=>array('create')),
	array('label'=>'View CategoryTestTwo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CategoryTestTwo', 'url'=>array('admin')),
);
?>

<h1>Update CategoryTestTwo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>