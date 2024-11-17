<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER log_update_arsip AFTER UPDATE ON `arsip_surats` FOR EACH ROW
            BEGIN 
                DECLARE m_desc TEXT;
                SET m_desc := CONCAT("Telah memperbarui data arsip surat dengan perihal ",NEW.perihal);

                INSERT INTO log_surats (activity, jenis_log, `desc`, user_id, created_at)
                VALUES ("Update", "Arsip surat", m_desc, NEW.updated_by, CURRENT_TIMESTAMP());
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DB::unprepared('DROP TRIGGER `log_update_arsip`');
        Schema::dropIfExists('log_update_arsip');

    }
};
