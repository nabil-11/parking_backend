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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('responsable_id')->references('id')->on('responsables')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('employeur_id')->references('id')->on('clients')->onDelete('cascade');
        });
        Schema::table('responsables', function (Blueprint $table) {
            $table->foreign('abonnement_id')->references('id')->on('abonnements')->onDelete('cascade');

        });
        Schema::table('abonnements', function (Blueprint $table) {
            $table->foreign('type_abonnement_id')->references('id')->on('type_abonnements')->onDelete('cascade');

        });
        
        Schema::table('employeurs', function (Blueprint $table) {
            $table->foreign('parking_id')->references('id')->on('parkings')->onDelete('cascade');

        });
        Schema::table('blocs', function (Blueprint $table) {
            $table->foreign('parking_id')->references('id')->on('parkings')->onDelete('cascade');

        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('place_parking_id')->references('id')->on('parking_places')->onDelete('cascade');

        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
