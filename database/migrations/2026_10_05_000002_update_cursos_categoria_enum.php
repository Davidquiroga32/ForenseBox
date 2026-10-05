<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite no impone enum (es varchar), por lo que solo se ajusta en MySQL.
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE cursos MODIFY COLUMN categoria ENUM('forensia_digital','ciberseguridad','seguridad_ofensiva','analisis_malware','respuesta_incidentes','osint','legal','otro') NOT NULL DEFAULT 'otro'");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE cursos MODIFY COLUMN categoria ENUM('gestion','normatividad','liderazgo','proyectos','participacion','contabilidad','otro') NOT NULL DEFAULT 'otro'");
        }
    }
};
