<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%compagnie}}".
 *
 * @property integer $id
 * @property string $compagnia
 * @property string $indirizzo
 * @property string $telefono
 * @property string $cellulare
 * @property string $email
 * @property integer $utente_id
 *
 * @property Utenti $utente
 * @property Video[] $videos
 */
class Compagnie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%compagnie}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['compagnia', 'indirizzo', 'email'], 'required'],
            [['utente_id'], 'integer'],
            [['compagnia'], 'string', 'max' => 60],
            [['indirizzo', 'email'], 'string', 'max' => 50],
            [['telefono', 'cellulare'], 'string', 'max' => 10],
            [['utente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Utenti::className(), 'targetAttribute' => ['utente_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'compagnia' => Yii::t('app', 'Compagnia'),
            'indirizzo' => Yii::t('app', 'Indirizzo'),
            'telefono' => Yii::t('app', 'Telefono'),
            'cellulare' => Yii::t('app', 'Cellulare'),
            'email' => Yii::t('app', 'Email'),
            'utente_id' => Yii::t('app', 'Utente ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtente()
    {
        return $this->hasOne(Utenti::className(), ['id' => 'utente_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Video::className(), ['compagnia_id' => 'id']);
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public static function findByUtenteId($id){
        $user = self::find()
               ->where([
                   'utente_id' => $id
               ])
               ->one();
       
       if(!count($user)){
           return null;
       }
       
       return $user;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public static function findById($id){
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
}
