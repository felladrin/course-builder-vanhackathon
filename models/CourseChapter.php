<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "course_chapter".
 *
 * @property integer $id
 * @property integer $course_id
 * @property string $title
 * @property integer $order
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Course $course
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
            [['course_id', 'title'], 'required'],
            [['course_id', 'order', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => 'course ID',
            'title' => 'Title',
            'order' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getcourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseChapterContents()
    {
        return $this->hasMany(CourseChapterContent::className(), ['course_chapter_id' => 'id']);
    }

    /**
     * @param $course_id
     * @param $order
     * @return static
     */
    public static function findByCourseOrder($course_id, $order) {
        return static::findOne(['course_id' => $course_id, 'order' => $order]);
    }

    public function moveUp() {
        $this->order--;
        $this->save();
    }

    public function moveDown() {
        $this->order++;
        $this->save();
    }
}
