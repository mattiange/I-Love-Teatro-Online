<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%utenti}}".
 *
 * @property integer $id
 * @property string $nome
 * @property string $cognome
 * @property string $email
 * @property string $password
 * @property string $indirizzo
 * @property string $telefono
 * @property string $authkey
 *
 * @property Commenti[] $commentis
 * @property Compagnie[] $compagnies
 */
class Utenti extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%utenti}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'cognome', 'email', 'password'], 'required'],
            [['nome', 'cognome', 'email', 'authkey'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 250],
            [['indirizzo'], 'string', 'max' => 45],
            [['telefono'], 'string', 'max' => 10],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'cognome' => Yii::t('app', 'Cognome'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'indirizzo' => Yii::t('app', 'Indirizzo'),
            'telefono' => Yii::t('app', 'Telefono'),
            'authkey' => Yii::t('app', 'Authkey'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentis()
    {
        return $this->hasMany(Commenti::className(), ['utenti_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompagnies()
    {
        return $this->hasMany(Compagnie::className(), ['utente_id' => 'id']);
    }
    
    public static function findIdentity($id) {
        $user = self::find()
                ->where([
                    "id" => $id
                ])
                ->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }
    
    /**
    * @inheritdoc
    */
   public static function findIdentityByAccessToken($token, $userType = null) {

       $user = self::find()
               ->where(["accessToken" => $token])
               ->one();
       if (!count($user)) {
           return null;
       }
       return new static($user);
   }

   /**
    * Finds user by username
    *
    * @param  string      $username
    * @return static|null
    */
   public static function findByUsername($username) {
       $user = self::find()
               ->where([
                   "email" => $username
               ])
               ->one();
       if (!count($user)) {
           return null;
       }
       return new static($user);
   }

   public static function findByUser($username) {
       $user = self::find()
               ->where([
                   "email" => $username
               ])
               ->one();
       if (!count($user)) {
           return null;
       }
       return $user;
   }
   
   public static function findByID($id){
       $user = self::find()
               ->where([
                   'id' => $id
               ])
               ->one();
       
       if(!count($user)){
           return null;
       }
       
       return $user;
   }

   /**
    * @inheritdoc
    */
   public function getId() {
       return $this->id;
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
   public function validatePassword($password) {
       return $this->password ===  md5($password);
   }
   
   public function comparePassword($password, $compare){
       return $password === $compare;
   }
    
    
}
