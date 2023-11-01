<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Job;
$items = Job::find()
        ->select(['name'])
        ->indexBy('id')
        ->column();

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_user')->hiddenInput(['value'=>Yii::$app->user->getId()])->label(false) ?>

    <?= $form->field($model, 'id_job')->dropdownList([
      $items,['prompt'=>'Select Category']
    ],)
     ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'family')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'childs')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
