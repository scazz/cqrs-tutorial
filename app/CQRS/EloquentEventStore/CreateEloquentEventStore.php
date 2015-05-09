<?php
namespace App\CQRS\EloquentEventStore;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Input\InputOption;

class CreateEloquentEventStore extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'eloquenteventstore:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new table for the eloquent event store';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		Schema::create('domain_events', function($table)
		{
			$table->increments('id');
			$table->string('uuid');
			$table->text('event_payload');
			$table->dateTime('recorded_at');
		});
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
		];
	}

}
