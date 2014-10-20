<?php

namespace App\Presenters;

use Nette;
use DibiConnection;

class UserPresenter extends BasePresenter
{
        /**
	 * @var \DibiConnection
	 */
	private $database;
        const TABLE = 'user';
        const TABLE1 = 'usergroup';
        const TABLE2 = 'group';
	/**
	 * @param \DibiConnection
	 */
	public function __construct(DibiConnection $database)
	{
		$this->database = $database;
	}

	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentUserForm()
	{
		$this->userFormSucceeded;
		return $form;
	}


}