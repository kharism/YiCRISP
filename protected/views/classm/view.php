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
<?php for($i=1;$i<=9;$i++):?>
	<a href="<?php echo $this->createUrl("levelClass/view",array("level"=>$i,"class"=>$model->id))?>"><h4>Level <?php echo $i?> : <?php echo $model->getStudentCount($i);?> Student(s)</h4></a>
<?php endfor;?>
<?php //echo CHtml::image($this->createAbsoluteUrl('classm/classPerformanceGraph', array('id'=>$model->id)))?>
