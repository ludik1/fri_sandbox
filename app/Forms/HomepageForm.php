<?php

namespace App\Forms;

class HomepageForm extends \Nette\Application\UI\Form
{

	public function __construct()
	{
		parent::__construct();

		$form->addText('search', '');
		$form->addSubmit('find', 'Hľadať');

	}
}