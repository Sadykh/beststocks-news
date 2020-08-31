<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class InitController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @return void Exit code
     * @throws \yii\base\Exception
     */
    public function actionIndex()
    {
        $user = User::findByUsername('admin');
        if ($user !== null) {
            return;
        }
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@admin.ru';
        $user->status_id = User::STATUS_ACTIVE;
        $user->generateAuthKey();
        $user->setPassword('qwerty');
        $user->save();
    }
}
