<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div class="page-header">
    <h1 class="text-center">Bienvenido a <?php echo CHtml::encode(Yii::app()->name); ?></h1>
</div>
<div class="col-xs-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Record</strong>
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge pull-right">0</span>
                Ordenes Generadas
            </li>
            <li class="list-group-item">
                <span class="badge pull-right">0</span>
                Repos. Generadas

            </li>
            <li class="list-group-item">
                <span class="badge pull-right">0</span>
                Sancion Mes
            </li>
        </ul>
    </div>
</div>
<div class="col-xs-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Noticias</strong>
        </div>
        <div class="panel-body">
            Panel de Noticias
        </div>
    </div>
</div>