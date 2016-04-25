<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendEquipment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->integer('prototype')->default(\App\Models\Equipment::PROTOTYPE_YES);
            $table->integer('condition')->default(\App\Models\Equipment::CONDITIONAL_NEW);
            $table->integer('numbers')->default(\App\Models\Equipment::NUMBERS_NO);
            $table->integer('heats_shrink')->default(\App\Models\Equipment::HEATS_SHRINK_NO);
            $table->integer('ship')->default(\App\Models\Equipment::SHIP_NO);
            $table->integer('verified_by')->nullable()->unsigned();
            $table->foreign('verified_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->dropColumn('prototype');
            $table->dropColumn('condition');
            $table->dropColumn('numbers');
            $table->dropColumn('heats_shrink');
            $table->dropColumn('ship');

            $table->dropForeign('verified_by');
            $table->dropColumn('verified_by');
        });
    }
}
