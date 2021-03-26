<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('serial', 50)->unique();
            $table->text('brand')->nullable();
            $table->text('model')->nullable();
            $table->text('number')->nullable();
            $table->text('imei')->nullable();
            $table->text('size')->nullable();
            $table->text('ram')->nullable();
            $table->text('version')->nullable();
            $table->boolean('root')->default(false);
            $table->boolean('status')->default(true);
            $table->string('ip')->nullable();
            $table->string('group_id', 100)->default("0");
            $table->integer('no')->unique();
            $table->text('name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
