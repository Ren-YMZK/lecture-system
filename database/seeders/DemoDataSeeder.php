<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Assignment;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 教授
        $professor = User::create([
            'name' => '教授',
            'email' => 'p@example.com',
            'password' => Hash::make('password123'),
            'role' => 'professor',
        ]);

        // 学生
        $student = User::create([
            'name' => '学生',
            'email' => 's@example.com',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]);

        // 講義
        $course = Course::create([
            'title' => 'プログラミング演習',
            'description' => 'PHPとLaravelの基礎演習',
            'created_by' => $professor->id,
        ]);

        // 学生を講義に登録
        $course->users()->attach($student->id);

        // 課題
        Assignment::create([
            'course_id' => $course->id,
            'title' => '第1回課題',
            'description' => 'コントローラーを作ってみよう',
            'deadline' => now()->addDays(3),
            'max_score' => 100,
        ]);
    }
}
