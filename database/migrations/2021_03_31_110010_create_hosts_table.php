<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->foreignId('location_id')->nullable()->constrained('locationmaster');
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->tinyInteger('priority')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->json('role');
            $table->string('slug')->nullable();
            $table->longText('google_id')->nullable();
            $table->longText('google_token')->nullable();
            $table->longText('google_refresh_token')->nullable();
            $table->longText('facebook_id')->nullable();
            $table->longText('facebook_token')->nullable();
            $table->longText('facebook_refresh_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('host_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fatherName')->nullable();
            $table->string('surname')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('relation')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile');
            $table->string('mobile1')->nullable();
            $table->string('whatsup')->nullable();
            $table->string('imageOne')->default('/defautlsv1/avatar.png');
            $table->string('slug')->nullable();
            $table->foreignId('host_id')->references('id')->on('hosts')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('host_homes', function (Blueprint $table) {
            $table->id();
            $table->string('complexName');
            $table->string('floor');
            $table->string('doorNo');
            $table->string('streetNo');
            $table->string('area');
            $table->string('district');
            $table->string('pin');
            $table->string('state');
            // $table->string('zone');
            // $table->string('country')->default('India');
            $table->longText('reachus')->nullable();
            $table->string('slug')->nullable();
            $table->foreignId('host_id')->references('id')->on('hosts')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('host_offices', function (Blueprint $table) {
            $table->id();
            $table->string('officecompanyName');
            $table->string('officecomplexName');
            $table->string('officefloor');
            $table->string('officedoorNo');
            $table->string('officestreetNo');
            $table->string('officearea');
            $table->string('officedistrict');
            $table->string('officepin');
            $table->string('officestate');
            // $table->string('officezone');
            // $table->string('officecountry')->default('India');
            $table->longText('officereachus')->nullable();
            $table->string('slug')->nullable();
            $table->foreignId('host_id')->references('id')->on('hosts')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('subscriptions_host', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('price');
            $table->string('color');
            $table->string('icon');
            $table->string('validity')->default(12);
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        Schema::create('sub_host_rec', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('plan_id');
            $table->string('price');
            $table->string('color');
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        Schema::create('subscriptions_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->integer('payment_done')->default(0);
            $table->text('payment_ids')->nullable();
            $table->morphs('ownerable');
            $table->morphs('subscribeable');
            $table->timestamps();
            $table->timestamp('expiry_at')->nullable();
        });

        Schema::create('sub_orders_rec', function (Blueprint $table) {
            $table->id();
            $table->string('plan_id');
            $table->string('status')->nullable();
            $table->string('sub_id')->nullable();
            $table->json('razorpay_success')->nullable();
            $table->json('razorpay_error')->nullable();
            $table->json('webhook_error')->nullable();
            $table->morphs('ownerable');
            $table->timestamps();
        });

        // Schema::create('sub_orders_rec', function (Blueprint $table) {
        //     $table->string('id');
        //     $table->string('entity')->nullable();
        //     $table->string('plan_id')->nullable();
        //     $table->string('customer_id')->nullable();
        //     $table->string('status')->nullable();
        //     $table->integer('current_start')->nullable();
        //     $table->integer('current_end')->nullable();
        //     $table->integer('ended_at')->nullable();
        //     $table->integer('quantity')->nullable();
        //     $table->integer('charge_at')->nullable();
        //     $table->integer('start_at')->nullable();
        //     $table->integer('end_at')->nullable();
        //     $table->json('notes')->nullable();
        //     $table->integer('auth_attempts')->nullable();
        //     $table->integer('total_count')->nullable();
        //     $table->integer('paid_count')->nullable();
        //     $table->boolean('customer_notify')->nullable();
        //     $table->integer('created_at')->nullable();
        //     $table->integer('expire_by')->nullable()->nullable();
        //     $table->string('short_url')->nullable();
        //     $table->boolean('has_scheduled_changes')->nullable();
        //     $table->integer('change_scheduled_at')->nullable();
        //     $table->string('source')->nullable();
        //     $table->string('payment_method')->nullable();
        //     $table->integer('offer_id')->nullable();
        //     $table->integer('remaining_count')->nullable();
        //     $table->morphs('ownerable');
        //     //$table->timestampsTz('local');
        // });

        Schema::create('subscriptions_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('subscriptions_orders')->onUpdate('cascade')->onDelete('cascade');
            $table->string('status_code')->nullable();
            $table->string('razorpay_order_id');
            $table->string('razorpay_payment_id');
            $table->string('razorpay_signature')->nullable();
            $table->json('error')->nullable();
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
        Schema::dropIfExists('hosts');
        Schema::dropIfExists('host_profiles');
        Schema::dropIfExists('host_homes');
        Schema::dropIfExists('host_offices');
        Schema::dropIfExists('subscriptions_host');
        Schema::dropIfExists('subscriptions_orders');
        Schema::dropIfExists('subscription_payments');
    }
}
