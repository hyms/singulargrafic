<?php
class ProductosController extends Controller
{
    public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'expression'=>'isset($user->role) && ($user->role==="1")',
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionProductos()
    {
        if(isset($_GET['excel']) && isset(Yii::app()->session['excel']))
        {
            $model= Yii::app()->session['excel'];
            $dataProvider= $model->searchInventarioGral();
            $dataProvider->pagination= false; // for retrive all modules
            $data = $dataProvider->data;

            $columnsTitle=array('Nro','Codigo','Material','Detalle Producto','Precio S/F','Precio C/F','Industria','Cant.xPaqt.','Stock Unidad','Stock Paquete');
            $content=array();
            $index=1;
            foreach ($data as $item)
            {
                array_push($content,array($index,
                    $item->idProducto0->codigo,
                    $item->idProducto0->material,
                    $item->idProducto0->color." ".$item->idProducto0->detalle." ".$item->idProducto0->marca,
                    $item->idProducto0->precioSFU."/".$item->idProducto0->precioSFP,
                    $item->idProducto0->precioCFU."/".$item->idProducto0->precioCFP,
                    $item->idProducto0->industria,
                    $item->idProducto0->cantXPaquete,
                    $item->stockU,
                    $item->stockP));
                $index++;
            }
            $this->createExcel($columnsTitle, $content);
        }
        $dataProvider = new AlmacenProducto('searchInventarioGral');

        $dataProvider->unsetAttributes();
        if(isset($_GET['AlmacenProducto']))
        {
            $dataProvider->attributes = $_GET['AlmacenProducto'];
            $dataProvider->codigo = $_GET['AlmacenProducto']['codigo'];
            $dataProvider->industria = $_GET['AlmacenProducto']['industria'];
            $dataProvider->material = $_GET['AlmacenProducto']['material'];
            $dataProvider->detalle = $_GET['AlmacenProducto']['detalle'];
        }

        $this->render('index',array(
            'dataProvider'=>$dataProvider
        ));
    }

    public function verifyModel($model)
    {
        if($model===null)
            throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
        return $model;
    }
}