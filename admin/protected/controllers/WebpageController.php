<?php

class WebpageController extends Controller
{
	
	public function actionIndex()
	{
		// renders the view file 'protected/views/webpage/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
}
