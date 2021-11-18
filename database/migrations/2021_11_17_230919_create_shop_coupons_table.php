<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->nullable()->comment('Tên mã giảm giá');
            $table->integer('value')->default(0)->comment('tính theo đơn hàng%');
            $table->integer('max_discount')->default(0)->comment('giảm giá tối đa bao nhiêu tiền');
            $table->integer('max_applied')->default(0)->comment('số lượt áp dụng tối đa');
            $table->integer('applied')->default(0)->comment('đã áp dụng');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1: on, 0: off');
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
        Schema::dropIfExists('shop_coupons');
    }
}
