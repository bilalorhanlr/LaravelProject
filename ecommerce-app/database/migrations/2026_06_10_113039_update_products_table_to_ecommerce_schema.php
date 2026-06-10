<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('name', 'title');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('keywords')->nullable()->after('slug');
            $table->text('detail')->nullable()->after('description');
            $table->unsignedInteger('quantity')->default(0)->after('price');
            $table->foreignId('user_id')->nullable()->after('category_id')->constrained()->nullOnDelete();
            $table->string('status')->default('active')->after('brand');
        });

        DB::table('products')->update([
            'quantity' => DB::raw('stock'),
        ]);
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['keywords', 'detail', 'quantity', 'user_id', 'status']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('title', 'name');
        });
    }
};
