<?php
/* @var $this ClassmController */
/* @var $model Classm */

$this->breadcrumbs=array(
	'Classms'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Classm', 'url'=>array('index')),
	array('label'=>'Create Classm', 'url'=>array('create')),
	array('label'=>'Update Classm', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Classm', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Classm', 'url'=>array('admin')),
);
?>

<h1>View Classm #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
    //'htmlOptions'=>array('class'=>'table'),
	'attributes'=>array(
		//'id',        
        'grade',
		'class',
        
	),
)); ?>
<h3>Graph</h3>
<?php echo CHtml::image($this->createAbsoluteUrl('classm/classPerformanceGraph', array('id'=>$model->id)))?>