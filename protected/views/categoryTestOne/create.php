<?php
/* @var $this CategoryTestOneController */
/* @var $model CategoryTestOne */

$this->breadcrumbs=array(
	'Category Test Ones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoryTestOne', 'url'=>array('index')),
	array('label'=>'Manage CategoryTestOne', 'url'=>array('admin')),
);
?>

<h1>Create CategoryTestOne</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>