<?php
/* @var $this SchoolLevelController */
/* @var $model SchoolLevel */

$this->breadcrumbs=array(
	'School Levels'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SchoolLevel', 'url'=>array('index')),
	array('label'=>'Create SchoolLevel', 'url'=>array('create')),
	array('label'=>'View SchoolLevel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SchoolLevel', 'url'=>array('admin')),
);
?>

<h1>Update SchoolLevel <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>