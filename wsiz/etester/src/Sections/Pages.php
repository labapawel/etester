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
class Pages extends Section
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
    protected $title="Strony";
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
             AdminColumn::text('title', 'Pytanie'),
        ]);
        return $display;
    }


    public function isDeletable(\Illuminate\Database\Eloquent\Model $model) 
        {
            return false;
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
                    AdminFormElement::text('title', 'Tytuł')->required('Dodaj pytanie'),
                    AdminFormElement::ckeditor('content', 'Opis')->required('Opis do pytania'),
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