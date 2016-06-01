<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TeachersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lessons';
?>
<div class="poitem-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'addr',
            'phone'
        ],
    ]); ?>

</div>
