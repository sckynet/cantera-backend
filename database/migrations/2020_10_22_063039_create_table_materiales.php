<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMateriales extends Migration
{

    public function up()
    {
        Schema::create('materiales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',60);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('table_materiales');
    }
}
