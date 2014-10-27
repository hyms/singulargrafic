<?php

class NewsController extends Controller
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

    public function actionIndex()
    {
        $this->render('index',array('render'=>''));
    }

    public function actionNews()
    {
        $news = new CActiveDataProvider('News',
            array(
                'criteria'=>array('order'=>'fechaNews')
            )
        );
        $this->render('index',array('render'=>'news','data'=>$news));
    }

    public function actionNew()
    {
        $new = new News;
        if(isset($_GET['id']))
            $new = News::model()->findByPk($_GET['id']);

        if(isset($_POST['News']))
        {
            $new->attributes=$_POST['News'];
            if($new->validate())
            {
                $new->save();
                $this->redirect(array('news/news'));
            }
        }
        $this->render('index',array('render'=>'new','data'=>$new));
    }

    public function actionAsignar()
    {
        if(isset($_GET['id']))
        {
            $asignar = NewsRelation::model()->find('idNews='.$_GET['id']);
            if(empty($asignar))
            {
                $asignar = new NewsRelation;
                $asignar->idNews = $_GET['id'];
            }
            if($asignar->idNews)
                if(isset($_POST['NewsRelation']))
                {
                    $asignar->attributes = $_POST['NewsRelation'];
                    if($asignar->save())
                    {
                        $this->redirect(array('news/news'));
                    }
                }
            $this->renderPartial('forms/asignar',array('val1'=>'','val2'=>'','model'=>$asignar));
        }
    }
}