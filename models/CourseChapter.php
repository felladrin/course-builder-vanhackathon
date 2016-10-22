<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "course_chapter".
 *
 * @property integer $id
 * @property integer $couse_id
 * @property string $title
 * @property integer $order
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Course $couse
 * @property CourseChapterContent[] $courseChapterContents
 */
class CourseChapter extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_chapter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['couse_id', 'title'], 'required'],
            [['couse_id', 'order', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['couse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['couse_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'couse_id' => 'Couse ID',
            'title' => 'Title',
            'order' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouse()
    {
        return $this->hasOne(Course::className(), ['id' => 'couse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseChapterContents()
    {
        return $this->hasMany(CourseChapterContent::className(), ['couse_chapter_id' => 'id']);
    }
}
