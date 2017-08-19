<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $editor = $auth->createRole('editor');

        $auth->add($admin);
        $auth->add($editor);

        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $updateEvents = $auth->createPermission('updateEvents');
        $updateEvents->description = 'Редактирование мероприятий';

        $auth->add($viewAdminPage);
        $auth->add($updateEvents);

        $auth->addChild($editor,$updateEvents);

        $auth->addChild($admin, $editor);

        $auth->addChild($admin, $viewAdminPage);

        $auth->assign($admin, 2);

        $auth->assign($editor, 3);
    }
}