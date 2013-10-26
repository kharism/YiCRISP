<?php
/* @property $this AttendanceController */
/* @property $model Student */
?>
<?php foreach ($model as $id => $key): ?>
    <div class="control-group">
        <div class="span3">
            <?php echo $key->student_name; ?>
        </div>
        <label class="radio inline">
            <input type="radio" name="Attendance[attend][<?php echo $id ?>]" id="optionsRadios<?php echo $id ?>" value="1" checked>
            Attend
        </label>
        <label class="radio inline">
            <input type="radio" name="Attendance[attend][<?php echo $id ?>]" id="optionsRadios<?php echo $id ?>" value="0">
            Absent
        </label>
    </div>
<?php endforeach; ?>

