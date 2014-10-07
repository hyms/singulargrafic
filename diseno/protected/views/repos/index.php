<div class="col-xs-2">
<?php $this->renderPartial('menus/principal'); ?>
</div>

<div class="col-xs-10">
    <?php
   switch ($render){
       case "rep":
           $this->renderPartial('tables/rep',array('ordenes'=>$ordenes));
           break;
       case "buscar":
           $this->renderPartial('tables/buscar',array('ordenes'=>$ordenes));
           break;
       case "repos":
           $this->renderPartial('forms/repos',array('ctp'=>$ctp,'repos'=>$repos,'detalle'=>$detalle,'otro'=>$otro));
           $this->renderPartial('scripts/save');
           $this->renderPartial('scripts/reset');
           $this->renderPartial('scripts/operaciones');
           break;
       case "modificarR":
           $this->renderPartial('cliente',array('cliente'=>$cliente,'detalle'=>$detalle,'ctp'=>$ctp,'productos'=>$productos));
           $this->renderPartial('scripts/save');
           $this->renderPartial('scripts/reset');
           break;
       default:
           echo "";
           break;
   }
    ?>
</div>