<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddSoftDeletesToTables extends Migration
{
    /**
     * List of tables that should NOT have soft deletes.
     */
    protected array $excluded = [
        'migrations',
        'password_resets',
        'personal_access_tokens',
        // Adicione outras tabelas constantes aqui se necessário
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Busca todas as tabelas do banco
        $tables = array_map('current', DB::select('SHOW TABLES'));

        foreach ($tables as $table) {
            if (in_array($table, $this->excluded)) {
                continue;
            }
            // Adiciona o campo deleted_at se não existir
            if (!Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $tableObj) {
                    $tableObj->softDeletes();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = array_map('current', DB::select('SHOW TABLES'));

        foreach ($tables as $table) {
            if (in_array($table, $this->excluded)) {
                continue;
            }
            if (Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $tableObj) {
                    $tableObj->dropSoftDeletes();
                });
            }
        }
    }
}
