<div class="col-xs-12" style="width:816px;">

    <div class="row">
        <h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?php echo "Orden de Trabajo";?></strong></h3>

        <h4 class="text-right"><strong><?php echo $ctp->codigo; ?></strong></h4>
        <h5 class="col-xs-offset-8 text-right"><strong><?php echo "FECHA:";?></strong> <?php echo date("d-m-Y",strtotime($ctp->fechaOrden));?></h5>
        <small class="col-xs-offset-3 col-xs-5 text-center"><?php echo $tipo?></small>
        <div class="col-xs-4"><strong>Fecha de Entrega:</strong> <?php echo (!empty($ctp->fechaEntega))?date("d-m-Y",strtotime($ctp->fechaEntega))."/":"";?></div>
    </div>

    <?php
    if(!empty($ctp->idCliente0))
    {
        ?>
        <div class="row">
            <div class="col-xs-3"><strong><?php echo "CLIENTE:";?></strong> <?php echo $ctp->idCliente0->apellido;?></div>
            <div class="col-xs-2"><strong><?php echo "NIT:";?></strong> <?php echo $ctp->idCliente0->nitCi;?></div>
            <div class="col-xs-4"><strong><?php echo "RESPONSABLE:";?></strong> <?php echo $ctp->responsable;?></div>
            <div class="col-xs-3"><strong><?php echo "TELEFONO:";?></strong> <?php echo $ctp->idCliente0->telefono;;?></div>
        </div>
    <?php
    }
    ?>
    <table class="table table-hover table-condensed">
        <thead><tr>
            <th><?php echo "Nº"; ?></th>
            <th><?php echo "Nº Placas"; ?></th>
            <th><?php echo "Colores"; ?></th>
            <th><?php echo "Formato"; ?></th>
            <th><?php echo "Trabajo"; ?></th>
            <th><?php echo "Pinza"; ?></th>
            <th><?php echo "Resol."; ?></th>
            <th><?php echo "Adicional"; ?></th>
            <th><?php echo "Total"; ?></th>
        </tr></thead>

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
                <td>
                    <?php echo $producto->costoAdicional;?>
                </td>
                <td>
                    <?php echo $producto->costoTotal;?>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <!--   </div> -->


    <div class="row">
        <div class="col-xs-7">
            <div class="col-xs-8"><strong>Recepcionado Por:</strong> <?php echo $ctp->idUserOT0->idEmpleado0->nombre." ".$ctp->idUserOT0->idEmpleado0->apellido;?></div>
            <div class="col-xs-4">
                <?php if(empty($tipo)){?>
                <?php }else{?>
                    <strong>Atrib. a:</strong> <?php echo $ctp->responsable;?>
                <?php }?>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="col-xs-12"><strong>obs: </strong><?php if(!empty($ctp->obs)){?><br><strong>Diseño: </strong><?php echo $ctp->obs;}?><?php if(!empty($ctp->obsCaja)){?><br><strong>Caja: </strong><?php $ctp->obsCaja;}?></div>
        </div>

    </div>

</div>