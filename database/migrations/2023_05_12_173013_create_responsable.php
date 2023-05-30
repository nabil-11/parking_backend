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
        Schema::create('responsables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('abonnement_id') ;
            $table->timestamps();
        });
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1) ;
            $table->timestamps();
        });
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_abonnement_id') ;
            $table->timestamp('date_expire');
            $table->timestamps();
        });
        Schema::create('type_abonnements', function (Blueprint $table) {
            $table->id();
            $table->double('price') ;
            $table->timestamps();
        });
        Schema::create('employeurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parking_id') ;
            $table->timestamps();
        });
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->string('name') ;
            $table->string('langitude')->nullable() ;
            $table->string('lantitude')->nullable() ;
            $table->unsignedBigInteger('responsable_id') ;
            $table->text('description') ;
            $table->timestamps();
        });
        Schema::create('blocs', function (Blueprint $table) {
            $table->id();
            $table->integer('type') ;
            $table->double('hour_price') ;
            $table->unsignedBigInteger('parking_id') ;
            $table->timestamps();
        });
        Schema::create('parking_places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bloc_id') ;
            $table->integer('status')->default(0) ;
            $table->timestamps();
        });
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->string('media');
            $table->integer('type');
            $table->unsignedBigInteger('parking_id') ;
            $table->timestamps();
        });
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('code_reservation');
            $table->integer('score');
            $table->unsignedBigInteger('client_id') ;
            $table->unsignedBigInteger('place_parking_id') ;
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responsables');
        Schema::dropIfExists('employeurs');
        Schema::dropIfExists('parkings');
        Schema::dropIfExists('blocs');
        Schema::dropIfExists('parking_places');
        Schema::dropIfExists('medias');
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('clients');



    }
};
