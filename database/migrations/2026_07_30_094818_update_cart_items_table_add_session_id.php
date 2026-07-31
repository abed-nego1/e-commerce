<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropUnique(['user_id', 'product_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->string('session_id')->nullable()->after('user_id');
            $table->foreignId('produit_id')->after('session_id')->constrained('produits')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['produit_id']);
            $table->dropColumn(['session_id', 'produit_id', 'user_id']);
        });
    }
};
