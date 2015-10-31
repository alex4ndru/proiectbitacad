<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname');
            $table->string('name');
            $table->string('surname');
            $table->integer('cnp');
            $table->timestamps();
        });
        
        //populate with citizens
        DB::table('citizens')->insert(
            [
                'nickname' => 'cit01',
                'name' => 'name 1',
                'surname' => 'surname 1',
                'cnp' => 1111111
            ]
        );
        DB::table('citizens')->insert(
            [
                'nickname' => 'cit02',
                'name' => 'name 2',
                'surname' => 'surname 2',
                'cnp' => 122222
            ]
        );
        DB::table('citizens')->insert(
            [
                'nickname' => 'cit03',
                'name' => 'name 3',
                'surname' => 'surname 3',
                'cnp' => 133333
            ]
        );
        DB::table('citizens')->insert(
            [
                'nickname' => 'cit04',
                'name' => 'name 4',
                'surname' => 'surname 4',
                'cnp' => 144444
            ]
        );
        DB::table('citizens')->insert(
            [
                'nickname' => 'cit05',
                'name' => 'name 5',
                'surname' => 'surname 5',
                'cnp' => 255555
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('citizens');
    }
}
