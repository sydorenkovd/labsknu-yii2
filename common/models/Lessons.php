<?php

namespace common\models;

use creocoder\taggable\TaggableBehavior;
use Yii;
use common\models\Tags;
use common\models\TagLessons;
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
    public function behaviors()
    {
        return [
            'tagLessons' => [
                'class' => TaggableBehavior::className(),
                'tagRelation' => 'tagLessons'
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher', 'course'], 'integer'],
//            [['teacher', 'course'], 'require'],
            [['lesson_date','teacher', 'course'], 'safe'],
            [['room'], 'string', 'max' => 10],
//            [['teacher'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::className(), 'targetAttribute' => ['teacher' => 'id']],
//            [['course'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['course' => 'id']],
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
//            'tags' => 'Tags',
            'lesson_date' => 'Lesson Date',
        ];
    }
    public function getTagLessons()
    {
        return $this->hasMany(Tags::className(), ['id' => 'tag_id'])
            ->viaTable(TagLessons::tableName(), ['lessons_id' => 'id']);
    }
    public function getTagLesson()
    {
        return $this->hasMany(
            TagLessons::className(), ['lessons_id' => 'id']
        );
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasOne(Teachers::className(), ['id' => 'teacher']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasOne(Courses::className(), ['id' => 'course']);
    }
}
