<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('order_code', 'nomor_surat');
            $table->string('nomor_plat', 50)->nullable()->after('nomor_surat');
            $table->string('tipe_motor', 50)->nullable()->after('customer_phone');
            $table->text('detail_motor')->nullable()->after('tipe_motor');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('nomor_surat', 'order_code');
            $table->dropColumn(['nomor_plat', 'tipe_motor', 'detail_motor']);
        });
    }
};
