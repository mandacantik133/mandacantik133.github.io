<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('username', 50);
            $table->string('role', 20);
            $table->string('action', 100);
            $table->string('ip_address', 45);
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('audit_logs'); }
};