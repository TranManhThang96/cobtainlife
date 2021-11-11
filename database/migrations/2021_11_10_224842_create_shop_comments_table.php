<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_website')->nullable();
            $table->text('comment');
            $table->integer('comment_parent')->default(0)->comment('0 la comment goc');
            $table->tinyInteger('type')->default(1)->comment('1 san pham, 2 bai viet');
            $table->integer('object_id')->comment('id của san pham, hoac bai viet');
            $table->tinyInteger('rating')->default(0)->comment('rating tu 1 den 5');
            $table->tinyInteger('status')->default(1)->comment('hien thi');
            $table->string('user_agent')->nullable();
            $table->string('device_type')->nullable()->comment('thiết bị truy cập');
            $table->string('ip_address')->nullable()->comment('địa chỉ ip');
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('shop_comments');
    }
}
