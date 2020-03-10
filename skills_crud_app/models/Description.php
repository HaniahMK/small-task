<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "description".
 *
 * @property int $id
 * @property int $skill_id
 * @property string $text
 */
class Description extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $skillText;
    public static function tableName()
    {
        return 'description';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['skill_id', 'text'], 'required'],
            [['skill_id'], 'integer'],
            [['text'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'skill_id' => 'Skill',
            'text' => 'Text',
        ];
    }
    public function getSkill()
    {

        return $this->hasOne(Skill::class, ['id' => 'skill_id']);
    }

    public function getSkillText()
    {
        return $this->skill ? $this->skill->cleaned_text :'';
    }
}
