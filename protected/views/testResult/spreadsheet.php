<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<table style="width:80%">
    <thead>
        <th>Name</th>
        <th>Answered</th>
        <th>Mistake</th>
        <th>Time (Minute)</th>
        <th>Time (Seconds)</th>
    </thead>
    <tbody>
        <?php foreach($model as $i=>$testResult):?>
        <tr>
            <?php echo CHtml::activeHiddenField($testResult, "[$i]id");?>
            <td><?php echo $testResult->student->student_name;?></td>
            <td><?php echo CHtml::activeTextField($testResult,"[$i]answered",array('style'=>'width:70px')); ?></td>
            <td><?php echo CHtml::activeTextField($testResult,"[$i]mistake",array('style'=>'width:70px')); ?></td>
            <td><?php echo CHtml::activeTextField($testResult,"[$i]time_minute",array('style'=>'width:70px')); ?></td>
            <td><?php echo CHtml::activeTextField($testResult,"[$i]time_second",array('style'=>'width:70px')); ?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>