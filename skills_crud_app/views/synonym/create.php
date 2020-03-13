<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Synonym */

$this->title = 'Create Synonym';
$this->params['breadcrumbs'][] = ['label' => 'Synonyms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="synonym-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
