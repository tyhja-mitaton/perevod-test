<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use aki\vue\Vue;

/** @var yii\web\View $this */
/** @var frontend\models\Translator $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Translators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="translator-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php Vue::begin([
        'id' => "vue_app",
        'data' => [
            'color' => $model->weekend_work ? "green" : "red",
            'status' => Yii::$app->formatter->asBoolean($model->weekend_work),
        ],
        'methods' => [
            'toggleColor' => new yii\web\JsExpression("function(){"
                . "let self = this;"
                . "$.ajax({"
                    . "type: 'GET',"
                    . "url: 'switch-status?id=" . $model->id . "',"
                    . "success: function(data) {"
                        . "$('.job-format span').text(data);"
                        . "self.color = self.color === 'green' ? 'red' : 'green'; "
                        . 'self.status = self.status === "Yes" ? "No" : "Yes";'
                    . "}"
                . "});"
                . "}"),
        ],
    ]); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            //'weekend_work:boolean',
            [
                'attribute' => 'weekend_work',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<span :style="{ color }" @click="toggleColor">{{status}}</span>';
                },
                'options' => ['class' => 'job-format'],
            ],
        ],
    ]) ?>
    <?php Vue::end(); ?>
</div>
