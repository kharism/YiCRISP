<?php
/* @var $this SchoolLevelController */
/* @var $model SchoolLevel */

$this->breadcrumbs=array(
	'School Levels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SchoolLevel', 'url'=>array('index')),
	array('label'=>'Manage SchoolLevel', 'url'=>array('admin')),
);
?>

<h1>Create SchoolLevel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>