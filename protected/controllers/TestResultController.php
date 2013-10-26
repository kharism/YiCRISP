<?php

class TestResultController extends Controller {

    public function actionIndex() {
        
        $this->render('index');
    }

    // Uncomment the following methods and override them if needed

    public function filters() {
        // return the filter configuration for this controller, e.g.:
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'ajaxGetClassChooser', 'ajaxGetClassSpreadsheet', 'GetClassResult','ajaxGetTestByDate'),
                'roles' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    public function actionAjaxGetTestByDate(){
        $date = $_GET['date'];
        $tests = Test::model()->findAllByAttributes(array('date'=>$date));
        echo CHtml::tag('option', array('value'=>'-1'), 'Select Test');
        foreach ($tests as $j){
            echo CHtml::tag('option', array('value'=>$j->id), $j->School->school_name.' Test '.$j->CategoryOne->category.' for '.$j->grade);
        }
    }
    public function actionAjaxGetClassChooser() {
        $test_id = @$_POST['test_id'];
        $test = Test::model()->findByPk($test_id);
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('school_id'=>$test->school));
        $criteria->with = array('Terms');
        $criteria->addCondition("Terms.date_begin<now() and Terms.date_end>now()");
        $class = Classm::model()->findAll($criteria);
        $class = CHtml::listData($class, 'id', 'class');
        //var_dump($class);
        $this->renderPartial('_subform', array('grade' => $test->grade,'class'=>$class));
    }

    public function actionAjaxGetClassSpreadsheet() {
        //var_dump($_POST);
        $class_id = @$_POST['class_id'];
        $test_id = @$_POST['test_id'];
        //echo $_POST['class_id']." ".$_POST['test_id'];
        $test = Test::model()->findByPk($test_id);
        if (!TestResult::model()->exists('class_id='. @$_POST['class_id'].' and test_id='.@$_POST['test_id'])) {
            $students = Student::model()->findAllByAttributes(array('class' => @$_POST['class_id'],'grade'=>$test->grade));
            foreach ($students as $student) {
                if(TestResult::model()->exists('student_id='.$student->id.' and test_id='.@$_POST['test_id'])){
                    continue;
                }
                $testResult = new TestResult;
                $testResult->student_id = $student->id;
                $testResult->class_id = $class_id;
                $testResult->test_id = $test_id;
                $testResult->save();
            }
        }
        $testResult = TestResult::model()->findAllByAttributes(array('class_id' => @$_POST['class_id'], 'test_id' => @$_POST['test_id']));
        //var_dump($testResult);die();
        $this->renderPartial('spreadsheet',array('model'=>$testResult));
        //$test = Test::model()->findByPk($test_id);
        //$this->renderPartial('_subform', array('grade'=>$test->grade));
    }

    public function actionGetClassResult() {
        $results = TestResult::model()->findAllByAttributes(array('test_id'=>@$_POST['test_id'],'class_id'=>@$_POST['class_id']));
        
        if(isset($_POST['TestResult'])){
            $valid=true;
            foreach($results as $i=>$result){
                if(isset($_POST['TestResult'][$i])){
                    $result->attributes = $_POST['TestResult'][$i];
                }
                if($result->validate()){
                    $result->update();
                }
            }
            
        }
    }
    public function actionReportStudent(){
        
    }

}
