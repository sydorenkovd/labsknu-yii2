<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\LessonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lessons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lessons-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lessons', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
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
                        return Yii::$app->controller->renderPartial('_poitems', [
                            'searchModel' => $searchModel
                            ,
                            'dataProvider' => $dataProvider
                        ]);
                    },
                ],

            'id',
            'teacher',
            'course',
            'room',
            'lesson_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
