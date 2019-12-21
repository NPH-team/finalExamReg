<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQlsvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** Students */
        Schema::create('students', function (Blueprint $table) {
            $table->string('msv', 15);
            $table->string('ten', 50);
            $table->string('ngaysinh', 15);
            $table->string('lop', 30);
            $table->string('gioitinh', 15);
            $table->string('quequan',30);
            $table->string('username', 15);
            $table->string('password');
            $table->primary(['msv', 'username']);
        });

        /** Admins */
        Schema::create('admins', function (Blueprint $table) {
            $table->string('username', 15) -> primary();
            $table->string('password');
        });
        //default admin account
        DB::table('admins')->insert([
            [
                'username' => 'admin',
                'password' => 'admin'
            ],
        ]);

        /** Semester */
        Schema::create('semesters', function (Blueprint $table) {
            $table->string('maky', 25)->primary();
            $table->string('active');
        });

        /** Subjects */
        Schema::create('subjects', function (Blueprint $table) {
            $table->string('mahp', 15) -> primary();
            $table->string('tenhp', 50);
            $table->string('TC');
        });
        
        /** Exams */
        Schema::create('exams', function (Blueprint $table) {
            $table->string('maky', 25);
            $table->string('maca',20);
            $table->string('mahp', 15);
            $table->string('tenhp', 50);
            $table->string('TC');
            $table->string('SL');
            $table->string('ca');
            $table->string('date');
            $table->string('timestart');
            $table->string('timeend');
            $table->string('diadiem');
            $table->primary(['maky', 'maca']);
        });

        Schema::table('exams', function (Blueprint $table) {
            $table->foreign('mahp')->references('mahp')->on('subjects');
            $table->foreign('maky')->references('maky')->on('semesters')->onDelete('cascade');
        });

        /** Tested - List subjects which student can test*/
        Schema::create('tested', function (Blueprint $table) {
            $table->string('maky', 25);
            $table->string('msv', 15);
            $table->string('mahp', 20);
            $table->unique(['maky','msv', 'mahp']);
        });

        Schema::table('tested', function (Blueprint $table) {
            $table->foreign('maky')->references('maky')->on('semesters');
            $table->foreign('msv')->references('msv')->on('students');
            $table->foreign('mahp')->references('mahp')->on('subjects');
        });
        
        /** NoTested - List subjects which student can not test*/
        Schema::create('notested', function (Blueprint $table) {
            $table->string('maky', 25);
            $table->string('msv', 15);
            $table->string('mahp', 20);
            $table->unique(['maky','msv', 'mahp']);
        });

        Schema::table('notested', function (Blueprint $table) {
            $table->foreign('maky')->references('maky')->on('semesters');
            $table->foreign('msv')->references('msv')->on('students');
            $table->foreign('mahp')->references('mahp')->on('subjects');
        });

       
        
        /** Student's exam selection List */
        Schema::create('exam_selection', function (Blueprint $table) {
            $table->string('maky', 25);
            $table->string('msv', 15);
            $table->string('maca', 20);
            $table->unique(['maky','msv', 'maca']);
        });
    
        Schema::table('exam_selection', function (Blueprint $table) {
            //$table->foreign('maky')->references('maky')->on('exams')->onDelete('cascade');
            $table->foreign('msv')->references('msv')->on('students');
            $table->foreign(['maky','maca'])->references(['maky','maca'])->on('exams');
        });


        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_selection');
        Schema::dropIfExists('tested');
        Schema::dropIfExists('notested');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('students');
    }
}
