<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "course_chapter_content".
 *
 * @property integer $id
 * @property integer $couse_chapter_id
 * @property integer $upload_id
 * @property string $title
 * @property string $content
 * @property string $url
 * @property integer $order
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Upload $upload
 * @property CourseChapter $couseChapter
 */
class CourseChapterContent extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_chapter_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['couse_chapter_id', 'title'], 'required'],
            [['couse_chapter_id', 'upload_id', 'order', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['title', 'url'], 'string', 'max' => 255],
            [['upload_id'], 'exist', 'skipOnError' => true, 'targetClass' => Upload::className(), 'targetAttribute' => ['upload_id' => 'id']],
            [['couse_chapter_id'], 'exist', 'skipOnError' => true, 'targetClass' => CourseChapter::className(), 'targetAttribute' => ['couse_chapter_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'couse_chapter_id' => 'Couse Chapter ID',
            'upload_id' => 'Upload ID',
            'title' => 'Title',
            'content' => 'Content',
            'url' => 'Url',
            'order' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpload()
    {
        return $this->hasOne(Upload::className(), ['id' => 'upload_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouseChapter()
    {
        return $this->hasOne(CourseChapter::className(), ['id' => 'couse_chapter_id']);
    }
}
