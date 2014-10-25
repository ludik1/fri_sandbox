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
        const TABLE2 = 'user_group';
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
            $grid->setModel($this->database->select('user.id,user.meno,user.email,usergroup.nazov')->from(self::TABLE)->join(self::TABLE2)->on(self::TABLE . '.id = ' . self::TABLE2 . '.iduser')->join(self::TABLE1)->on(self::TABLE1 . '.id = ' . self::TABLE2 . '.idusergroup'));
            $grid->setPrimaryKey("id");
            $grid->addColumnText('meno', 'Meno')
            ->setSortable()
            ->setFilterText()
            ->setSuggestion();
            $grid->addColumnText('email', 'Email')
            ->setSortable()
            ->setFilterText()
            ->setSuggestion();
            $grid->addColumnText('nazov', 'Nazov')
            ->setSortable()
            ->setFilterText()
            ->setSuggestion();

            return $grid;
            }

}