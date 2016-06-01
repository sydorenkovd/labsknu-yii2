<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lessons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lessons-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation'=> true, 'options' => ['enctype' => 'multipart/form-data']]); ?>

<!--    --><?//= $form->field($model, 'teacher')->textInput() ?>
    <?= $form->field($model, 'teacher')->dropDownList(
        \yii\helpers\ArrayHelper::map(\common\models\Teachers::find()->all(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select a Teacher'),
            'id' => 'name',
        ]
    ) ?>
<!--    --><?//= $form->field($model, 'course')->textInput() ?>
    <?= $form->field($model, 'course')->dropDownList(
        \yii\helpers\ArrayHelper::map(\common\models\Courses::find()->all(), 'id', 'title'),
        ['prompt' => Yii::t('app', 'Select a Teacher'),
            'id' => 'title',
        ]
    ) ?>
    <?= $form->field($model, 'room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lesson_date')->widget(
        \yii\jui\DatePicker::className(), [
            'inline' => false,
//            'clientOptions' => [
//                'autoclose' => true,
            'dateFormat' => 'yyyy-MM-dd',
//            ]
        ]
    ); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $script = <<< JS
$('form#{$model->formName()}').on('beforeSubmit', function(e){
 var \$form = $(this);
 $.post(
 \$form.attr("action"), //serialize Yii2 form
 \$form.serialize()
 )
    .done(function(result){
    if(result.message == 1){
        $(\$form).trigger("reset");
        $.pjax.reload({container:'#w0'});
    } else {

    $("#message").html(result);
    }
    }).fail(function(){
    console.log('server error');
    });
    return false;
});
JS;
$this->registerJs($script);