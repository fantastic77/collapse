<?php

namespace app\modules\user\models;

use mdm\admin\models\form\Signup as SignupTemplate;
use mdm\admin\models\User;


class SignupForm extends SignupTemplate
{
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                $auth = \Yii::$app->authManager;
                $authorRole = $auth->getRole('user');
                $auth->assign($authorRole, $user->getId());
                return $user;
            }
        }

        return null;
    }
}