<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('tipus', ['particular', 'empresa', 'admin'])->default('particular');
            // Dades personals
            $table->string('nom_complet')->nullable();
            $table->string('dni', 9)->nullable();
            $table->string('telefon', 9)->nullable();
            $table->string('direccio')->nullable();
            $table->string('poblacio')->nullable();
            $table->string('codi_postal', 5)->nullable();
            // Facturació empresa
            $table->string('cif', 9)->nullable();
            $table->string('rao_social')->nullable();
            $table->string('direccio_fact')->nullable();
            $table->string('poblacio_fact')->nullable();
            $table->string('codi_postal_fact', 5)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
