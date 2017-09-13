<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $login
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $role
 * @property string $auth_key
 */
class UserRecord extends \yii\db\ActiveRecord
{
    const SCENARIO_REGISTER = 'register';
    const SCENARIO_UPDATE = 'update';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord){
                $this->generateAuthKey();
                $this->setPassword($this->password);
            }elseif($this->password){
                $this->setPassword($this->password);
            }else{
                $oldPassword = $this->getOldAttribute('password');
                $this->password = $oldPassword;
            }
            return true;
        }
        return false;
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        //$scenarios[self::SCENARIO_REGISTER] = ['login', 'username', 'lastname', 'email', 'password', 'role_id','phone'];
        //$scenarios[self::SCENARIO_UPDATE] = ['login', 'username', 'email', 'role_id', 'phone'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'email', 'role_id', 'password'], 'required', 'on' => 'register'],
            [['login', 'email', 'role_id'], 'required', 'on' => 'update'],
            //['password', 'validateRequired', 'skipOnEmpty' => false, 'skipOnError' => false],
            [['login', 'username', 'lastname', 'password', 'auth_key'], 'string', 'max' => 255],
            ['login', 'validateEnglishLanguage'],
            ['login', 'unique', 'targetClass' => self::className(), 'message' => 'Такой логин уже существует.'],
            ['password', 'safe', 'on' => 'update'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => 'Такой логин уже существует.'],
            [['username', 'lastname', 'phone'], 'string'],
        ];
    }

    public function validateEnglishLanguage($attribute, $params)
    {
        if (!$this->hasErrors()) {
            
            $pattern = '/^[a-zA-Z0-9_]*$/';
            if (!preg_match($pattern, $this->login)) {
                $this->addError($attribute, 'Логин может состоять только из букв английского алфавита, цифр и символа подчеркивания _.');
            }
        }
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'username' => 'Имя',
            'lastname' => 'Фамилия',
            'email' => 'Email',
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'role_id' => 'Роль',
            'auth_key' => 'Ключ аутентификации',
            'avatar' => 'Аватар'
        ];
    }
    
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }
}
