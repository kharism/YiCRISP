<?php
/* @var $this RefundController */
/* @var $model Refund */

$this->breadcrumbs=array(
	'Refunds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Refund', 'url'=>array('index')),
	array('label'=>'Manage Refund', 'url'=>array('admin')),
);
?>

<h1>Create Refund</h1>

<?php echo $this->renderPartial('_formCreate', array('model'=>$model)); ?>