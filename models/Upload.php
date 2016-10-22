<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "upload".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $uniqid
 * @property string $extension
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CourseChapterContent[] $courseChapterContents
 * @property User $user
 */
class Upload extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'upload';
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
            [['user_id', 'uniqid', 'extension'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['uniqid', 'extension'], 'string', 'max' => 255],
            [['uniqid'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'uniqid' => 'Uniqid',
            'extension' => 'Extension',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseChapterContents()
    {
        return $this->hasMany(CourseChapterContent::className(), ['upload_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
