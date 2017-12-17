<?php
namespace app\modules\commentModule;


use yii\rbac\Rule;

/**
 * Проверяем authorID на соответствие с пользователем, переданным через параметры
 */
class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated width.
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $time = time() - $params['post']->createdAt <= (60 * 5);
        $timeDebug = $params['post']->createdAt;
//        echo '<p>INFO: timeDebug' . $timeDebug . '</p>';
//        echo '<p>INFO: time' . $time . '</p>';
        return isset($params['post']) ? $params['post']->createdBy == $user && $time : false;
    }
}