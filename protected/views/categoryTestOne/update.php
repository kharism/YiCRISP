<?php
/* @var $this CategoryTestOneController */
/* @var $model CategoryTestOne */

$this->breadcrumbs=array(
	'Category Test Ones'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryTestOne', 'url'=>array('index')),
	array('label'=>'Create CategoryTestOne', 'url'=>array('create')),
	array('label'=>'View CategoryTestOne', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CategoryTestOne', 'url'=>array('admin')),
);
?>

<h1>Update CategoryTestOne <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>