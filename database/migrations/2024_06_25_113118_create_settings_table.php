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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->text('short_description_ar')->nullable();
            $table->text('short_description_en')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('google')->nullable();
            $table->string('logo')->nullable();
            $table->text('slogan_ar')->nullable();
            $table->text('slogan_en')->nullable();
            $table->string('tax')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->boolean('use_shiping')->default(1);
            $table->integer('free_distance')->nullable()->comment('Distance within which shipping is free (in km)');
            $table->decimal('cost_per_km', 8, 2)->nullable()->comment('Cost of shipping per km after the free distance');
            $table->integer('non_operational_distance')->nullable()->comment('Distance beyond which the service does not operate (in km)');
            $table->integer('expected_order_delivered')->nullable()->comment('Expected the deliverd in -- days');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
