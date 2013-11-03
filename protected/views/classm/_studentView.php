<?php
/* @var $students Student */
/* @var $model Student */
?>
<?php foreach($students as $model):?>
<table>
    <tr>
        <td>Id</td>
        <td><?echo  $model->getRegistrationId() ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?echo  $model->student_name ?></td>
    </tr>
    <tr>
        <td>Grade</td>
        <td><?echo  $model->grade ?></td>
    </tr>
    <tr>
        <td>Location</td>
        <td><?echo  $model->School->school_name.'('.$model->Class->class.')'; ?></td>
    </tr>
    <tr>
        <td>Contact Information</td>
        <td>
            <table>
                <tr>
                    <td>Father</td>
                    <td><?php echo $model->Parent->father_phone?></td>
                </tr>
                <tr>
                    <td>Mother</td>
                    <td><?php echo $model->Parent->mother_phone?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            Period
        </td>
        <td>
            <?php echo $model->Class->Terms->range?>
        </td>
    </tr>
</table>
<img src="<?php echo Yii::app()->createAbsoluteUrl('classm/GetStudentPerformance',array('id'=>$model->id));?>"/>
<?php 
	$res = TestResult::model()->getStudentCurrentResult($model->id);
		$data = array();
		$dummy = array();
		//var_dump($res);
		foreach($res as $t){
			$dummy[$t->test->category_one][] = $t->mark;
		}
		$legends = array();
		foreach($dummy as $key=>$t){
			$legends[$key] = CategoryTestOne::model()->findByPk($key)->category;
			$temp = array($key);
			foreach($t as $r){
				$temp[] = $r;
			}
			$data[] = $temp;
		}
?>
<?php foreach($dummy as $key=>$tab):?>
<div>
	<h3>Test Category <?php echo $legends[$key]?></h3>
	<table border="1">
		<thead>
			<tr>
				<th>Test</th>
				<th>Mark</th>
			</tr>
		</thead>
		<?php foreach($tab as $id=>$yy):?>
		<tr>
			<td><?php echo $id+1?></td>
			<td><?php echo $yy?></td>
		</tr>
		<?php endforeach;?>
	</table>
</div>
<?php endforeach;?>
<span class="breakHere"></span>
<?php endforeach;?>
