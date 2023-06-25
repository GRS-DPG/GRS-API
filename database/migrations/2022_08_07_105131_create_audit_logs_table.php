<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('model_name')->nullable();
            $table->bigInteger('table_row_id')->nullable();
            $table->longText('old_data')->nullable();
            $table->longText('new_data')->nullable();
            $table->integer('responsible_user_id')->nullable();
            $table->integer('action_type')->comment('create=1,edit=2,approve=3,reject=4,delete=5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
};
