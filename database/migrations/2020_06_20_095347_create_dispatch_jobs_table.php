<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_address');
            $table->string('city');
            $table->string('estate');
            $table->string('zip_code');
            $table->string('policy_no');
            $table->string('item_type');
            $table->string('item_location');
            $table->string('issue_details');
            $table->string('model_no');
            $table->string('serial_no');
            $table->string('prior_issue');
            $table->string('long');
            $table->string('lat');
            $table->integer('id_technician');
            $table->integer('id_customer');
            $table->string('title');
            $table->string('description');
            $table->string('service_type');
            $table->string('status');
            $table->string('customer_availability_one')->nullable();
            $table->string('customer_availability_two')->nullable();
            $table->string('customer_availability_three')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE dispatch_jobs AUTO_INCREMENT = 1000000000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
