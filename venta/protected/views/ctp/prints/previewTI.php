<div class="col-xs-12" style="width:816px; height:528px;">

    <div class="row">
        <h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?php echo "Orden de Trabajo";?></strong></h3>

        <h4 class="col-xs-3 text-right"><strong><?php echo $ctp->codigo; ?></strong></h4>
        <h5 class="col-xs-offset-8 text-right"><strong><?php echo "FECHA:";?></strong> <?php echo date("d-m-Y",strtotime($ctp->fechaOrden));?></h5>
        <span class="col-xs-offset-3 col-xs-5 text-center"><?php echo $titulo?></span>
        <div class="col-xs-4 well well-sm">Fecha de Entrega:<?php echo (!empty($ctp->fechaEntega))?date("d-m-Y",strtotime($ctp->fechaEntega))."/":"";?></div>
    </div>

    <div class="row">
        <div class="col-xs-5"><strong><?php echo "ENCARGADO:";?></strong> <?php echo $ctp->idUserOT0->idEmpleado0->nombre." ".$ctp->idUserOT0->idEmpleado0->apellido;?></div>
        <div class="col-xs-4"><strong><?php echo "CLIENTE IMP:";?></strong> <?php echo $ctp->idCliente0->apellido;?></div>
        <div class="col-xs-3"><strong><?php echo "NRO IMPRENTA:";?></strong> <?php echo $ctp->idImprenta;?></div>

    </div>

    <div class="row well well-sm" style="min-height:200px;">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th><?php echo "Nº"; ?></th>
                <th><?php echo "Nº Placas"; ?></th>
                <th><?php echo "Colores"; ?></th>
                <th><?php echo "Formato"; ?></th>
                <th><?php echo "Trabajo"; ?></th>
                <th><?php echo "Pinza"; ?></th>
                <th><?php echo "Resol."; ?></th>
            </tr>
            </thead>

            <tbody>
            <?php $i=0; foreach ($ctp->detalleCTPs as $producto){ $i++;?>
                <tr>
                    <td>
                        <?php echo $i;?>
                    </td>
                    <td>
                        <?php echo $producto->nroPlacas; ?>
                    </td>
                    <td>
                        <?php echo (($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>K </strong>":"");?>
                    </td>
                    <td>
                        <?php echo $producto->formato;?>
                    </td>
                    <td>
                        <?php echo $producto->trabajo;?>
                    </td>
                    <td>
                        <?php echo $producto->pinza;?>
                    </td>
                    <td>
                        <?php echo $producto->resolucion;?>
                    </td>
                </tr>
            <?php }?>

            </tbody>

        </table>

        <!--   </div> -->
    </div>

    <div class="row">
        <div class="col-xs-5">
            <div class="col-xs-7 well well-sm">
                <br><br>
                <p class="text-center"><?php echo "firma";?></p>
                <div><?php echo "Nombre: "?><small><?php echo $ctp->responsable;?></small></div>
                <div class="text-center"><small><?php echo "Diseñador responsable";?></small></div>
            </div>
        </div>
        <div class="col-xs-7">
            <div class="col-xs-12"><strong>obs: </strong><?php echo $ctp->obs;?></div>
        </div>

    </div>

</div>