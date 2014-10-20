<?php

namespace App\Presenters;

use Nette;
use DibiConnection;

class HomepagePresenter extends BasePresenter
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
	protected function createComponentHomepageForm()
	{
		$form = new Nette\Application\UI\Form;
                
		$form->addText('search', '');

		$form->addSubmit('find', 'Hľadať');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}


	public function signInFormSucceeded($form)
	{
            $values = $form->getValues();
            $query = $this->database->select('*')
			->from(self::TABLE)
			->where(self::TABLE . '.email = %s', $values->search)->fetchAll();  
            ?><table style="border: 1px solid black;top: 200px;position: fixed;"><?php
            foreach ($query as $q){?>                        
                        <tr>
                          <td><?php echo 'Meno: '.$q->meno; ?></td>
                          <td><?php echo 'Priezvisko: '.$q->priezvisko; ?></td>		
                        </tr>
                      <?php
            }   
            $query = $this->database->select('*')
			->from(self::TABLE)
			->where(self::TABLE . '.meno = %s', $values->search)->fetchAll();                             
            foreach ($query as $q){?>                        
                        <tr>
                          <td><?php echo 'Meno: '.$q->meno; ?></td>
                          <td><?php echo 'Priezvisko: '.$q->priezvisko; ?></td>		
                        </tr>
                      <?php
            }
            $query = $this->database->select('*')
			->from(self::TABLE1)
			->where(self::TABLE1 . '.nazov = %s', $values->search)->fetchAll();                             
            foreach ($query as $q1){ 
                $query1 = $this->database->select('*')
			->from(self::TABLE2)
			->where(self::TABLE2 . '.idusergroup = %s', $q1->id)->fetchAll();
                foreach ($query1 as $q2){ 
                    $query2 = $this->database->select('*')
			->from(self::TABLE)
			->where(self::TABLE . '.id = %s', $q2->iduser)->fetchAll();
                    foreach ($query2 as $q3){ ?>                        
                        <tr>
                          <td><?php echo 'Meno: '.$q3->meno; ?></td>
                          <td><?php echo 'Priezvisko: '.$q3->priezvisko; ?></td>		
                        </tr>
                      <?php                  
                    }
                }
            }
            ?></table><?php
        }

}