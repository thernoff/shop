<?php

namespace app\modules\cabinet\models;

use Yii;
use yii\base\Model;
use app\models\User;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $reNewPassword;
    private $_user = false;

    
    public function __construct()
    {
        $this->_user = User::findOne(Yii::$app->user->identity->getId());
        //parent::__construct($config);
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['oldPassword', 'newPassword', 'reNewPassword'], 'required'],
            ['oldPassword', 'oldPassword', 'skipOnEmpty' => false, 'skipOnError' => false],
            ['newPassword', 'string', 'min' => 3],
            //['login', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Данный логин уже используется.'],
            ['reNewPassword', 'compare', 'compareAttribute' => 'newPassword'],
            // password is validated by validatePassword()
            //['password', 'validatePassword'],
        ];
    }
    
    public function oldPassword($attribute, $params)
    {
        
        if (!$this->hasErrors()) {
            if (!$this->_user->validatePassword($this->$attribute)) {
                $this->addError($attribute, 'Не верно указан старый пароль.');
                //debug($this);die;
            }
        }
    }
    
    public function attributeLabels() {
        return [
            'oldPassword' => 'Старый пароль',
            'newPassword' => 'Новый пароль',
            'reNewPassword' => 'Введите новый пароль еще раз',
        ];
    }
    
    public function changePassword()
    {
        
        if ($this->validate()){
            $this->_user->setPassword($this->newPassword);
            if ($this->_user->save()){
                return $this->_user;
            }
        }
        return null;
    }
}
