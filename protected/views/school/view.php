<?php
/* @var $this SchoolController */
/* @var $model School */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List School', 'url'=>array('index')),
	array('label'=>'Create School', 'url'=>array('create')),
	array('label'=>'Update School', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete School', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage School', 'url'=>array('admin')),
	array('label'=>'Prinout', 'url'=>array('school/printout','id'=>$model->id)),
);
?>

<h1>View School #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category_school',
		'state',
		'city',
		'level_of_school',
	),
)); ?>
<h3>Graph</h3>
1st Grade
<?php echo CHtml::image($this->createAbsoluteUrl('school/getPerformance',array('id'=>$model->id,'grade_id'=>1)))?><br/>
2nd Grade
<?php echo CHtml::image($this->createAbsoluteUrl('school/getPerformance',array('id'=>$model->id,'grade_id'=>2)))?><br/>
3rd Grade
<?php echo CHtml::image($this->createAbsoluteUrl('school/getPerformance',array('id'=>$model->id,'grade_id'=>3)))?><br/>
4st Grade
<?php echo CHtml::image($this->createAbsoluteUrl('school/getPerformance',array('id'=>$model->id,'grade_id'=>4)))?><br/>
5st Grade
<?php echo CHtml::image($this->createAbsoluteUrl('school/getPerformance',array('id'=>$model->id,'grade_id'=>5)))?><br/>
6th Grade
<?php echo CHtml::image($this->createAbsoluteUrl('school/getPerformance',array('id'=>$model->id,'grade_id'=>6)))?><br/>
