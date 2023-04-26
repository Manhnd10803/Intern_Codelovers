<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('id', 'idProduct');
            $table->renameColumn('name', 'productName');
            $table->renameColumn('color', 'productColor');
            $table->renameColumn('storage', 'productStorage');
            $table->renameColumn('image', 'productImage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('idProduct', 'id');
            $table->renameColumn('productName', 'name');
            $table->renameColumn('productColor', 'color');
            $table->renameColumn('productStorage', 'storage');
            $table->renameColumn('productImage', 'image');
        });
    }
};
