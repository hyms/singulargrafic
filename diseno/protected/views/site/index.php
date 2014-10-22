<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Bienvenido a <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<div class="col-xs-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Record</strong>
        </div>
        <div class="panel-body">
            <ul>
                <li>
                    Ordenes Generadas
                </li>
                <li>
                    Repos. Generadas
                </li>
                <li>
                    Sancion Mes
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="col-xs-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Noticias</strong>
        </div>
        <div class="panel-body">
            Noticias del dia
        </div>
    </div>
</div>