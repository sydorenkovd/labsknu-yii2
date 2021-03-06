<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\LessonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lessons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lessons-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a('Create Lessons', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('Create Lesson',['value' => Url::to('/lessons/create'),
            'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    <div class="tags">
        <?php
        $tags = [];
//        foreach($model->getTagLesson()->all() as $postTag) {
//            $tag = $postTag->getTag()->one();
//            $tags[] = Html::a($tag->name, Yii::$app->urlManager
//                ->createUrl(['lessons/order-tags', 'tag' => $tag->name]), ['class' => 'btn btn-default btn-sm']);
//        } ?>
<? print_r($model->getTagLessons()->all())?>
<!--        Тэги: --><?//= implode($tags, ' | ') ?>
    </div>
    </p>
    <?php
    Modal::begin([
        'header' => '<h4>Lessons</h4>',
        'id' => 'modal',
        'size' => 'modal-lg',

    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>
<?php Pjax::begin(['id' => 'w0']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
            'export' => false,
            'perfectScrollbar' => true,
            'columns' => [
                [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'value' => function($model, $key, $index, $column){
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail' => function($model, $key, $index, $column){
                        $searchModel = new \common\models\TeachersSearch();
                        $searchModel->id = $model->teacher;
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                        return Yii::$app->controller->renderPartial('_teachers', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,

                        ]);
                    },
                ],

            'id',
            'teachers.name',
            'courses.title',
            'room',
            'lesson_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
