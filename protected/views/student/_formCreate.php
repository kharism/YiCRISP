<?php
/* @var $this StudentController */
/* @var $model Student */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'student-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php foreach ($model->errors as $key => $value): ?>
        <div class="alert alert-error">
            <p><?php var_dump($value) ?></p>
        </div>
    <?php endforeach; ?>
    <?php foreach ($modelParent->errors as $key => $value): ?>
        <div class="alert alert-error">
            <p><?php var_dump($value); ?></p>
        </div>
    <?php endforeach; ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'student_name'); ?>
        <?php echo $form->textField($model, 'student_name', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'student_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'gender'); ?>
        <?php echo $form->dropdownList($model, 'gender', array(1 => 'Male', 0 => 'Female')); ?>
        <?php echo $form->error($model, 'gender'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'place_of_birth'); ?>
        <?php echo $form->textField($model, 'place_of_birth', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'place_of_birth'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_of_birth'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'date_of_birth',
            'options' => array(
                'changeYear' => true,
                'changeMonth' => true,
                'dateFormat' => 'yy-mm-dd',
            )
        ));
        ?>
        <?php echo $form->error($model, 'date_of_birth'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'school_id'); ?>
        <?php
        $datalist = array('-1' => 'Select School');
        $datalist = array_merge($datalist, CHtml::listData(School::model()->findAll(), 'id', 'school_name'))
        ?>
        <?php
        echo $form->dropDownList($model, 'school_id', $datalist, array(
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('classm/AjaxGetAllClass'),
		//'update' => '#Student_class',
		'success'=>'js:function(data){
			$("#Student_class").html(data);
			$("#Student_class").change();
		}'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'school_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'emergency_telephone'); ?>
        <?php echo $form->textField($model, 'emergency_telephone', array('size' => 16, 'maxlength' => 16)); ?>
        <?php echo $form->error($model, 'emergency_telephone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'birth_order'); ?>
        <?php echo $form->textField($model, 'birth_order', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'birth_order'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'students_of'); ?>
        <?php echo $form->textField($model, 'students_of', array('size' => 60, 'maxlength' => 60)); ?>
        <?php echo $form->error($model, 'students_of'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'home_address'); ?>
        <?php echo $form->textField($model, 'home_address', array('size' => 60, 'maxlength' => 60)); ?>
        <?php echo $form->error($model, 'home_address'); ?>
    </div>
    <?php
    $availableClass = array();
    if (!$model->isNewRecord) {
        $availableClass = CHtml::listData(Classm::model()->findAllByAttributes(array('school_id' => $model->school_id)), 'id', 'class');
    }
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'class'); ?>
        <?php echo $form->dropDownList($model, 'class', $availableClass); ?>
        <div id="Student_class_detail"></div>
        <script>
            $("#Student_class").change(function() {
                jQuery.ajax({
                    'url': '<?php echo $this->createAbsoluteUrl('classm/ajaxGetDetail/') ?>&id=' + $(this).val(),
                    'type': 'POST',
                    'success':function(data){
                        $("#Student_class_detail").html(data);
                    }
                })
            })
        </script>
<?php echo $form->error($model, 'class'); ?>
    </div>
    <div class="row">
<?php echo $form->labelEx($model, 'grade'); ?>
        <?php echo $form->dropDownList($model, 'grade', array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9')); ?>
        <?php echo $form->error($model, 'grade'); ?>
    </div>
    <div class="row">
<?php echo $form->labelEx($model, 'parent_id'); ?>
        <?php
        $parentData = array(0 => 'new Parent');
        //$parentData = array_merge($parentData, CHtml::listData(User::model()->findAll(), 'id', 'email'));
        foreach (CHtml::listData(User::model()->findAll(), 'id', 'email') as $key => $i) {
            $parentData[$key] = $i;
        }
        //echo $form->dropDownList($model, 'parent_id', $parentData);
        ?>
        <?php
        $this->widget('ext.combobox.EJuiComboBox', array(
            'model' => $model,
            'attribute' => 'parent_id',
            'data' => $parentData,
        ));
        ?>
        <?php echo $form->error($model, 'parent_id'); ?>
    </div>

    <div id="detailParent" style="border: 4px solid #DaDaDa;border-radius: 4px 0 4px 0;padding: 3px 7px;">
        <div class="row" style='margin-left: 20px'>
<?php echo $form->labelEx($modelParent, 'username'); ?>
            <?php echo $form->textField($modelParent, 'username', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($modelParent, 'username'); ?>
        </div>
        <div class="row" style='margin-left: 20px'>
<?php echo $form->labelEx($modelParent, 'father_name'); ?>
            <?php echo $form->textField($modelParent, 'father_name', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($modelParent, 'father_name'); ?>
        </div>
        <div class="row" style='margin-left: 20px'>
<?php echo $form->labelEx($modelParent, 'mother_name'); ?>
            <?php echo $form->textField($modelParent, 'mother_name', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($modelParent, 'mother_name'); ?>
        </div>
        <div class="row" style='margin-left: 20px'>
<?php echo $form->labelEx($modelParent, 'password'); ?>
            <?php echo $form->passwordField($modelParent, 'password', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($modelParent, 'password'); ?>
        </div>
        <div class="row" style='margin-left: 20px'>
<?php echo $form->labelEx($modelParent, 'email'); ?>
            <?php echo $form->textField($modelParent, 'email', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($modelParent, 'email'); ?>
        </div>
        <div class="row" style='margin-left: 20px'>
<?php echo $form->labelEx($modelParent, 'address'); ?>
            <?php echo $form->textField($modelParent, 'address', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($modelParent, 'address'); ?>
        </div>
        <div class="row" style='margin-left: 20px'>
<?php echo $form->labelEx($modelParent, 'father_phone'); ?>
            <?php echo $form->textField($modelParent, 'father_phone', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($modelParent, 'fahter_phone'); ?>
        </div>
        <div class="row" style='margin-left: 20px'>
<?php echo $form->labelEx($modelParent, 'mother_phone'); ?>
            <?php echo $form->textField($modelParent, 'mother_phone', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($modelParent, 'mohter_phone'); ?>
        </div>
    </div>
    <script>
        $("#Student_parent_id").change(function() {
            parent = $("#Student_parent_id").val();
            if (parent == 'new Parent') {
                $("#detailParent").show(1000);
            }
            else {
                $("#detailParent").hide(1000);
            }
        })
    </script>



    <div class="row">
<?php echo $form->labelEx($model, 'date_enter'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'date_enter',
            'options' => array(
                'changeYear' => true,
                'changeMonth' => true,
                'dateFormat' => 'yy-mm-dd',
            )
        ));
        ?>
        <?php echo $form->error($model, 'date_enter'); ?>
    </div>
    <div id="promotionPrice" style="display:none"></div>
    <script>
        var promotionPrice;
        $("#Student_grade").change(function() {
            jQuery.ajax({
                url: '<?php echo Yii::app()->createUrl("") ?>?r=promotion/get&id=' + $('#Student_grade').val(),
                type: 'get',
                success: function(html) {
                    $('#promotionPrice').html(html);
                    //alert($('#tuition').html());
                    tuition = $("#ppp2").html();
                    promotionPrice = jQuery.parseJSON($("#ppp1").html());
                }
            })


        });

    </script>

    <div id="payment" style="border: 4px solid #DaDaDa;border-radius: 4px 0 4px 0;padding: 3px 7px;">
        <h3>Payment</h3>
        <div class="row" style='margin-left: 20px'>
<?php echo $form->labelEx($modelPayment, 'payment_method'); ?>
            <?php echo $form->dropDownList($modelPayment, 'payment_method', Payment::getPaymentMethodDropDown()); ?>
            <?php echo $form->error($modelPayment, 'payment_method'); ?>
        </div>

        <div class="row" style='margin-left: 20px'>
<?php echo $form->labelEx($modelPayment, 'refferal_id'); ?>
            <?php echo $form->textField($modelPayment, 'refferal_id'); ?>
            <?php echo $form->error($modelPayment, 'refferal_id'); ?>
        </div>

        <div class="row" style='margin-left: 20px'>
            <label>Paket</label>
<?php $dd = array_merge(array(0 => 'No Promotion'), CHtml::listData(Promotion::model()->findAll(), 'id', 'name'));
echo $form->dropDownList($modelPayment, 'paket', $dd);
?>
        </div>
        <div class="row" id="months" style='margin-left: 20px'>
            <?php echo $form->labelEx($modelPayment, 'month'); ?>
            <div style="-moz-column-count:3;-webkit-column-count:3;column-count:3;">
                <?php
                $year = date("Y");
                $month = date("n");
                if ($month < 6) {
                    $range = 6 - $month;
                } else {
                    $range = 6 + 12 - $month;
                }
                $payMonth = array();
                for ($i = 0; $i <= $range; $i++) {
                    $payMonth[$i] = $i;
                }
                echo $form->dropDownList($modelPayment, 'months', $payMonth);
                ?>
            </div>
            <?php echo $form->error($modelPayment, 'month'); ?>
        </div>

        <div class="row" style='margin-left: 20px'>
            <?php echo $form->labelEx($modelPayment, 'ammount'); ?>
            <?php echo $form->textField($modelPayment, 'ammount'); ?>
            <?php echo $form->error($modelPayment, 'ammount'); ?>
        </div>
    </div>
    <script>
        var tuition = <?php echo Helper::getConfig('tuition'); ?>;
        var book = <?php echo Helper::getConfig('book'); ?>;
        $("#Payment_paket").change(function() {
            if ($("#Payment_paket").val() != 0)
                $("#months").hide("slow");
            else
                $("#months").show("slow");
            $("#Payment_ammount").val(promotionPrice[$("#Payment_paket").val()]);
        })
        $("#Payment_months").change(function() {
            $("#Payment_ammount").val(<?php echo Helper::getConfig('registration') ?> + ((parseInt(tuition) + book) * $("#Payment_months").val()));
        })
    </script>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
