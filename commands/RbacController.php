<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\modules\commentModule\AuthorRule as AuthorRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add the rule
        $ruleDeleteOwnPost = new AuthorRule;
        $auth->add($ruleDeleteOwnPost);

        // добавляем разрешение "updateOwnPost" и привязываем к нему правило.
        $deleteOwnPost = $auth->createPermission('deleteOwnPost');
        $deleteOwnPost->description = 'Delete own post';
        $deleteOwnPost->ruleName = $ruleDeleteOwnPost->name;
        $auth->add($deleteOwnPost);

        // add "userPermission" permission
        $userPermission = $auth->createPermission('userPermission');
        $userPermission->description = 'Basic users right';
        $auth->add($userPermission);

        // add "adminPermission" permission
        $adminPermission = $auth->createPermission('adminPermission');
        $adminProductRoute = $auth->createPermission('/product/*');
        $adminUserRoute = $auth->createPermission('/user/admin/*');
        $adminCommentsRoute = $auth->createPermission('/comments/*');
        $adminOrderRoute = $auth->createPermission('/order/*');
        $adminPermission->description = 'Admin rights';
        $auth->add($adminPermission);
        $auth->add($adminProductRoute);
        $auth->add($adminUserRoute);
        $auth->add($adminCommentsRoute);
        $auth->add($adminOrderRoute);

        // add "user" role and give this role the "userPermission" permission
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $userPermission);
        $auth->addChild($user, $deleteOwnPost);

        // add "admin" role and give this role the "adminPermission" permission
        // as well as the permissions of the "user" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $adminPermission);
        $auth->addChild($admin, $adminProductRoute);
        $auth->addChild($admin, $adminUserRoute);
        $auth->addChild($admin, $adminCommentsRoute);
        $auth->addChild($admin, $adminOrderRoute);
        $auth->addChild($admin, $user);
    }
}