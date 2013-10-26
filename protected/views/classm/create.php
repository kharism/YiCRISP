<?php
/* @var $this ClassmController */
/* @var $model Classm */

$this->breadcrumbs=array(
	'Classms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Classm', 'url'=>array('index')),
	array('label'=>'Manage Classm', 'url'=>array('admin')),
);
?>

<h1>Create Classm</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>