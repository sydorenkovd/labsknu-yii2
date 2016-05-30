<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lessons".
 *
 * @property integer $id
 * @property integer $teacher
 * @property integer $course
 * @property string $room
 * @property string $lesson_date
 *
 * @property Teachers $teacher0
 * @property Courses $course0
 */
class Lessons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lessons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher', 'course'], 'integer'],
            [['lesson_date'], 'safe'],
            [['room'], 'string', 'max' => 10],
            [['teacher'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::className(), 'targetAttribute' => ['teacher' => 'id']],
            [['course'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['course' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teacher' => 'Teacher',
            'course' => 'Course',
            'room' => 'Room',
            'lesson_date' => 'Lesson Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher0()
    {
        return $this->hasOne(Teachers::className(), ['id' => 'teacher']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse0()
    {
        return $this->hasOne(Courses::className(), ['id' => 'course']);
    }
}
