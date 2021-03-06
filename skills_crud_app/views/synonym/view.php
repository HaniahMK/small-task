<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Synonym */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Synonyms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="synonym-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'skill_id',
                'value' =>$model->getSkillCleanedText()
            ],
            'synonym_text',
            [
                'label'=>'Synonym/ Original',
                'attribute'=>'is_original',

                'value' => function($model)
                { return $model->getIsOriginalText();},




            ]
        ],
    ]) ?>

</div>
