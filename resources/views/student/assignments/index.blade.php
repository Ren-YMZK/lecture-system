@extends('layouts.student')

@section('content')
    <h1>{{ $course->title }} の課題一覧</h1>

    @if($assignments->isEmpty())
        <p>まだ課題はありません。</p>
    @else
        <ul>
            @foreach($assignments as $assignment)
                <li>
                    <strong>{{ $assignment->title }}</strong><br>
                    締切: {{ $assignment->deadline }}<br>
                    <a href="{{ route('student.assignments.show', $assignment->id) }}">詳細・提出</a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
