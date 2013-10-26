<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserHelper
 *
 * @author ASMANKEU
 */
class UserHelper {
    //put your code here
    public static function isMemberOf(User $user,String $groupname){
        foreach($user->groups as $group){
            if($groupname ==$group->name)
                return true;
        }
        return false;
    }
}
