@extends('layouts.student')

@section('content')
    <h1>講義を編集</h1>

    <form action="{{ route('professor.courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>タイトル:</label>
            <input type="text" name="title" value="{{ old('title', $course->title) }}" required>
        </div>
        <div>
            <label>説明:</label>
            <textarea name="description">{{ old('description', $course->description) }}</textarea>
        </div>
        <button type="submit">更新する</button>
    </form>
@endsection
