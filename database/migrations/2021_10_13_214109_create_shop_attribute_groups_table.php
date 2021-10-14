<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopAttributeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('color, size, ....');
            $table->tinyInteger('status')->default(1)->comment('1: on, 0: off');
            $table->tinyInteger('sort')->default(1)->comment('thứ tự');
            $table->enum('type', ['radio', 'select', 'checkbox'])->comment('radio, select, checkbox');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('shop_attribute_groups');
    }
}
