<?php

use App\Models\City;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(City::class, 'from_city_id')->index();
            $table->foreignIdFor(City::class, 'to_city_id')->index();
            $table->dateTime('datetime_from')->index();
            $table->dateTime('datetime_to')->index();
            $table->integer('weight')->index();
            $table->integer('price')->default(0);
            $table->string('order_number');
            $table->foreignIdFor(User::class);
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
