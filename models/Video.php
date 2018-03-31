<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property integer $id
 * @property string $video_url
 * @property string $durata
 * @property integer $compagnia_id
 * @property string $type
 * @property string $titolo
 * @property integer $visite
 * @property string $data_pubblicazione
 * @property integer $mi_piace
 * @property string $descrizione
 *
 * @property Compagnie $compagnia
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_url', 'compagnia_id', 'type', 'titolo', 'data_pubblicazione', 'mi_piace'], 'required'],
            [['compagnia_id', 'visite', 'mi_piace'], 'integer'],
            [['data_pubblicazione'], 'safe'],
            [['descrizione'], 'string'],
            [['video_url'], 'string', 'max' => 80],
            [['durata'], 'string', 'max' => 3],
            [['type'], 'string', 'max' => 10],
            [['titolo'], 'string', 'max' => 250],
            [['compagnia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Compagnie::className(), 'targetAttribute' => ['compagnia_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'video_url' => Yii::t('app', 'Video Url'),
            'durata' => Yii::t('app', 'Durata'),
            'compagnia_id' => Yii::t('app', 'Compagnia ID'),
            'type' => Yii::t('app', 'Type'),
            'titolo' => Yii::t('app', 'Titolo'),
            'visite' => Yii::t('app', 'Visite'),
            'data_pubblicazione' => Yii::t('app', 'Data Pubblicazione'),
            'mi_piace' => Yii::t('app', 'Mi Piace'),
            'descrizione' => Yii::t('app', 'Descrizione'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompagnia()
    {
        return $this->hasOne(Compagnie::className(), ['id' => 'compagnia_id']);
    }
    /**
     * 
     * @param type $id
     * @return type
     */
    public static function findByCompagniaId($id){
        $compagnia = self::find()
                     ->where([
                         'compagnia_id' => $id
                     ])
                     ->one();
        
        if(!count($compagnia)){
            return null;
        }
        
        return $compagnia;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public static function findById($id){
        $compagnia = self::find()
                     ->where([
                         'id' => $id
                     ])
                     ->one();
        
        if(!count($compagnia)){
            return null;
        }
        
        return $compagnia;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public static function getMiPiace($id){
        $mi_piace = self::findById($id);
        
        return $mi_piace->mi_piace;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public static function getAllMiPiace(){
        $mi_piace = self::find()->all();
        
        return $mi_piace;
    }
}
