<?php

class AttendanceController extends Controller {

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);

        $this->menu = array(
            array('label' => 'Create Attendance Report', 'url' => array('create')),
            array('label' => 'Attendance Report', 'url' => array('report')),
            array('label' => 'Search', 'url' => array('search')),
        );
    }

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

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'report', 'create', 'ajaxGetClass', 'ajaxGetGrade', 'AjaxGetAttendanceList'),
                'roles' => array('admin', 'teacher'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAjaxGetGrade() {
        $id = $_POST['Attendance']['school_id'];
        $model = School::model()->findByPk($id);
        $ulimit = 0;
        if ($model->level_of_school = 1) {
            $ulimit = 6;
        } else {
            $ulimit = 3;
        }
        for ($i = 0; $i <= $ulimit; $i++) {
            echo CHtml::tag('option', array('value' => $i), $i);
        }
    }

    public function actionReport() {
        $attendance = new Attendance;
        if (isset($_POST['Filter'])) {
            $criteria = new CDbCriteria();
            $criteria->order = 'student_id, date';
            $criteria->addBetweenCondition('date', $_POST['Filter']['start_date'], $_POST['Filter']['end_date']);
            $criteria->addColumnCondition(array('class' => $_POST['Filter']['class'], 'grade' => $_POST['Filter']['grade']));
            $attendance = Attendance::model()->findAll($criteria);
            $temp = array();
            foreach ($attendance as $i) {
                $temp[$i->student_id][$i->date] = $i->attend;
            }
            $attendance = $temp;
        }
        $this->render('report', array('model' => $attendance));
    }

    public function actionAjaxGetAttendanceList() {
        $classId = $_POST['Attendance']['class'];
        $grade = $_POST['Attendance']['grade'];
        $students = Student::model()->findAllByAttributes(array('grade' => $grade, 'class' => $classId));
	#var_dump($_POST);
	if (isset($_POST['Attendance']['attend'])) {
	    #var_dump($_POST['Attendance']['attend']);	
	    $old = Attendance::model()->findAllByAttributes(array(
                'date' => $_POST['Attendance']['date'],
                'class' => $_POST['Attendance']['class'],
            ));
            if ($old != null) {

                foreach ($old as $t => $i) {
                    $i->attend = $_POST['Attendance']['attend'][$t];
                    if (!$i->save()) {
                        var_dump($i->errors);
                        die();
                    }
                }
                //var_dump($old);die();
            }
	    else{
		    #var_dump($students);
                /*foreach ($students as $id => $student) {
                    $attendance = new Attendance;
                    $attendance->attend = $_POST['Attendance']['attend'][$id];
                    $attendance->student_id = $student->id;
                    $attendance->date = $_POST['Attendance']['date'];
                    $attendance->class = $_POST['Attendance']['class'];
                    $attendance->grade = $_POST['Attendance']['grade'];
                    $attendance->teacher_id = Yii::app()->user->id;
                    $attendance->save();
		}*/}
        }
        $this->renderPartial('_attendanceList', array('model' => $students));
    }

    public function actionAjaxGetClass() {
        $id = $_POST['Attendance']['school_id'];
        $criteria = new CDbCriteria();
	$criteria->addColumnCondition(array('school_id'=> $id));
	$criteria->with = array(
            'Terms' => array(
		    'condition' => 'date_begin <now() and date_end>now()'
            )
        );
        
        #$criteria->condition = 'date_begin >'.date('Y-m-d').' and date_end<'.date('Y-m-d');
        //var_dump($criteria->);die();    
        $model = Classm::model()->findAll($criteria);
        echo CHtml::tag('option', array('value' => 0), '0');
        foreach ($model as $i) {
            echo CHtml::tag('option', array('value' => $i->id), $i->class);
        }
    }

    public function actionCreate() {

        $this->render('create');
    }

    /*
      public function actions() {
      // return external action classes, e.g.:
      return array(
      'action1' => 'path.to.ActionClass',
      'action2' => array(
      'class' => 'path.to.AnotherActionClass',
      'propertyName' => 'propertyValue',
      ),
      );
      }
     */
}
