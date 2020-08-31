<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "news".
 * @property int         $id
 * @property int         $user_id
 * @property string      $title
 * @property string      $content
 * @property int         $created_at
 * @property int         $updated_at
 * @property string|null $filename
 * @property Comment[]   $comments
 * @property User        $user
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['user_id', 'title', 'content'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['title', 'filename'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'filename' => 'Filename',
            'imageFile' => 'Изображение',
        ];
    }

    /**
     * Gets query for [[User]].
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return string
     */
    public function getPathOnServer(): string
    {
        return Yii::getAlias('@webroot/files/');
    }

    /**
     * @return string
     */
    public function getPathOnWeb(): string
    {
        return '/files/';
    }

    public function getImageOnWeb(): string
    {
        return $this->getPathOnWeb().$this->filename;
    }

    public function upload()
    {
        if ($this->validate()) {
            $fileName = md5(time().$this->imageFile->getBaseName()).'.'.$this->imageFile->getExtension();
            $this->filename = $fileName;

            return $this->imageFile->saveAs($this->getPathOnServer().$fileName, false);
        }

        return false;
    }
}
