<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // clear table data
        DB::table('job_listings')->truncate();
        Schema::table('job_listings', function (Blueprint $table) {
            // we can use $table variable to add fields
            
            // user_id field
            $table->unsignedBigInteger('user_id')->after('id');
            
            /**
             * we will not gonna add usersID just yet because that will gonna be 
             * having a relationship with users table we will see next
             */
            // salary field, we can use string or decimal but here we use integer
            $table->integer('salary');
            // tags
            $table->string('tags')->nullable();
            // job type, we will make it enum which it will be string but we will 
            // provide few values and it has to be only those values
            $table->enum('job_type', ['Full-Time', 'Part-Time', 'Contract', 
            'Temporary', 'Internship', 'Volunteer', 'on-Call'])->default('Full-Time');
            // remote or not
            $table->boolean('remote')->default(false);
            //  rerquiremtn
            $table->string('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->string('address')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zipcode')->nullable();
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_website')->nullable();
            // again we don't add userID just yet

            // Add user foriegn key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            //
            // we will add
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropColumn([
                'salary',
                'tags',
                'job_type',
                'remote',
                'requirements',
                'benefits',
                'address',
                'city',
                'state',
                'zipcode',
                'contact_email',
                'contact_phone',
                'company_name',
                'company_description',
                'company_logo',
                'company_website'
            ]);
        });
    }
};
