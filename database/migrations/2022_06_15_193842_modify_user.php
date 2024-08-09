<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'active_currency')) {
                $table->string('active_currency', 100)->after('password')->default('USD');
            }
            if (!Schema::hasColumn('users', 'balance_usd')) {
                $table->string('balance_usd', 100)->after('password')->default('0');
            }
            if (!Schema::hasColumn('users', 'balance_eur')) {
                $table->string('balance_eur', 100)->after('password')->default('0');
            }
            if (!Schema::hasColumn('users', 'balance_cad')) {
                $table->string('balance_cad', 100)->after('password')->default('0');
            }
            if (!Schema::hasColumn('users', 'games_played')) {
                $table->string('games_played', 100)->after('password')->default('0');
            }
            if (!Schema::hasColumn('users', 'player_id')) {
                $table->string('player_id', 100)->after('id');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['active_currency', 'balance_usd', 'balance_eur', 'balance_cad', 'games_played', 'player_id']);
        });
    }
};
