<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstitutionCodeToSubmissionsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('submissions', 'institution_code')) {
            Schema::table('submissions', function (Blueprint $table) {
                $table->string('institution_code')->nullable();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('submissions', 'institution_code')) {
            Schema::table('submissions', function (Blueprint $table) {
                $table->dropColumn('institution_code');
            });
        }
    }
}

