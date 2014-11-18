<h4 class="col-xs-offset-10 text-right"><strong><?php echo $venta->codigo; ?></strong></h4>
<h3 class="col-xs-offset-8 text-right"><strong><?php echo "NOTA DE VENTA";?></strong></h3>
<div class="row">
    <span class="col-xs-3"><strong><?php echo "CLIENTE:";?></strong> <?php echo $venta->idCliente0->apellido;?></span>
    <span class="col-xs-2"><strong><?php echo "NIT:";?></strong> <?php echo $venta->idCliente0->nitCi;?></span>
    <span class="col-xs-4"><strong><?php echo "RESPONSABLE:";?></strong> <?php echo $venta->idCajaMovimientoVenta0->idUser0->idEmpleado0->apellido." ".$venta->idCajaMovimientoVenta0->idUser0->idEmpleado0->nombre;?></span>
    <span class="col-xs-3"><strong><?php echo "FECHA:";?></strong> <?php echo date("d-m-Y",strtotime($venta->fechaVenta));?></span>
</div>
<div class="col-xs-12">
    <table class="table table-hover table-condensed">
        <thead>
        <tr>
            <th><?php echo "Nº"; ?></th>
            <th><?php echo "Codigo"; ?></th>
            <th><?php echo "Detalle de producto"; ?></th>
            <th><?php echo "Cant*Costo Unidad"; ?></th>
            <th><?php echo "Cant*Costo Paquete"; ?></th>
            <th><?php echo "Adicional"; ?></th>
            <th><?php echo "Total"; ?></th>
        </tr>
        </thead>

        <tbody>
        <?php $i=0; foreach ($venta->detalleVentas as $producto){ $i++;?>
            <tr>
                <td>
                    <?php echo $i;?>
                </td>
                <td>
                    <?php echo $producto->idAlmacenProducto0->idProducto0->codigo; ?>
                </td>
                <td>
                    <?php echo $producto->idAlmacenProducto0->idProducto0->material." ".$producto->idAlmacenProducto0->idProducto0->color." ".$producto->idAlmacenProducto0->idProducto0->detalle." ".$producto->idAlmacenProducto0->idProducto0->marca;?>
                </td>
                <td>
                    <?php echo $producto->cantidadU."*".$producto->costoU;?>
                </td>
                <td>
                    <?php echo $producto->cantidadP."*".$producto->costoP;?>
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
</div>

<div class="row">
    <div class="col-xs-6"><strong>Son:</strong> <?php $this->widget('ext.numerosALetras', array('valor'=>$venta->montoVenta,'despues'=>''))?></div>
    <?php
    if($venta->formaPago==1) {
        echo '<div class="col-xs-2"><strong>' . CHtml::encode("A/C: ") . '</strong>' . CHtml::encode($venta->montoPagado) . '</div>';
        echo '<div class="col-xs-2"><strong>' . CHtml::encode("Saldo: ") . '</strong>' . CHtml::encode($venta->montoCambio * -1) . '</div>';
        echo '<div class="col-xs-2">';
    }
    else
        echo '<div class="col-xs-offset-4 col-xs-2">';
    ?>
    <strong>Total:</strong> <?php echo $venta->montoVenta." Bs.</div>";?>
</div>

<div class="row">
    <div class="col-xs-4"><strong>Forma de pago:</strong> <?php echo ($venta->formaPago==0)?CHtml::encode("Contado"):CHtml::encode("Credito")?></div>
    <div class="col-xs-4"><strong><?php echo ($venta->formaPago==1)?CHtml::encode("Fecha/Cobro:"):""?></strong> <?php echo ($venta->formaPago==1)?CHtml::encode(date("d/m/Y",strtotime($venta->fechaPlazo))):"" ?></div>
    <div class="col-xs-4"><strong><?php echo ($venta->formaPago==1)?CHtml::encode("Autorizado:"):""?></strong> <?php echo ($venta->formaPago==1)?CHtml::encode(($venta->autorizado==0)?'Erick Paredes':'Miriam Martinez'):""?></div>
</div>

<div class="row">
    <div class="col-xs-12"><strong>Observaciones: </strong ><?php echo $venta->obs; ?></div>
</div>

