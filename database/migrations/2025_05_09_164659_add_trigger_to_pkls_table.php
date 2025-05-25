<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Trigger setelah insert ke tabel pkls
        DB::unprepared('
            CREATE TRIGGER after_pkl_insert
            AFTER INSERT ON pkls
            FOR EACH ROW
            BEGIN
                UPDATE siswas
                SET status_pkl = TRUE
                WHERE id = NEW.siswa_id;
            END;
        ');

        // Trigger setelah delete dari tabel pkls
        DB::unprepared('
            CREATE TRIGGER after_pkl_delete
            AFTER DELETE ON pkls
            FOR EACH ROW
            BEGIN
                UPDATE siswas
                SET status_pkl = FALSE
                WHERE id = OLD.siswa_id;
            END;
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_pkl_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS after_pkl_delete');
    }
};