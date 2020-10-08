<?php

/*
 * 2014-06-25
 * prawee@hotmail.com
 */

namespace common\components;

use Yii;
//use yii\base\Action;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class AccessControl extends ActionFilter {

    public $params = [];
    public $denyCallback;
    private $separator = '-';

    private function getItemName($component) {
        return strtr($component->getUniqueId(), '/', $this->separator);
    }

//ก่อนที่จะแอ็คชั่นหรือทำงาน

    public function beforeAction($action) {

        $user = Yii::$app->getUser();

        $controller = $action->controller;
       // $permission =  $user->id;
        $permission = $controller->id;
        $permission.='-';
        $permission.=$controller->action->id;
        // echo $permission;
    
        if (Yii::$app->user->can($permission)){
            return true;
           // echo 'can be access'.$permission;
        } else {
            throw new ForbiddenHttpException('test');
           // echo 'do not access'.$permission;
        }
        
    }

  /*  protected function denyAccess($user) {
        if ($user->getIsGuest()) {
            $user->loginRequired();
        } else {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }
*/
}
