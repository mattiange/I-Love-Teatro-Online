<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;
    public $titolo;
    /**
     * 
     * @return type
     */
    public function rules()
    {
         return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'avi, mkv, wmv, mp4'],
            [['titolo'], 'string', 'max' => 250],
        ];
    }
    
    /**
     * 
     * @return boolean
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @param type $size
     * @return type
     */
    public function generateFilename($size = 20){
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $size; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        
        return $key;
    }
}