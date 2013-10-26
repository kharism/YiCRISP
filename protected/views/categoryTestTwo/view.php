<?php
/* @var $this CategoryTestTwoController */
/* @var $model CategoryTestTwo */

$this->breadcrumbs=array(
	'Category Test Twos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CategoryTestTwo', 'url'=>array('index')),
	array('label'=>'Create CategoryTestTwo', 'url'=>array('create')),
	array('label'=>'Update CategoryTestTwo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CategoryTestTwo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategoryTestTwo', 'url'=>array('admin')),
);
?>

<h1>View CategoryTestTwo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category',
	),
)); ?>
