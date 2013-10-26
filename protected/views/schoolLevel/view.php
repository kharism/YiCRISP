<?php
/* @var $this SchoolLevelController */
/* @var $model SchoolLevel */

$this->breadcrumbs=array(
	'School Levels'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SchoolLevel', 'url'=>array('index')),
	array('label'=>'Create SchoolLevel', 'url'=>array('create')),
	array('label'=>'Update SchoolLevel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SchoolLevel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SchoolLevel', 'url'=>array('admin')),
);
?>

<h1>View SchoolLevel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'school_level',
	),
)); ?>
