<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%permessi}}".
 *
 * @property integer $id
 * @property string $permesso
 * @property integer $parent_id
 *
 * @property UtentiHasConcorsoPermessi[] $utentiHasConcorsoPermessis
 * @property Utenti[] $utentis
 */
class Permessi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%permessi}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permesso'], 'required'],
            [['parent_id'], 'integer'],
            [['permesso'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'permesso' => Yii::t('app', 'Permesso'),
            'parent_id' => Yii::t('app', 'Parent ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtentiHasConcorsoPermessis()
    {
        return $this->hasMany(UtentiHasConcorsoPermessi::className(), ['permessi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtentis()
    {
        return $this->hasMany(Utenti::className(), ['id' => 'utenti_id'])->viaTable('{{%utenti_has_concorso_permessi}}', ['permessi_id' => 'id']);
    }
}
