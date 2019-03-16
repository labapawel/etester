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
class Fields extends Section
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
    protected $title="Typy pytań";
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
             AdminColumn::text('title', 'Kategoria'),
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
                    AdminFormElement::text('title', 'Kategoria')->required('Dodaj kategorie'),
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