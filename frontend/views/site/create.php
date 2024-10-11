<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Translator $model */

$this->title = Yii::t('app', 'Create Translator');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Translators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="translator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
