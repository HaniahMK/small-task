<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SynonymSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Synonyms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="synonym-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Synonym', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label'=>'Skill',
                'attribute'=>'skillCleanedText',
                'value'=> function($model)
                {return $model->getSkillCleanedText();},


            ],
            'synonym_text',


            [
                'label'=>'Synonym',
                'attribute'=>'is_original',
                'filter'=>array("0"=>"Synonym","1"=>"Original"),
                'value' => function($model)
                  { return $model->getIsOriginalText();},
                'contentOptions'=>[ 'style'=>'width: 120px'],



            ]

            ,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
