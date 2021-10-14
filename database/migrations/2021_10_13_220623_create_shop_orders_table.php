<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('subtotal')->default(0)->comment('tiền hàng');
            $table->integer('shipping')->default(0)->comment('vận chuyển cơ bản');
            $table->integer('discount')->default(0)->comment('giảm giá');
            $table->integer('tax')->default(0)->comment('tiền thuế');
            $table->integer('total')->default(0)->comment('tổng tiền');
            $table->integer('received')->default(0)->comment('tiền đã nhận được');
            $table->integer('balance')->default(0)->comment('tiền phải trả: total-received');
            $table->integer('payment_status')->default(1)->comment('Trạng thái thanh toán');
            $table->integer('shipping_status')->default(1)->comment('Trạng thái vận chuyển');
            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->text('address')->nullable();
            $table->string('country')->nullable()->default('VN');
            $table->string('email');
            $table->string('phone');
            $table->string('comment')->nullable();
            $table->string('payment_method')->nullable()->comment('phương thức thanh toán: tiền mặt');
            $table->string('shipping_method')->nullable()->comment('phương thức vận chuyển: ShippingStandard');
            $table->string('user_agent')->nullable();
            $table->string('device_type')->nullable()->comment('thiết bị truy cập');
            $table->string('ip_address')->nullable()->comment('địa chỉ ip');
            $table->tinyInteger('status')->default(1)->comment('trạng thái đơn hàng: theo bảng order status');
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
        Schema::dropIfExists('shop_orders');
    }
}
