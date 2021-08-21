<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\Maths;

class CreateMathsTable extends Migration
{
    public function up()
    {
        Schema::create(Maths::TN, function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('type')->nullable();
            $table->text('subType')->nullable();
            $table->text('correct')->nullable();
            $table->text('wrong')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists(Maths::TN);
    }
}
