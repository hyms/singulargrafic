<div class="col-xs-2">
    <?php
    $this->renderPartial('menus/principal');
    ?>
</div>
<div class="col-xs-10">
    <?php
    switch ($render){
        case "news":
            $this->renderPartial('tables/news',array('data'=>$data));
            break;
        case 'new':
            $this->renderPartial('forms/news',array('model'=>$data));
            break;
        default:
            break;
    }
    ?>
</div>