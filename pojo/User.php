<?php

namespace app\pojo;

use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public $id;
    public $user_id;
    public $user_name;
    public $nick_name;
    public $password;
    public $mobile;
    public $access_token;
    public $auth_key;
    public $email;

    public static function tableName()
    {
        return '{{mall_users}}';
    }

    public static function findIdentity($id)
    {
        $result = self::findOne($id);
        $user = new User();
        foreach ($result->attributes() as $label)
        {
            $user[$label] = $result->getAttribute($label);
        }
        return $user;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $result = self::findOne(['access_token' => $token]);
        $user = new User();
        foreach ($result->attributes() as $label)
        {
            $user[$label] = $result->getAttribute($label);
        }
        return $user;
    }

    public static function findByUsername($username)
    {
        $result = self::findOne(['user_name' => $username]);
        $user = new User();
        foreach ($result->attributes() as $label)
        {
            $user[$label] = $result->getAttribute($label);
        }
        return $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        $password_hash = hash('md5', $this->password);
        try {
            $password_hash = Yii::$app->security->generatePasswordHash($this->password);
        } catch (Exception $e) {
        }

        return Yii::$app->security->validatePassword($password, $password_hash);
    }
}