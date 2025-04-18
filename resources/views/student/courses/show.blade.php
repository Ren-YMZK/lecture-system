@extends('layouts.student')

@section('content')
    <h1 class="text-2xl font-bold mb-2">{{ $course->title }}</h1>
    <p class="mb-4">{{ $course->description }}</p>

    <a href="{{ route('student.assignments.index', ['course' => $course->id]) }}"
       class="text-blue-600 underline">
        課題一覧を見る
    </a>
@endsection
