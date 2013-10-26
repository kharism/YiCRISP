<?php
/* @var $this SchoolCategoryController */
/* @var $model SchoolCategory */

$this->breadcrumbs=array(
	'School Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SchoolCategory', 'url'=>array('index')),
	array('label'=>'Create SchoolCategory', 'url'=>array('create')),
	array('label'=>'Update SchoolCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SchoolCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SchoolCategory', 'url'=>array('admin')),
);
?>

<h1>View SchoolCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category_of_school',
	),
)); ?>
