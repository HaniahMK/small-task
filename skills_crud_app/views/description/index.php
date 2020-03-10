<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DescriptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Descriptions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="description-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Description', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'skill',
                'attribute' => 'skillText',
                'value' => function($model)
                {
                    return $model->getSkillText();
                }
            ],
            'text:text',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
