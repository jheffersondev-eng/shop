<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SyncTestDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:test-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza o banco de teste com as migrations reais';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $env = app()->environment();
        if ($env !== 'testing') {
            $this->error('Este comando só pode ser executado no ambiente de testing. Use --env=testing');
            return 1;
        }

        $this->info('Limpando o banco de teste...');
        Artisan::call('migrate:fresh', ['--env' => 'testing']);
        $this->info(Artisan::output());

        $this->info('Banco de teste sincronizado com as migrations reais.');
        return 0;
    }
}
