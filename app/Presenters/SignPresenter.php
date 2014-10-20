<?php

namespace App\Presenters;

use Nette;
use DibiConnection;


/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{
        /**
	 * @var \DibiConnection
	 */
	private $database;
        const TABLE = 'user';

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
	protected function createComponentSignInForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('email', 'Email:')
			->setRequired('Please enter your email.');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Please enter your password.');

		$form->addSubmit('send', 'Prihlásiť');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}


	public function signInFormSucceeded($form)
	{
            $values = $form->getValues();
            
            $query = $this->database->select('*')
			->from(self::TABLE)
			->where(self::TABLE . '.email = %s', $values->email)->fetch();                             

            if($query->heslo == $values->password){  
            $this->redirect('Homepage:');            
            }
            else{                
                $form->addError('Neplatné heslo.');
            }        
        }


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}

}
