<?php


	namespace app\controllers;


	use app\models\AppModel;
	use app\models\Wishlist;
	use app\widgets\language\Language;
	use RedBeanPHP\R;
	use wfm\App;
	use wfm\Controller;

	class AppController extends Controller
	{

		public function __construct($route)
		{
			parent::__construct($route);
			new AppModel();

		}

	}