<?php

use App\Models\Affiliate;
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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Affiliate::class);
            $table->integer('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
