<?php

use frontend\models\Translator;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use aki\vue\Vue;

/** @var yii\web\View $this */
/** @var frontend\models\search\Translator $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Translators');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="translator-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Translator'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Vue::begin([
        'id' => "vue_app",
        'data' => [
            'color' => "green",
            'ids' => array_keys(\yii\helpers\ArrayHelper::index($dataProvider->models, 'id')),
        ],
        'methods' => [
            'toggleColor' => new yii\web\JsExpression("function(){"
                . "this.color = this.color === 'green' ? 'blue' : 'green' "
                . "}"),
        ],
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            //'weekend_work:boolean',
            [
                'attribute' => 'weekend_work',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<span :style="{ color }" @click="toggleColor">'
                        . Yii::$app->formatter->asBoolean($model->weekend_work)
                        . '</span>';
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Translator $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    <?php Vue::end(); ?>

</div>
