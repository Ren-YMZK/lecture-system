@extends('layouts.student')

@section('content')
    <h1>課題編集</h1>

    <form action="{{ route('professor.assignments.update', $assignment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>タイトル:</label>
            <input type="text" name="title" value="{{ old('title', $assignment->title) }}" required>
        </div>

        <div>
            <label>説明:</label>
            <textarea name="description">{{ old('description', $assignment->description) }}</textarea>
        </div>

        <div>
            <label>締切:</label>
            <input type="datetime-local" name="deadline" value="{{ old('deadline', \Carbon\Carbon::parse($assignment->deadline)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div>
            <label>満点:</label>
            <input type="number" name="max_score" value="{{ old('max_score', $assignment->max_score) }}" required>
        </div>

        <button type="submit">更新する</button>
    </form>
@endsection
