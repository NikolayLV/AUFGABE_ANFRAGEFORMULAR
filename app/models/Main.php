<?php

namespace app\models;


use RedBeanPHP\R;

class Main extends AppModel
{

	public array $attributes = [
		'name' => '',
		'email' => '',
		'phone' => '',
		'text' => '',
	];

	public array $rules = [
		'required' => ['name', 'email', 'text'],
	];

	public array $labels = [
		'name' => 'contacts_input_name',
		'email' => 'contacts_input_email',
		'phone' => 'contacts_input_phone',
		'text' => 'contacts_input_text',
	];

}