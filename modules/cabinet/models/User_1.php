<?php

namespace app\modules\cabinet\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $login
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $auth_key
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'username', 'email', 'password'], 'required'],
            [['login', 'username', 'email', 'password', 'phone'], 'string', 'max' => 255],
            [['role', 'auth_key', 'phone'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'username' => 'Имя пользователя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'password' => 'Пароль',
        ];
    }
}
