<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDownloadImageToStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statuses', function(Blueprint $table) {
            $table->string('image');
        });
    }
    
    public function down()
    {
        Schema::table('statuses', function(Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
