<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Nueva Noticia</strong>
    </div>
    <div class="panel-body">

        <div class="form">

            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'news-news-form',
                'htmlOptions'=>array(
                    'class'=>'form-horizontal',
                    'role'=>'form'
                ),
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // See class documentation of CActiveForm for details on this,
                // you need to use the performAjaxValidation()-method described there.
                'enableAjaxValidation'=>false,
            )); ?>


            <div class="form-group">
                <?php echo $form->labelEx($model,'titulo',array('class'=>'col-xs-2 control-label')); ?>
                <div class="col-xs-10">
                    <?php echo $form->textField($model,'titulo',array('class'=>'form-control')); ?>
                </div>
                <?php echo $form->error($model,'titulo'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'detalle',array('class'=>'col-xs-2 control-label')); ?>
                <div class="col-xs-10">
                    <?php echo $form->textArea($model,'detalle',array('class'=>'form-control')); ?>
                </div>
                <?php echo $form->error($model,'detalle'); ?>
            </div>

            <div class="form-group">
                <div class="col-xs-5">
                    <?php echo $form->labelEx($model,'fechaLimite',array('class'=>'col-xs-4 control-label')); ?>
                    <div class="col-xs-8">
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name'=>'fechaLimite',
                            'attribute'=>'fechaLimite',
                            'language'=>'es',
                            'model'=>$model,
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'yy-mm-dd',
                            ),
                            'htmlOptions'=>array(
                                'class'=>'form-control',
                            ),
                        )); ?>
                    </div>
                    <?php echo $form->error($model,'fechaLimite'); ?>
                </div>

                <div class="col-xs-5">
                    <?php echo $form->labelEx($model,'prioridad',array('class'=>'col-xs-4 control-label')); ?>
                    <div class="col-xs-8">
                        <?php echo $form->dropDownList($model,'prioridad',array('1'=>'Alta','2'=>'Normal','3'=>'Baja'),array('class'=>'form-control','empty'=>'')); ?>
                    </div>
                    <?php echo $form->error($model,'prioridad'); ?>
                </div>

                <?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default')); ?>
            </div>

            <div class="form-group">

            </div>

            <?php $this->endWidget(); ?>

        </div><!-- form -->
    </div>
</div>