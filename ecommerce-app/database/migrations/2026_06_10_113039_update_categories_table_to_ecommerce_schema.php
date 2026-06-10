<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('name', 'title');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('keywords')->nullable()->after('slug');
            $table->text('description')->nullable()->after('keywords');
            $table->string('image')->nullable()->after('description');
            $table->string('status')->default('active')->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['keywords', 'description', 'image', 'status']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('title', 'name');
        });
    }
};
