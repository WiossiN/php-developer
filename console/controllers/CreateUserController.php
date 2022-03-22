<?php

namespace console\controllers;

use Yii;
use common\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class CreateUserController extends Controller
{
    /**
     * Зарегистрировать администратора из консоли.
     *
     * @return string
     */
    public function actionIndex($email = 'dyplass@gmail.com', $password = '123123123')
    {
        $user = new User();
        $user->email = $email;
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($password);
        $user->generatePasswordResetToken();
        $user->generateEmailVerificationToken();
        $user->created_at = time();
        $user->updated_at = time();
        if($user->validate() && $user->save()){
            echo "User $user->email created!" . PHP_EOL;
        } else {
            echo "User $user->email NOT created! Save model error..." . PHP_EOL;
        }
        return ExitCode::OK;
    }
}
