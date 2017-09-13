<?php

namespace app\models;

use Yii;
use yii\base\Model;
//use app\models\User;
use app\models\User;
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
            //['login', 'unique', 'targetClass' => '\models\User', 'message' => 'Этот логин уже зарегистрирован!'],
            ['login', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'login', 'message' => 'Такой логин уже существует.'],
            //['login', 'unique', 'targetClass' => User::className(), 'message' => 'Этот логин уже зарегистрирован!'],
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
        if ($this->validate()){
            $user = new User();
            $user->login = $this->login;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->role_id = '3';
            if ($user->save()){
                return $user;
            }
        }            
        return false;
    }
}
