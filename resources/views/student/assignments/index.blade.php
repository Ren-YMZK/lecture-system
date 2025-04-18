@extends('layouts.student')

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $course->title }} の課題一覧</h1>

    @if($assignments->isEmpty())
        <p>まだ課題はありません。</p>
    @else
        <ul class="space-y-4">
            @foreach($assignments as $assignment)
                <li class="border rounded p-4 bg-white shadow">
                    <strong class="text-lg">{{ $assignment->title }}</strong><br>
                    締切: {{ $assignment->deadline }}<br>
                    <a href="{{ route('student.assignments.show', $assignment->id) }}"
                       class="text-blue-600 underline">
                        詳細・提出
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
