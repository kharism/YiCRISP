<?php
/* @var $this RefundController */
/* @var $model Refund */

$this->breadcrumbs=array(
	'Refunds'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Refund', 'url'=>array('index')),
	array('label'=>'Create Refund', 'url'=>array('create')),
	array('label'=>'View Refund', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Refund', 'url'=>array('admin')),
);
?>

<h1>Update Refund <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>