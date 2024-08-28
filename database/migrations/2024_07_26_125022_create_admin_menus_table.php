<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name')->nullable();
            $table->string('menu_url')->nullable();
            $table->string('menu_type')->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->unsignedBigInteger('menu_rank')->nullable();
            $table->boolean('status')->comment('0=Inactive, 1=Active')->default(0);
            $table->softDeletesTz();
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
        Schema::dropIfExists('admin_menus');
    }
};
