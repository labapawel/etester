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
class Questions extends Section
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
    protected $title="Pytania testowe";
    /**
     * @return DisplayInterface
     */
    public function onDisplay($scopes = [])
    {
        $display = AdminDisplay::datatablesAsync()
                    ->setDisplaySearch(true)
                    ->paginate(10);
        $display->with('types');
        $display->setColumns([
             AdminColumn::custom('ID')->setCallback(function($instance){
                 return $instance->id;
             }),
             AdminColumn::text('title', 'Pytanie'),
             AdminColumn::custom('Kategoria')->setCallback(function($instance){
                 return $instance->types!=null?$instance->types->title:"";
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
                    AdminFormElement::text('title', 'Pytanie')->required('Dodaj pytanie'),
                    AdminFormElement::ckeditor('question', 'Opis')->required('Opis do pytania'),
                    AdminFormElement::ckeditor('response1', 'Odpowiedź 1')->required(),
                    AdminFormElement::ckeditor('response2', 'Odpowiedź 2')->required(),
                    AdminFormElement::ckeditor('response3', 'Odpowiedź 3')->required(),
                    AdminFormElement::number('correct', 'Poprawna')->setMax(3)->setDefaultValue(1)->setMin(1)->required(),
//                    AdminFormElement::number('type', 'type')->setMax(100)->setDefaultValue(1)->setMin(1)->required(),
                    AdminFormElement::radio('type', 'Kategoria')
                        ->setDisplay('title')
                        ->setModelForOptions(\wsiz\etester\Model\field::class),
                    AdminFormElement::checkbox('active', 'Aktywność')->setDefaultValue(1),
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