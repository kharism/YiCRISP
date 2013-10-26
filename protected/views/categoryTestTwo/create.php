<?php
/* @var $this CategoryTestTwoController */
/* @var $model CategoryTestTwo */

$this->breadcrumbs=array(
	'Category Test Twos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoryTestTwo', 'url'=>array('index')),
	array('label'=>'Manage CategoryTestTwo', 'url'=>array('admin')),
);
?>

<h1>Create CategoryTestTwo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>