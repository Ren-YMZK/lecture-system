<!-- resources/views/professor/courses/create.blade.php -->
@extends('layouts.student')

@section('content')
    <h1>講義作成</h1>

    <form action="{{ route('professor.courses.store') }}" method="POST">
        @csrf
        <div>
            <label>タイトル:</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label>説明:</label>
            <textarea name="description"></textarea>
        </div>
        <button type="submit">作成</button>
    </form>
@endsection
