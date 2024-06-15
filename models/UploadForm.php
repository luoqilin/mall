<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $uploadFile;

    public function rules()
    {
        return [
            ['uploadFile', 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'ico', 'css', 'js'],  'maxSize' => 1024*1024*1024, 'maxFiles' => 4],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->uploadFile as $file) {
                $file->saveAs(Yii::$app->basePath.'/web/assets/uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }

}