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
        const TABLE2 = 'user_group';
        
        public $userModel;
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
        public function createComponentGrid($name) {             
            $grid = new \Grido\Grid($this, $name);            
            $grid->setModel($this->database->select('id, meno, priezvisko, email, vek, datum')->from(self::TABLE));
            $grid->setPrimaryKey("id");
            $grid->addColumnText('meno', 'Meno')
            ->setSortable()
            ->setFilterText()
            ->setSuggestion();
            $grid->addColumnText('priezvisko', 'Priezvisko')
            ->setSortable()
            ->setFilterText()
            ->setSuggestion();
            $grid->addColumnText('email', 'Email')
            ->setSortable()
            ->setFilterText()
            ->setSuggestion();
            $grid->addColumnText('datum', 'Datum')
            ->setSortable()
            ->setFilterDate();
            $grid->addActionHref('delete', 'Delete')
            ->setConfirm(function($item) {
            return "Určite chcete zmazať používateľa {$item->meno} {$item->priezvisko}?";
            });
            return $grid;
            }
            public function actionDelete($id) {
                $get_user = $_SESSION['id_user'];
                $user =  $this->database->select('*')
                        ->from(self::TABLE)
                        ->where(self::TABLE . '.id = %i', $id)->fetch();
                $this->database->delete(self::TABLE)
                        ->where(self::TABLE . '.id = %i', $user->id)
                        ->execute();
                $this->database->delete(self::TABLE2)
                        ->where(self::TABLE2 . '.iduser = %i', $user->id)
                        ->execute();
                $this->flashMessage('Užívateľ bol úspešne zmazaný.', 'success');
                if ($get_user == $id) {
                $this->redirect('Sign:out');
                }
                $this->redirect('list');
            }


}