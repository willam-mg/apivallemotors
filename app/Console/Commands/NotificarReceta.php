<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NotificarReceta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'receta:notificar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifica un recordatorio del tratamiento medico por push notification';

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
    public function handle()
    {
        //
    }
}
