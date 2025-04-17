@extends('layouts.student')

@section('content')
    <h1>{{ $course->title }}</h1>
    <p>{{ $course->description }}</p>

    <a href="{{ route('student.assignments.index', ['course' => $course->id]) }}">課題一覧を見る</a>
@endsection
