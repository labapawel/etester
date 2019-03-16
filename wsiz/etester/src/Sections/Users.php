<?php
namespace wsiz\etester\Sections;
use AdminColumn;
use AdminDisplay;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Section;
/**
 * Class Contacts
 *
 * @property \App\Model\Contact $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Users extends Section
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;
    /**
     * @var string
     */
//    protected $alias;
     protected $title="Użytkownicy admina";

    /**
     * @return DisplayInterface
     */
    public function onDisplay($scopes = [])
    {
        $display = AdminDisplay::datatablesAsync()
                    ->setDisplaySearch(true)
                    ->paginate(10);
        $display->setColumns([
             AdminColumn::custom('ID')->setCallback(function($instance){
                 return $instance->id;
             }),
             AdminColumn::text('name', 'Nazwa'),
             AdminColumn::text('email', 'Email')
        ]);
        return $display;
    }
    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::panel();
        $form->setItems(
            AdminFormElement::columns()
            ->addColumn(function() {
                return [
                    AdminFormElement::text('name', 'Nazwa')->required('Podaj imie'),
                    AdminFormElement::text('email', 'Email')->required('e-mail'),
                    AdminFormElement::password('password', 'Hasło'),
                ];
            })
        );
        return $form;
    }
    
    public function onDelete($id) {
        
    }
    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }
}