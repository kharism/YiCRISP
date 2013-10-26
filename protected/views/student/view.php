<?php
/* @var $this StudentController */
/* @var $model Student */

$this->breadcrumbs = array(
    'Students' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Student', 'url' => array('index')),
    array('label' => 'Create Student', 'url' => array('create')),
    array('label' => 'Update Student', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Student', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Student', 'url' => array('admin')),
    array('label' => 'Get Report File','url'=>array('report','id' => $model->id,'forPDF'=>1)),
);
?>

<h1>View Student #<?php echo $model->id; ?></h1>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'registrationId',
        'student_name',
        'School.school_name',
        'grade',
        'Class.class',
        'absence_number',
        'student_nick_name',
        'sex',
        'date_of_birth',
        'age',
    ),
));
?>
<h3>Performance</h3>
<?php
$performanceDP = new CArrayDataProvider($performance,array());
$tableCSS = array('style'=>'width:80%;margin-left:-40px');
if(@$forPDF!=null)
    $tableCSS = array('style'=>'width:80%;margin-left:0px');
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $performanceDP,
    'htmlOptions' => $tableCSS,
    'columns' => array(
        array(
            'name'=>'Test ID',
            'value'=>'$data->test->id',
        ),
        array(
            'value'=>'$data->answered',
            'name'=>'Answered',
        ),
        array(
            'value'=>'$data->mistake',
            'name'=>'Mistake',
        ),
        array(
            'name'=>'Time(second)',
            'value'=>'60*$data->time_minute+$data->time_second',
        ),
        array(
            'name'=>'Mark',
            'value'=>'$data->mark',
        ),
        array(
            'name'=>'Target Time',
            'value'=>'$data->targetTime',
        ),
        array(
            'name'=>'Predicted Time',
            'value'=>'round($data->predictedTime,2)',
        ),
        array(
            'name'=>'Predicted Mistake',
            'value'=>'ceil($data->predictedMistake)',
        ),
        array(
            'name'=>'Calculated Time',
            'value'=>'round($data->calculatedTime,2)',
        ),
        array(
            'name'=>'Calculated Mark',
            'value'=>'round($data->calculatedMark,2)'
        )
    ),
        )
);?>

<h3>Html Image</h3>
<?php if(@$forPDF==null):?>
<img src="<?php echo $this->createAbsoluteUrl('student/performancegraph', array('id'=>$model->id))?>"/>
<?php else:?>
<?php 
    $this->actionPerformanceGraph($model->id);
?>
<?php echo CHtml::image("http://localhost/juku/protected/temp.png",'');//Yii::app()->baseUrl.'/temp.png'?>
<?php endif;?>


    <?php /**
$y = $this->createAbsoluteUrl('student/performancegraph', array('id'=>$model->id));
echo $y;
$infos=getimagesize('http://localhost/juku/testDrive/index.php?r=student/performancegraph&&id=1');
var_dump($infos);*/
?>