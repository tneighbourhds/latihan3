<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddTriggerToPklsTable extends Migration
{
    public function up(): void
    {
         // Trigger untuk insert PKL
            DB::unprepared('
            CREATE TRIGGER after_insert_siswa
            AFTER INSERT ON siswa
            FOR EACH ROW
            BEGIN
                IF NEW.pkl_id IS NOT NULL THEN
                    UPDATE siswa
                    SET status_pkl = TRUE
                    WHERE id = NEW.id;
                END IF;
            END;

        ');

        // // Trigger untuk update PKL
        // DB::unprepared('
        //     CREATE TRIGGER update_status_pkl_after_update
        //     AFTER UPDATE ON pkls
        //     FOR EACH ROW
        //     BEGIN
        //         DECLARE new_status BOOLEAN;
        //         SET new_status = (SELECT status_pkl FROM siswas WHERE id = NEW.siswa_id);
        //         IF new_status = 1 THEN
        //             UPDATE siswas SET status_pkl = 0 WHERE id = NEW.siswa_id;
        //         ELSE
        //             UPDATE siswas SET status_pkl = 1 WHERE id = NEW.siswa_id;
        //         END IF;
        //     END;
        // ');

        // // Trigger untuk delete PKL
        // DB::unprepared('
        //     CREATE TRIGGER update_status_pkl_after_delete
        //     AFTER DELETE ON pkls
        //     FOR EACH ROW
        //     BEGIN
        //         UPDATE siswas SET status_pkl = 0 WHERE id = OLD.siswa_id;
        //     END;
        // ');


           //Triger status siswa
    //        DB::unprepared('
    //        CREATE TRIGGER update_status_pkl_after_insert
    //        AFTER INSERT ON pkls
    //        FOR EACH ROW
    //        BEGIN
    //            UPDATE siswas
    //            SET status_pkl = true
    //            WHERE id = NEW.siswa_id;
    //        END;
    //    ');
       /// triger duplikat data

    }

    public function down(): void
    {
        // Menghapus trigger jika migrasi dibatalkan
        DB::unprepared('DROP TRIGGER IF EXISTS update_status_pkl_after_insert');
      
    }
}
