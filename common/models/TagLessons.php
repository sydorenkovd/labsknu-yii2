<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_tagLessons}}".
 *
 * @property integer $tag_id
 * @property integer $post_id
 */
class TagLessons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_tagLessons}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'post_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'post_id' => 'Lessons ID',
        ];
    }
    public function getLessons(){
        return $this->hasOne(Lessons::className(), ['id' => 'post_id']);
    }
    public function getTag(){
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }
}
