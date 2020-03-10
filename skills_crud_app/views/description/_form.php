<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use  yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Description */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="description-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'skill_id')->dropDownList(
        ArrayHelper::map(\app\models\Skill::find()->all(),'id','cleaned_text'),
        ['prompt' => null]
    )->label('Skill')
    ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
