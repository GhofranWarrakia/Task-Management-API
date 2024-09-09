<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class TaskManagementSeeder extends Seeder
{
    public function run()
    {
        // إضافة مستخدمين
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'Admin'
        ]);

        User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'Manager'
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'User'
        ]);

        // إضافة مهام
        Task::create([
            'title' => 'Task 1',
            'description' => 'Description for task 1',
            'priority' => 'High',
            'status' => 'Pending',
            'due_date' => now()->addDays(7),
            'assigned_to' => 1 // تعيين المهمة للمستخدم الأول (Admin)
        ]);

        Task::create([
            'title' => 'Task 2',
            'description' => 'Description for task 2',
            'priority' => 'Medium',
            'status' => 'In Progress',
            'due_date' => now()->addDays(14),
            'assigned_to' => 2 // تعيين المهمة للمستخدم الثاني (Manager)
        ]);

        Task::create([
            'title' => 'Task 3',
            'description' => 'Description for task 3',
            'priority' => 'Low',
            'status' => 'Completed',
            'due_date' => now()->subDays(2),
            'assigned_to' => 3 // تعيين المهمة للمستخدم الثالث (User)
        ]);
    }
}
