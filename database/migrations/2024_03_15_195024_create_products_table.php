<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('address');
            $table->enum('gender', ['Female', 'Male', 'Other']);
            $table->string('course_name'); 
            $table->string('district');
            $table->date('dob');
            $table->string('email')->unique();
            $table->string('results')->nullable(); // Nullable file path for results
            $table->enum('status', ['Pending', 'Admitted', 'Rejected'])->default('Pending'); // Updated statuses
            $table->unsignedBigInteger('institution_id')->nullable(); // Make this nullable
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->timestamps(); // Created at & Updated at timestamps
            
            // Additional relationships or indexes can be added here if needed
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['institution_id']);
        });
        Schema::dropIfExists('products');
    }
}
