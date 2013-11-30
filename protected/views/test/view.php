<?php
/* @var $this TestController */
/* @var $model Test */

$this->breadcrumbs=array(
	'Tests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Test', 'url'=>array('index')),
	array('label'=>'Create Test', 'url'=>array('create')),
	array('label'=>'Update Test', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Test', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Test', 'url'=>array('admin')),
);
?>

<h1>View Test #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
    'htmlOptions'=>array(
        'class'=>'table',
    ),
	'attributes'=>array(
		'id',
		'CategoryOne.category',
		'date',
		//'exercise_id',
		//'number_of_question',
		/*'time_limit',
		'time_counted',
		'mistakes',
		'time_predicted',
		'evaluation_category',
		'school',
		'class',
		'student',*/
	),
)); ?>
<h3>Result</h3>
<?php 
    $avg = $model->Average;
    //var_dump($avg);
    $average = new CArrayDataProvider($avg,array(        
    ));
    $average->keyField=false;
    //var_dump($average->getData());
    $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $average,
    'htmlOptions' => array('style'=>'width:80%;margin-left:-40px'),
    'columns' => array(
        array(
            'name'=>'Class Name',
            'value'=>'Classm::model()->findByPk($data["class_id"])->class',
        ),
        array(
            'name'=>'Average',
            'value'=>'sprintf("%.2f",$data["average"])',
        ),
    )));
?>