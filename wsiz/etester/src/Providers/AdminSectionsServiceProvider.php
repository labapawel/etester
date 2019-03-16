<?php
namespace wsiz\etester\Providers;

use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
        \wsiz\etester\Model\Question::class => 'wsiz\etester\Sections\Questions',
        \wsiz\etester\Model\User::class => 'wsiz\etester\Sections\Users',
        \wsiz\etester\Model\field::class => 'wsiz\etester\Sections\Fields',
        \wsiz\etester\Model\Page::class => 'wsiz\etester\Sections\Pages',
        \wsiz\etester\Model\authDean::class => 'wsiz\etester\Sections\authDean',
        ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
    	//

        parent::boot($admin);
    }
}
