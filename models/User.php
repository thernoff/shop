<?php

namespace app\models;

use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{


    public static function tableName() {
        return 'user';
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord){
                $this->role_id = '3';
                return true;
            }
        }
        return false;
    }
    
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['login', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['login', 'unique', 'targetClass' => self::className(), 'message' => 'Такой логин уже существует.'],
            ['login', 'string', 'min' => 2, 'max' => 255],
 
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => 'Такой email уже существует.'],
            ['email', 'string', 'max' => 255],
            
            [['username', 'lastname', 'email', 'phone'], 'safe'],
            //['status', 'integer'],
            //['status', 'default', 'value' => self::STATUS_ACTIVE],
            //['status', 'in', 'range' => array_keys(self::getStatusesArray())],
        ];
    }
    
    
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
            'avatar' => 'Аватар'
        ];
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    
    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
    }
    
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return $this->password === $password;
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
}
