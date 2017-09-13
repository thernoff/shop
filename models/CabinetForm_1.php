<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $login;
    public $password;
    public $repassword;
    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['login', 'password', 'repassword'], 'required'],
            ['login', 'unique', 'targetClass' => '\models\User', 'message' => 'Данный логин уже используется.'],
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            // password is validated by validatePassword()
            //['password', 'validatePassword'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'repassword' => 'Введите пароль еще раз',
        ];
    }
    
    public function register()
    {
        $user = new User();
        $user->login = $this->login;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->role = 'user';
        if ($user->save()){
            return $user;
        }
        return null;
    }
}
