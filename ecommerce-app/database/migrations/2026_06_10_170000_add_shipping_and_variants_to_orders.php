<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('shipping_cost', 10, 2)->default(0)->after('total');
        });

        Schema::table('order_products', function (Blueprint $table) {
            $table->string('size')->nullable()->after('amount');
            $table->string('color')->nullable()->after('size');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('shipping_cost');
        });

        Schema::table('order_products', function (Blueprint $table) {
            $table->dropColumn(['size', 'color']);
        });
    }
};
