<?php

namespace App\Presenters;

use Nette;
use DibiConnection;

class UserGroupPresenter extends BasePresenter
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
            $get_user = $_SESSION['id_user'];
            $grid->setModel($this->database->select('id, nazov, popis,Count(user_group.idusergroup)as pocet,SUM(CASE iduser WHEN ' . $get_user . ' THEN 1 ELSE 0 END) as pridaj ')->from(self::TABLE1)->join(self::TABLE2)->on(self::TABLE1 . '.id = ' . self::TABLE2 . '.idusergroup')->groupBy('id,nazov'));
            $grid->setPrimaryKey("id");
            $grid->addColumnText('nazov', 'Nazov')
            ->setSortable()
            ->setFilterText()
            ->setSuggestion();
            $grid->addColumnText('popis', 'Popis')
            ->setSortable()
            ->setFilterText()
            ->setSuggestion();
            $grid->addColumnText('pocet', 'Pocet Pouzivatelov')
            ->setSortable();
            $grid->addActionHref('edit', 'Edituj');
            $grid->addActionHref('delete', 'Vymaž')
            ->setConfirm(function($item) {
            return "Chcete zmazať skupinu {$item->nazov} {$item->popis}?";
            });
            $grid->addActionHref('add', 'Pridať sa')
            ->setDisable(function($row) {
            return $row['pridaj']>0;
            });
            $grid->addActionHref('remove', 'Odobrať sa')
            ->setDisable(function($row) {
            return $row['pridaj']==0;
            });
            return $grid;
        }
            
        public function actionDelete($id) {
            $group =  $this->database->select('*')
                            ->from(self::TABLE1)
                            ->where(self::TABLE1 . '.id = %i', $id)->fetch();
            
            $this->database->delete(self::TABLE1)
                    ->where(self::TABLE1 . '.id = %i', $group->id)
                    ->execute();
            
            $this->database->delete(self::TABLE2)
                    ->where(self::TABLE2 . '.idusergroup = %i', $group->id)
                    ->execute();
            
            $this->flashMessage('Skupina bola úspešne vymazaná.', 'success');
            $this->redirect('usergroup:list');
            }
         public function actionAdd($id) {
             $get_user = $_SESSION['id_user'];
             $row['idusergroup']= $id;
             $row['iduser']= $get_user;
             $this->database->insert(self::TABLE2,$row)
                     ->execute(); 
             $this->redirect('usergroup:list');             
         }
         public function actionRemove($id) {
             $get_user = $_SESSION['id_user'];
             $this->database->delete(self::TABLE2)
                     ->where(self::TABLE2 . '.idusergroup = ', $id)
                     ->where(self::TABLE2 . '.iduser = ', $get_user)
             ->execute(); 
             $this->redirect('usergroup:list');             
         }
         public function actionEdit($id) {
             $_SESSION['id_group'] = $id;
            $this->redirect('UserGroup:e');
             /*
             $_SESSION['id_group'] = $id;
             $this->redirect('usergroup:edit');*/
         }
         protected function createComponentUsergroupForm()
	{
                $group =  $this->database->select('*')
                            ->from(self::TABLE1)
                            ->where(self::TABLE1 . '.id = %i', $_SESSION['id_group'])->fetch();
		$form = new Nette\Application\UI\Form;
                $form->addText('nazov', 'Nazov:')->setValue($group['nazov']);
                $form->addTextArea('popis', 'Popis:')->setValue($group['popis']);
		$form->addSubmit('save', 'Uložiť');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->usergroupFormSucceeded;
		return $form;
	}
         public function usergroupFormSucceeded($form){
             $values = $form->getValues();
             $this->database->update(self::TABLE1,$values)->where(self::TABLE1 . '.id = ', $_SESSION['id_group'])
                     ->execute();
             $this->redirect('UserGroup:list');
             
         }

}