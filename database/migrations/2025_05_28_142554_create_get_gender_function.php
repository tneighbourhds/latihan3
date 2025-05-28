<?php


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration {
    public function up(): void
    {
        DB::unprepared("
            CREATE FUNCTION getGenderCode(code CHAR(1))
            RETURNS VARCHAR(20)
            DETERMINISTIC
            BEGIN
                RETURN CASE
                    WHEN code = 'L' THEN 'Laki-laki'
                    WHEN code = 'P' THEN 'Perempuan'
                    ELSE 'Tidak diketahui'
                END;
            END
        ");
    }
 public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS getGenderCode');
    }
};
