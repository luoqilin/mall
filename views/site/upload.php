<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'uploadFile[]')->fileInput(['multiple' => true, 'accept' => '*/*']) ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>