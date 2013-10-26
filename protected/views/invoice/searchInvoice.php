<?php
/* @var $model Invoice */
$this->menu = array(
    array('label' => 'Report Income', 'url' => array('report')),
    array('label' => 'Report Expense', 'url' => array('reportUnpaid')),
    
);
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'htmlOptions' => array(
        'class' => 'form form-search'
    )
        ));
?>
<?php
echo @$form->dropDownList($model, 'payment_method', Payment::getPaymentMethodDropDown(), array(
    'class' => 'input-medium search-query'
        )
);
?>
<?php
echo $form->textField($model, 'refferal_id', array(
    'placeholder' => 'refferal_id',
    'class' => 'input-medium search-query'));
echo CHtml::submitButton('Search', array('class' => 'btn btn-primary'));
$this->endWidget();
?>
<?php if ($model != null): ?>
    <?php if (!$model->isNewRecord): ?>
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'attributes' => array(
                'student.student_name',
                'ammount',
                'date',
            ),
        ));
        ?>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array(
                'class' => 'form form-search'
            )
        ));
        echo $form->labelEx($model, 'income_date');
        echo $form->hiddenField($model, 'id');
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Invoice[income_date]',
            'model' => $model,
            'value' => $model->income_date,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;'
            ),
        ));
        ;
        echo CHtml::submitButton('Update', array('class' => 'btn btn-primary'), array('placeholder' => 'income-date'));
        $this->endWidget();
        foreach($payment as $i):?>
            <div><?php echo $i->month."-".$i->year;?></div>
       <?php endforeach;
            
        

    endif;
else:
    ?>
    <div class="alert alert-error">
        No such invoice
    </div>
<?php endif; ?>

