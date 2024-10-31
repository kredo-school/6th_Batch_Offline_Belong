<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();  // Post ID
            $table->string('title', 255);  // Title of the post
            $table->timestamp('date')->nullable()->comment('Event date');  // Event date
            $table->timestamp('reservation_due_date')->nullable()->comment('Reservation due date');  // Reservation due date
            $table->string('place', 255);  // Location of the event
            $table->integer('planned_number_of_people')->nullable()->comment('Planned number of attendees');  // Planned number of people
            $table->decimal('participation_fee', 8, 2)->nullable()->comment('Participation fee');  // Participation fee
            $table->text('description')->nullable()->comment('Description of the event');  // Description
            $table->longText('image')->nullable()->comment('Event image URL');  // Image related to the post
            $table->unsignedBigInteger("user_id");  // Foreign key referencing users table
            $table->string('status', 50)->default('draft')->comment('Post status: draft, published');  // Status of the post
            $table->timestamps();  // Post creation date and last updated date
            // $table->softDeletes()->comment('Soft delete flag');  // Soft delete flag


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }

}
