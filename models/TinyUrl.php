<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tinyUrl}}".
 *
 * @property string $url
 * @property string $short
 */
class TinyUrl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tinyUrl}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'short'], 'required'],
            [['url', 'short'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'url' => Yii::t('app', 'Url'),
            'short' => Yii::t('app', 'Short'),
        ];
    }
    
    /**
     * 
     * @return type
     */
    public static function createUrl(){
        $urls = self::find()->all();
        $flag = false;//Nessun riscontro
        
        do{
            $url = self::generateString();
            
            foreach ($urls as $u){
                if($u->short == $url){
                    $flag = true;
                }
            }
        }while ($flag);
        
        return $url;
    }
    
    /**
     * Genera una stringa casuale
     * 
     * @param type $length
     */
    public static function generateString($length = 10){
        $chars = "0123456789abcdefghijklmnopqrstuvwxyz";
        $string = "";
        $i = 0;
        
        while ($i<$length){
            $c = substr($chars, rand(0, strlen($chars-1)), 1);
            
            if(!strstr($string, $c)){
                $string .= $c;
                
                $i ++;
            }
        }
        
        return $string;
    }
}
