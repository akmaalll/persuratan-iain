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
            CREATE TRIGGER log_delete_surat_masuk AFTER DELETE ON `surat_masuks` FOR EACH ROW
            BEGIN 
                DECLARE m_desc TEXT;
                SET m_desc := CONCAT("Telah menghapus data surat masuk dengan perihal ",OLD.perihal);

                INSERT INTO log_surats (activity, jenis_log, `desc`, user_id, created_at)
                VALUES ("Delete", "Surat masuk", m_desc, OLD.updated_by, CURRENT_TIMESTAMP());
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DB::unprepared('DROP TRIGGER `log_delete_surat_masuk`');
        Schema::dropIfExists('log_delete_surat_masuk');

    }
};
