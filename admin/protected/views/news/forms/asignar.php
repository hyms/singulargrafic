<div>
    <?php
    echo CHtml::checkBox('todos',$val1);
    echo CHtml::checkBox('sucursal',$val2);
    echo CHtml::activeDropDownList($model,'idSucursal',CHtml::listData(Sucursal::model()->findAll(),'idSucursal','nombre'),array('class'=>'form-control'))
    ?>
</div>