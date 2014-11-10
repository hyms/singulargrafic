<div>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'form',
        'htmlOptions'=>array(
            'class'=>'form-horizontal',
            'role'=>'form',
            'enctype' => 'multipart/form-data'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>
    <p>En fechas</p>
    <div class="form-group">
        <div class="col-xs-6">
            <?php echo CHtml::label('En fechas','fechaStart',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name'=>'fechaOrden',
                        'attribute'=>'fechaOrden',
                        'language'=>'es',
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'yy-mm-dd',
                        ),
                        'htmlOptions'=>array(
                            'class'=>'form-control input-sm',
                        ),
                )); ?>
            </div>
            <?php echo $form->error($model,'nombre'); ?>
        </div>

        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'apellido',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
                <?php echo $form->textField($model,'apellido',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'apellido'); ?>
        </div>
    </div>
    <p>De</p>
    <p>Placa</p>
    <?php $this->endWidget(); ?>
</div>