<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module', function (Blueprint $table) {
            $table->increments('id_module');
            $table->string('name', 50);
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('order')->default(1);
            $table->enum('is_scanable', [0,1])->default(0);
            $table->string('scope')->default(json_encode(array()));
            $table->softDeletes();
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
        Schema::dropIfExists('module');
    }
}
