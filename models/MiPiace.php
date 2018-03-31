<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%mi_piace}}".
 *
 * @property integer $utente_id
 * @property integer $video_id
 */
class MiPiace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mi_piace}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['utente_id', 'video_id'], 'required'],
            [['utente_id', 'video_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'utente_id' => Yii::t('app', 'Utente ID'),
            'video_id' => Yii::t('app', 'Video ID'),
        ];
    }
    
    /**
     * 
     * @param type $id
     * @return Object
     */
    public static function findById($utente_id, $video_id){
        $mi_piace = self::find()
                     ->where([
                         'utente_id' => $utente_id,
                         'video_id' => $video_id
                     ])
                     ->one();
        
        if(!count($mi_piace)){
            return null;
        }
        
        return $mi_piace;
    }
    
    /**
     * Resituisce i dati del video a cui si è messo mi piace
     * 
     * @param type $video_id ID del video da cercare
     * @return Object
     */
    public static function getVideo($video_id){
        $video = Video::findById($video_id);
        
        if(!count($video)){
            return null;
        }
        
        return $video;
    }
}
