<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Minasyans\FilamentMenu\FilamentMenuBuilder;

return new class extends Migration
{
    public function up()
    {
        Schema::create(FilamentMenuBuilder::getMenusTableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create(FilamentMenuBuilder::getMenuItemsTableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->string('name');
            $table->string('locale');
            $table->string('class')->nullable();
            $table->string('value')->nullable();
            $table->string('target')->default('_self');
            $table->json('data')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('order');
            $table->boolean('enabled')->default(1);
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on(FilamentMenuBuilder::getMenusTableName())->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists(FilamentMenuBuilder::getMenuItemsTableName());
        Schema::dropIfExists(FilamentMenuBuilder::getMenusTableName());
    }
};
