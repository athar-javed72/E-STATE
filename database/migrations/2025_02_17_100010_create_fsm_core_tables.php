<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('customer_name')->nullable();
            $table->string('code')->nullable()->unique();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('timezone')->nullable();
            $table->string('status')->default('active'); // active, inactive, archived
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('code')->nullable()->unique();
            $table->text('description')->nullable();
            $table->string('status')->default('draft'); // draft, active, on_hold, completed, archived
            $table->string('priority')->default('medium'); // low, medium, high, critical
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('manager_id')->nullable()->constrained('users')->nullOnDelete();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('project_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('role')->nullable(); // manager, field_worker, observer
            $table->timestamps();

            $table->unique(['project_id', 'user_id']);
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('site_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('backlog'); // backlog, scheduled, in_progress, on_site, completed, failed
            $table->string('priority')->default('medium'); // low, medium, high, critical
            $table->foreignId('assignee_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('reporter_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('scheduled_start_at')->nullable();
            $table->dateTime('scheduled_end_at')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->unsignedInteger('estimated_minutes')->nullable();
            $table->unsignedInteger('actual_minutes')->nullable();
            $table->foreignId('parent_task_id')->nullable()->constrained('tasks')->nullOnDelete();
            $table->json('tags')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('task_dependencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnDelete();
            $table->foreignId('depends_on_task_id')->constrained('tasks')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['task_id', 'depends_on_task_id']);
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('site_id')->nullable()->constrained()->nullOnDelete();
            $table->string('number')->unique();
            $table->string('subject');
            $table->text('description')->nullable();
            $table->string('status')->default('open'); // open, in_progress, on_hold, resolved, closed
            $table->string('priority')->default('medium'); // low, medium, high, critical
            $table->string('type')->default('issue'); // issue, request, incident, change
            $table->foreignId('requester_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('assignee_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('sla_due_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->string('channel')->nullable(); // email, phone, portal, api
            $table->boolean('is_customer_visible')->default(true);
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->nullable()->constrained('tasks')->nullOnDelete();
            $table->foreignId('site_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('technician_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->string('status')->default('scheduled'); // scheduled, in_progress, completed, cancelled
            $table->string('title')->nullable();
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->morphs('subject'); // subject_type, subject_id
            $table->string('event'); // created, updated, status_changed, etc.
            $table->string('description')->nullable();
            $table->json('properties')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('task_dependencies');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('project_user');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('sites');
    }
};

