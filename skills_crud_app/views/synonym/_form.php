<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use  yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Synonym */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="synonym-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'skill_id')->dropDownList(
        ArrayHelper::map(\app\models\Skill::find()->all(),'id','cleaned_text')) ?>

    <?= $form->field($model, 'synonym_text')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_original')->dropDownList(['1'=>'Original', '0'=>'Synonym']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
