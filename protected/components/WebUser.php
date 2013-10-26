<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebUser
 *
 * @author ASMANKEU
 */
class WebUser extends CWebUser {

    //put your code here
    public function isAdmin() {
        if (Yii::app()->user->isGuest)
            return false;
        $user = User::model()->findByPk(Yii::app()->user->id);
        //var_dump($user->groups[0]->name);
        foreach ($user->groups as $group) {
            if ($group->name == "admin") {
                return true;
            }
        }
        return false;
    }
    public function getAdmin() {
        return $this->isAdmin();
    }

    public function checkAccess($operation, $params = array(), $allowCaching = true) {
        foreach ($this->groups as $group) {
            if ($operation == $group->name)
                return true;
        }
        return false;
    }
    public function getGroups(){
        if(Yii::app()->user->isGuest)
            return array();
        $user = User::model()->findByPk(Yii::app()->user->id);
        return $user->groups;
        
    }
    
    public function isAccounting(){
        return $this->isGroup('accounting');
    }
    public function isGroup($groupName,$allowAdmin=true){
        if(Yii::app()->user->isGuest)
            return false;
        if($allowAdmin && $this->getAdmin())
            return true;
        $user = User::model()->findByPk(Yii::app()->user->id);
        foreach($user->groups as $group){
            if($group->name == $groupName)
                return true;
        }
        return false;
    }
}

?>
