<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $login
 * @property string $email
 * @property string $fio
 * @property string $password
 * @property int $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password2;
    public static function findIdentity($id)
      {
          return static::findOne($id);
      }
 
      public static function findIdentityByAccessToken($token, $type = null)
      {
          return static::findOne(['access_token' => $token]);
      }
 
      public function getId()
     {
          return $this->id;
      }
 
      public function getAuthKey()
      {
          return null;
      }
 
      public function validateAuthKey($authKey)
     {
          return $this->authKey === $authKey;
      }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'email', 'fio', 'password'], 'required'],
            [['role'], 'integer'],
            ['email','email'],
            ['login','validateLogin'],
            ['password2','compare','compareAttribute'=>'password'],
            [['login', 'email', 'fio', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'email' => 'Email',
            'fio' => 'Fio',
            'password' => 'Password',
            'password2'=>'Povtorite parol',
            'role' => 'Role',
        ];
    }

    public function validatePassword($password){
        return $this->password === md5($password);
    }
     public static function findByUsername($username){
        return self::find()->where(['login'=>$username])->one();
    }
    
    public function validateLogin($attribute){
        $user = self::find()->where(['login'=>$this->login])->one();

        if ($user !== null){
            $this->addError($attribute, 'Повторите логин.');
        }
    }
    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
    }
}
