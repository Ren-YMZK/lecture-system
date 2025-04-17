@extends('layouts.student')

@section('content')
    <h1>{{ $course->title }} に課題を追加</h1>

    <form action="{{ route('professor.assignments.store') }}" method="POST">
        @csrf

        <input type="hidden" name="course_id" value="{{ $course->id }}">

        <div>
            <label>タイトル:</label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label>説明:</label>
            <textarea name="description"></textarea>
        </div>

        <div>
            <label>締切:</label>
            <input type="datetime-local" name="deadline" required>
        </div>

        <div>
            <label>満点:</label>
            <input type="number" name="max_score" value="100" required>
        </div>

        <button type="submit">課題を作成</button>
    </form>
@endsection
