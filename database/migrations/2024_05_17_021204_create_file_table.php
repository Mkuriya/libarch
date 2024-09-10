<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->year('year');
            $table->text('members');
            $table->longtext('abstract');
            $table->longtext('description');
            $table->string('document', 300);
            $table->string('student_lastname');
            $table->string('student_firstname');
            $table->string('student_department');
            $table->string('citation');
            $table->integer('status');
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
        Schema::dropIfExists('file');
    }
};
