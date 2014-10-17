<div class="hidden-print">
    <?php
    echo CHtml::link('<span class="glyphicon glyphicon-print"></span>', '#', array("class"=>"btn btn-default","id"=>"print",'title'=>'Imprimir'));
    if(!empty($tipo))
    {
        if($ctp->estado==1)
            echo " ".CHtml::link('<span class="glyphicon glyphicon-ok-circle"></span>',array('ctp/validar','id'=>$ctp->idCTP), array("class"=>"btn btn-success","id"=>"validar",'title'=>'Validar Orden','confirm'=>'Esta seguro de la Validación?'));
    }

    if($ctp->estado!=1)
    {
        //echo " ".CHtml::link('<span class="glyphicon glyphicon-remove-circle"></span>','#', array("class"=>"btn btn-danger","id"=>"validar",'title'=>'Cancelar Orden'));
    }
    ?>
</div>