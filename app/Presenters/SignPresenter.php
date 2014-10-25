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
        
        protected function createComponentRegForm()
	{
		$form = new Nette\Application\UI\Form;
                $form->addText('meno', 'Meno:');
                $form->addText('priezvisko', 'Priezvisko:');
		$form->addText('email', 'Email:');
                $form->addPassword('heslo', 'Heslo:')
                     ->setRequired('Zvolte si heslo');
                /*$form->addPassword('passwordVerify', 'Heslo pro kontrolu:')
                     ->setRequired('Zadejte prosím heslo ještě jednou pro kontrolu');*/
                $form->addText('vek', 'Vek:');
		
                //$form->addPassword('password2', 'Heslo znovu:');
		$form->addSubmit('send', 'Registrovať');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->regFormSucceeded;
		return $form;
	}
        
        protected function createComponentSignOutForm()
	{
		$this->redirect('Sign:in');
	}
	public function regFormSucceeded($form)
        {
            $values = $form->getValues();
            $values['datum'] = date("Y-m-d H:i:s");
        //if($values->password1 == $values->password2){
            $this->database->insert(self::TABLE,$values)
        ->execute(); 
            $this->redirect('Sign:in');
        /*}
        else{
            $this->flashMessage('Nezadali ste 2 krat to iste heslo.');            
        }*/
        }

	public function signInFormSucceeded($form)
	{
            $values = $form->getValues();
            
            $query = $this->database->select('*')
			->from(self::TABLE)
			->where(self::TABLE . '.email = %s', $values->email)->fetch();      
            $article['datum'] = date("Y-m-d H:i:s");
            
            if(isset($query->heslo) and $query->heslo == $values->password){
            $_SESSION["id_user"] = $query->id;
            $this->database->update(self::TABLE,$article)
				->where(self::TABLE, '.email = %s', $query->email)
				->execute();            
            $this->redirect('Homepage:');            
            }
            else{                
                $form->addError('Neplatné heslo.');
            }        
        }


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('Boli ste odhlaseny.');
		$this->redirect('in');
	}

}
