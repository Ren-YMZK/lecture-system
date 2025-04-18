@extends('layouts.student')

@section('content')
    <h1 class="text-2xl font-bold mb-4">講義一覧（学生）</h1>

    @if($courses->isEmpty())
        <p>履修中の講義はありません。</p>
    @else
        <ul class="space-y-4">
            @foreach($courses as $course)
                <li class="border rounded p-4 bg-white shadow">
                    <strong class="text-lg">{{ $course->title }}</strong><br>
                    {{ $course->description }}

                    <div class="mt-2">
                        <a href="{{ route('student.courses.show', $course->id) }}"
                           class="text-blue-600 underline">
                            詳細を見る
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
