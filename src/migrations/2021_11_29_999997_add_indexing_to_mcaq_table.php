<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexingToMcaqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('fmt_mcaq_ans')) {
            Schema::table('fmt_mcaq_ans', function (Blueprint $table) {
                $table->index('question_id');
                $table->index('active');
                $table->index('media_id');
                $table->index('arrange');
            });
        }
        if (Schema::hasTable('fmt_mcaq_ques')) {
            Schema::table('fmt_mcaq_ques', function (Blueprint $table) {
                $table->index('active');
                $table->index('media_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('fmt_mcaq_ans');
    }
}
