<?php namespace wsiz\etester;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\ProviderRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use SleepingOwl\Admin\Facades\Navigation as AdminNavigation;
use SleepingOwl\Admin\Navigation\Page;

class etesterServiceProvider extends ServiceProvider {

	protected $providers = [
		Providers\RouteServiceProvider::class,
//		\Jenssegers\Agent\AgentServiceProvider::class,
		Providers\AdminSectionsServiceProvider::class,
	];

	protected $command = [

	];

	/**
	 * @return Factory
	 */
//	private function createLocalViewFactory() {
//		$resolver = new EngineResolver();
//		$resolver->register('php', function () {
//			return new PhpEngine();
//		});
//		$finder = new FileViewFinder($this->app['files'], [__DIR__ . '/../../resources/views']);
//		$factory = new Factory($resolver, $finder, $this->app['events']);
//		$factory->addExtension('php', 'php');
//
//		return $factory;
//	}

	protected function registerCommands() {
	}

	public function register() {
		$this->mergeConfigFrom(__DIR__ . '/config/modoee.php', 'etester');
		$this->registerCommands();
	}

	/**
	 * Register providers
	 */
	protected function registerProviders() {
		$manifestPath = $this->app->bootstrapPath() . '/cache/etester.php';
		(new ProviderRepository($this->app, new Filesystem(), $manifestPath))->load($this->providers);

//		foreach ($this->providers as $providerClass)
		//		{
		//			$provider = app($providerClass, [app()]);
		//			$provider->register();
		//		}

		if (class_exists('AdminNavigation')) {

			//edycja projektów przeniesiona do innego modułu

			AdminNavigation::addPage(\wsiz\etester\Model\Question::class)
				->setTitle("Pytania testowe")
                                ->setUrl("admin/questions")
                                ->setIcon("fa fa-pencil")
				->setPriority(10);

			AdminNavigation::addPage(\wsiz\etester\Model\field::class)
				->setTitle("Kategoria pytań")
                                ->setUrl("admin/fields")
                                ->setIcon("fa fa-pencil")
				->setPriority(10);

			AdminNavigation::addPage(\wsiz\etester\Model\Users::class)
				->setTitle("Użytkownicy")
                                ->setUrl("admin/users")
                                ->setIcon("fa fa-users")
				->setPriority(20);

			AdminNavigation::addPage(\wsiz\etester\Model\Page::class)
				->setTitle("Strony")
                                ->setUrl("admin/pages")
                                ->setIcon("fa fa-file")
				->setPriority(20);
                        
                        
			AdminNavigation::addPage(\wsiz\etester\Model\authDean::class)
				->setTitle("Egzaminy")
                                ->setUrl("admin/auth_deans")
                                ->setIcon("fa fa-blind")
				->setPriority(20);

//
		}

	}

	public function boot() {
		$this->loadViewsFrom(__DIR__ . '/views', 'etester');
		$this->loadTranslationsFrom(__DIR__ . '/Lang', 'etester');
		if (method_exists($this, "loadMigrationsFrom")) {
			$this->loadMigrationsFrom(__DIR__ . '/database/migration');
		}

//                dd(trans('modoeelang::admin.projekty'));
		//                dd(__DIR__ . '/../resources/views/default');
		//		$this->publishes([
		//			__DIR__ . '/../public/' => public_path('packages/admincolor/'),
		//		], 'assets-color'); //assets-

		$this->registerTemplate();
		$this->registerProviders();
		$this->initializeTemplate();

	}

	/**
	 * Bind current template
	 */
	protected function registerTemplate() {
		app()->bind('testTemplate', function () {
			return 'testTemplate';
		});
	}

	/**
	 * Initialize template
	 */
	protected function initializeTemplate() {
		$this->template = app('testTemplate');
                $this->loadViewsFrom(__DIR__.'/views','testTemplate');
	}

}