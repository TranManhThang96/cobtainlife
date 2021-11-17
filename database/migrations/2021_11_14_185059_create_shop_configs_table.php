<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_configs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index('shop_config_code_index');
            $table->string('key')->unique();
            $table->string('value')->nullable();
            $table->string('detail')->nullable();
            $table->integer('sort')->default(0);
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
        Schema::dropIfExists('shop_configs');
    }
}
