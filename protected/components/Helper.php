<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helper
 *
 * @author kharisma
 */
class Helper {
    public static function getConfig($item){
        $config = Config::model()->findByAttributes(array('name'=>$item));
        if($config!=null){
            return $config->value;
        }
        else
            return null;
    }
}

?>
