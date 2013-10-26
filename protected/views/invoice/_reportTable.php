<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
$dataProvider = new CArrayDataProvider($model);
$total = 0;
foreach($model as $i){
    $total+=$i->ammount;
}
$this->widget('zii.widgets.grid.CGridView',array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id',
        array(
            'name'=>'Payment Method',
            'value'=>'$data->payment_name->name',
        ),
        'refferal_id',
        array(
            'name'=>'Student Name',
            'value'=>'$data->student->student_name',
    ), 
	'grade_received',    
    array('name'=>'Student ID',
   	'value'=>'$data->student->registrationId'), 
        array(
            'name'=>'Ammount',
            'value'=>'$data->ammount',
            'footer'=>$total,
        ),
        'date',
    ),
));
