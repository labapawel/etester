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
class authDean extends Section
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
    protected $title="Autoryzacja dziekana";
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
             AdminColumn::text('title','Opis'),
             AdminColumn::text('testtime','Czas egzaminu'),
             AdminColumn::text('questcount','Pytań'),
             AdminColumn::custom('Aktywność')->setCallback(function($instance){
                 return $instance->active?'<i class="fa fa-check"></i>':'<i class="fa ">-</i>';
             }),
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
                    AdminFormElement::text('auth', 'Hasło'),
                    AdminFormElement::text('title', 'Opis egzaminu')->required('Opis wymagany'),
                    AdminFormElement::text('testtime', 'Czas egzaminu')->required('10 min'),
                    AdminFormElement::number('questcount', 'Ilość losowanych'),
                    AdminFormElement::checkbox('active', 'Aktywność'),
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