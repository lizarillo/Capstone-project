<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // In the generated migration file
public function up()
{
   Schema::table('users', function (Blueprint $table) {
    $table->string('status')->default('active')->after('role');
});

}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
