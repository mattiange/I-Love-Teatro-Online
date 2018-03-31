<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%commenti}}".
 *
 * @property integer $id
 * @property string $commento
 * @property integer $utenti_id
 *
 * @property Utenti $utenti
 */
class Commenti extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%commenti}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['commento', 'utenti_id'], 'required'],
            [['utenti_id'], 'integer'],
            [['commento'], 'string', 'max' => 45],
            [['utenti_id'], 'exist', 'skipOnError' => true, 'targetClass' => Utenti::className(), 'targetAttribute' => ['utenti_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'commento' => Yii::t('app', 'Commento'),
            'utenti_id' => Yii::t('app', 'Utenti ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtenti()
    {
        return $this->hasOne(Utenti::className(), ['id' => 'utenti_id']);
    }
}
