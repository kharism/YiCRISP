<?php
/* @var $this StudentController */
/* @var $model Student */

$this->breadcrumbs = array(
    'Students' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Student', 'url' => array('index')),
    array('label' => 'Create Student', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#student-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Students</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$class = array(''=>'All');
$classFilter = CHtml::dropDownList('Student[class]', $model->class, CHtml::listData(Classm::model()->findAllByAttributes(array('school_id'=>@$_GET['Student']['school_id'])), 'id', 'class'));

if(isset($model->class) && $model->Class->school_id != $model->school_id){
    $model->unsetAttributes(array('class'));
}
$dp = $model->search();
//$dp->setSort(array('attributes'=>array('id','student_name','school_id','grade','class','reg2')));
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'student-grid',
    'dataProvider' => $dp,
    'filter' => $model,
    'htmlOptions' => array('style' => 'width:90%'),
    'columns' => array(
        'id',
        'student_name',
        array(
            'value' => '$data->School->school_name',
            'filter' => CHtml::dropDownList('Student[school_id]', @$_GET['Student']['school_id'], CHtml::listData(School::model()->findAll(), 'id', 'school_name')),
            'header' => 'School Name',
            'name'=>'school_id',
        ),
        'grade',
        array(
            'value' => '$data->Class->class',
            'filter'=> $classFilter,
            'header' => 'Class',
            'name'=>'class',
        ),
        array(
            'value'=>'$data->registrationId',
            'name'=>'reg2',
            'header'=>'Registration Id',
            'filter'=>CHtml::textField('Student[reg2]', @$_GET['Student']['reg2']),
        ),
        
        /*
          'student_nick_name',
          'gender',
          'date_of_birth',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {logs}',
            'buttons'=>array(
				'logs'=>array(
					'label'=>'',
					'url'=>'Yii::app()->createUrl("log/viewLog",array("model"=>"Student","model_id"=>$data->id))',
					'options'=>array(
						'class'=>' icon-exclamation-sign'
					),
				),
            ),
        ),
    ),
));
?>
