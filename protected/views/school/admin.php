<?php
/* @var $this SchoolController */
/* @var $model School */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List School', 'url'=>array('index')),
	array('label'=>'Create School', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#school-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Manage Schools</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'school-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'htmlOptions'=>array('style'=>'width:80%'),
	'columns'=>array(
		'id',
		'school_name',
                array(
                    'value'=>'$data->Category->category_of_school',
                    'filter'=>  CHtml::dropDownList('School[category_school]', @$_GET['School']['category_school'], CHtml::listData(SchoolCategory::model()->findAll(), 'id', 'category_of_school')),
                    'header'=>'School Category',
                ),
            array(
                'value'=>'$data->State->state_name',
                'header'=>'State',
                'filter'=>CHtml::dropDownList('School[state]', @$_GET['School']['state'], CHtml::listData(State::model()->findAll(), 'id', 'state_name')),
            ),
            array(
				'value'=>'$data->City->city_name',
				'header'=>'City',
				'filter'=>CHtml::dropDownList('School[city]',@$_GET['School']['state'],CHtml::listData(City::model()->findAll(),'id','city_name')),
            ),
            array(
				'value'=>'$data->Level->school_level',
				'header'=>'Level',
				'filter'=>CHtml::dropDownList('School[level]',@$_GET['School']['level'],CHtml::listData(SchoolLevel::model()->findAll(),'id','school_level')),
            ),		
		
        
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array(
				'print'=>array(
					'label'=>'',
					'url'=>'Yii::app()->createUrl("school/printout", array("id"=>$data->id))',
					'options'=>array('class'=>'icon-print'),
					
				)
			),
			'template'=>'{view} {update} {print}'
		),
	),
)); 

?>
