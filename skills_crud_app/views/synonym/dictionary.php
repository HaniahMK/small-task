<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SynonymSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Skills Dictionary";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="synonym-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],


            [
                'label'=>'Skill',
                'attribute'=>'skillCleanedText',
                'value'=> function($model)
                {return $model->getSkillCleanedText();},
                'group' => true,



            ],
            [
                'label'=>'Original Text',
                'attribute'=>'synonym_text',
                'value'=>function ($model)
                {return $model->getOriginalText();},
                'group' => true,
            ],

            [
                'label'=>'Synonym',
                'attribute'=>'synonym_text',
                'value'=>function ($model)
                {	if(!$model->is_original)
                    return $model->synonym_text;
                    return "";},





            ],








        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
