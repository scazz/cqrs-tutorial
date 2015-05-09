<?php
namespace App\CQRS\EloquentEventStore;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class DropEloquentEventStore extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'eloquenteventstore:drop';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Drop the table for the eloquent event store.';

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
		Schema::dropIfExists('domain_events');
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
