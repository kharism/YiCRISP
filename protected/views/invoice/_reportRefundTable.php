<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

$dataProvider = new CArrayDataProvider($model);
$total = 0;
foreach ($model as $i) {
    $total+=$i->ammount;
}
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        'id',
        array(
            'name'=>'Name',
            'value'=>'$data->student->student_name',
            
    ),
    array(
	    'name'=>'Student Id',
	    'value'=>'$data->student->registrationId',
    ),
        array(
            'name'=>'Ammount',
            'value'=>'$data->ammount',
            'footer'=>$total,
        ),
        'date',
    )
        )
);
?>
