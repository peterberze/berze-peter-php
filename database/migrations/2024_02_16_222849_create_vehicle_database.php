<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Jarmuvek', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('rendszam');
            $table->string('tulajdonos');
            $table->dateTime('forgalmi_ervenyes');
            $table->json('adatok');

            $table->timestamp('createdAt')->useCurrent();
            $table->timestamp('updatedAt')->nullable();

            $table->index('rendszam');
            $table->index('tulajdonos');
            $table->index('forgalmi_ervenyes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Jarmuvek');
    }
};
