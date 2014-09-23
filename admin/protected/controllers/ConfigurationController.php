<?php
class ConfigurationController extends Controller
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

    public function verifyModel($model)
    {
        if($model===null)
            throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
        return $model;
    }
}