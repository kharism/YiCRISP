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
<span class="breakHere"></span>
<?php endforeach;?>