<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seccions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('productes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('descripcio');
            $table->decimal('preu', 8, 2);
            $table->string('imatge')->nullable();
            $table->boolean('destacat')->default(false);
            $table->foreignId('seccio_id')->constrained('seccions')->onDelete('cascade');
            $table->integer('stock')->default(100);
            $table->timestamps();
        });

        Schema::create('ofertes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('missatge');
            $table->string('imatge')->nullable();
            $table->boolean('activa')->default(true);
            $table->timestamps();
        });

        Schema::create('comandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('total', 10, 2);
            $table->string('nom_complet');
            $table->string('dni', 9);
            $table->string('telefon', 9);
            $table->string('direccio');
            $table->string('poblacio');
            $table->string('codi_postal', 5);
            $table->json('productes'); // snapshot dels productes comprats
            $table->enum('estat', ['pendent', 'enviada', 'entregada'])->default('pendent');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comandes');
        Schema::dropIfExists('ofertes');
        Schema::dropIfExists('productes');
        Schema::dropIfExists('seccions');
    }
};
