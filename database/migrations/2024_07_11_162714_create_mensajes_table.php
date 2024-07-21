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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger("Estatus");
            $table->timestamp("FecEnvio");
            $table->integer("temporizador");
            $table->string("Mensaje");

            $table->unsignedBigInteger('personal_id')->nullable();
            $table->foreign("personal_id")->references("id")->on("personals")
            ->onDelete("cascade")
            ->onUpdate("cascade");

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
