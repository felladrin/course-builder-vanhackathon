<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "course_chapter_content".
 *
 * @property integer $id
 * @property integer $course_chapter_id
 * @property integer $upload_id
 * @property string $title
 * @property string $content
 * @property string $url
 * @property integer $order
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Upload $upload
 * @property CourseChapter $courseChapter
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
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_chapter_id', 'title'], 'required'],
            [['course_chapter_id', 'upload_id', 'order', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['title', 'url'], 'string', 'max' => 255],
            [['upload_id'], 'exist', 'skipOnError' => true, 'targetClass' => Upload::className(), 'targetAttribute' => ['upload_id' => 'id']],
            [['course_chapter_id'], 'exist', 'skipOnError' => true, 'targetClass' => CourseChapter::className(), 'targetAttribute' => ['course_chapter_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_chapter_id' => 'Course Chapter ID',
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
    public function getCourseChapter()
    {
        return $this->hasOne(CourseChapter::className(), ['id' => 'course_chapter_id']);
    }

    public static function findByChapterOrder($course_chapter_id, $order) {
        return static::findOne(['course_chapter_id' => $course_chapter_id, 'order' => $order]);
    }

    public function moveUp() {
        $this->order--;
        $this->save();
    }

    public function moveDown() {
        $this->order++;
        $this->save();
    }

    /**
     * Get Youtube video ID from URL
     *
     * @param string $url
     * @return string|null Youtube video ID or NULL if not found.
     */
    public static function getYoutubeIdFromUrl($url)
    {
        if (empty($url)) return null;

        $parts = parse_url($url);

        if (isset($parts['query']))
        {
            parse_str($parts['query'], $qs);

            if (isset($qs['v']))
            {
                return $qs['v'];
            }
            else if (isset($qs['vi']))
            {
                return $qs['vi'];
            }
        }

        if (isset($parts['path']))
        {
            $path = explode('/', trim($parts['path'], '/'));
            return $path[count($path) - 1];
        }

        return null;
    }

    /**
     * Receives any form of youtube url and returns the default one (like "https://www.youtube.com/watch?v=Sagg08DrO5U")
     *
     * @param string $url
     * @return string The youtube default URL if it was an youtube video. Null otherwise.
     */
    public static function getYoutubeDefaultUrl($url)
    {
        if (empty($url)) return null;

        $youtubeId = static::getYoutubeIdFromUrl($url);

        if (!empty($youtubeId))
        {
            return "https://www.youtube.com/watch?v=" . static::getYoutubeIdFromUrl($url);
        }

        return null;
    }
}
