<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string("name");
            $table->text("description");
            $table->date("assigned_date");
            $table->enum("status",['realizada','pendiente','actualizada'])->default('pendiente');;
            $table->text("files_to_upload")->nullable();
            $table->text("comments")->nullable();
            $table->date("realization_date")->nullable();
            $table->bigInteger("realization_time")->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
