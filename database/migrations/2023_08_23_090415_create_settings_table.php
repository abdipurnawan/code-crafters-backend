<?php

use App\Models\Setting;
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
            $table->string('key')->unique();
            $table->string('label')->nullable();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Setting::create([
            'key' => 'site_name',
            'label' => 'Site Name',
            'value' => 'CodeCrafters'
        ]);

        Setting::create([
            'key' => 'site_email',
            'label' => 'Site Email',
            'value' => 'sales@codecrafters.id'
        ]);

        Setting::create([
            'key' => 'site_description',
            'label' => 'Site Description',
            'value' => 'CodeCrafters adalah Software House, lahir untuk mengubah ide menjadi aplikasi berkualitas, dan memanfaatkan kode untuk perubahan positif. Bersama-sama, mari ciptakan masa depan yang lebih baik melalui seni kode.'
        ]);

        Setting::create([
            'key' => 'ga_tracking_id',
            'label' => 'GA Tracking ID',
            'value' => 'UA-XXXXX-Y'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
