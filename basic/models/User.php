<?php

namespace app\models;

use Yii;
use yii\base\Security;
use app\models\User as DbUser;
use app\models\Status;
use app\models\StatusSearch;
use app\components\AccessRule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;



/**
 * This is the model class for table "User".
 *
 * @property integer $Id
 * @property string $user_firstname
 * @property string $user_lastname
 * @property string $user_username
 * @property string $user_password
 * @property integer $user_isMaster
 *
 * @property Survey $survey
 */



class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */



    public $authKey;


    private $_user = false;

    public static function tableName()
    {
        return 'User';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'user_username'], 'string', 'max' => 45, 'message'=>'Your entry is too long. Please try again.' ],
            ['user_isMaster', 'integer'],
            ['user_password', 'string', 'max' => 80, 'message'=>'Your entry is too long. Please try again.'],
            [['user_password', 'user_username'], 'required', 'message'=>'This field may not be empty.', 'on'=>'create'],
            ['user_username', 'unique', 'message'=>'This username is already taken.', 'on'=>'create'],

            ['user_password', 'validatePassword', 'on'=>'login'],
            [['user_password', 'user_username'], 'required', 'message'=>'This field may not be empty.', 'on'=>'login'],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_firstname' => 'First name',
            'user_lastname' => 'Last name',
            'user_username' => 'Username',
            'user_password' => 'Password',
            'user_isMaster' => 'Are you a survey creator?',
            'user_isAdmin' => '',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurvey()
    {
        return $this->hasOne(Survey::className(), ['user_id' => 'id']);
    }








    public function login()
    {
        if ($this->validate()) {
            return \Yii::$app->user->login($this->getUser($this->user_username), 4000);
        } else {
        return false;
        }
    }

    public function getUser($username)
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($username);
        }

        return $this->_user;
    }

    public static function findIdentity($id) {
        $dbUser = DbUser::find()
            ->where([
                "id" => $id
            ])
            ->one();
        if (!count($dbUser)) {
            return null;
        }
        return new static($dbUser);
    }

    public static function findIdentityByAccessToken($token, $userType = null) {

        $dbUser = DbUser::find()
            ->where(["accessToken" => $token])
            ->one();
        if (!count($dbUser)) {
            return null;
        }
        return new static($dbUser);
    }
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {

        return static::findOne(['user_username'=>$username]);
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */


    public function validatePassword($attribute, $params) {

        if (!$this->hasErrors()){

            $user = $this->getUser($this->user_username);



            if (!$user || !Yii::$app->getSecurity()->validatePassword($this->$attribute, $user->user_password)) {
                $this->addError($attribute, 'Eingegebener Benutzername oder Passwort ungültig.');
            }


        }

        }


    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


    public function beforeSave ($insert){

        if (isset($this->user_password)){
                $this->user_password = Yii::$app->getSecurity()->generatePasswordHash($this->user_password);
            return true;

        }
    }



}
