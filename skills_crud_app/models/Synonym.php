<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "synonym".
 *
 * @property int $id
 * @property int $skill_id
 * @property string $synonym_text
 * @property bool $is_original
 */
class Synonym extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $skillCleanedText;
    public static function tableName()
    {
        return 'synonym';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['skill_id', 'synonym_text'], 'required'],
            [['skill_id'], 'integer'],
            [['is_original'], 'boolean'],
            [['synonym_text'], 'string', 'max' => 1000],
            [['skillCleanedText'],'string'],
            [['skill_id','is_original'],'ValidateOriginal','skipOnEmpty' => false, 'skipOnError' => false]

        ];
    }
    function ValidateOriginal($attribute, $params)
    { $has_original= count($this->find()->where(['skill_id'=>$this->skill_id])
                                ->andWhere(['is_original'=>1])->all());

          if($this->is_original && $has_original >0)
                $this->addError($attribute,"Skill already has original text");

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'skill_id' => 'Skill',
            'synonym_text' => 'Synonym Text',
            'is_original' => 'Original Text/ Synonym',
        ];
    }
    public function getSkill()
    {

        return $this->hasOne(Skill::class, ['id' => 'skill_id']);
    }

    public function getSkillCleanedText()
    {
        return $this->skill ? $this->skill->cleaned_text :'';
    }
    public function getIsOriginalText()
    {
        return $this->is_original ? 'Original': 'Synonym';
    }

    public function getOriginalText()
    {
        $orginal_text=$this->find()->select(['synonym_text'])->where(['skill_id' =>$this->skill_id] )
            ->andWhere(['is_original'=>1])
            ->one();
        return  $orginal_text['synonym_text'];


    }


}
