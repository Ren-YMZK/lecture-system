@extends('layouts.professor')

@section('content')
    <h1 class="text-2xl font-bold mb-4">講義を編集</h1>

    <form action="{{ route('professor.courses.update', $course->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">タイトル:</label>
            <input type="text" name="title" value="{{ old('title', $course->title) }}" required class="w-full border border-gray-300 rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">説明:</label>
            <textarea name="description" class="w-full border border-gray-300 rounded p-2">{{ old('description', $course->description) }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            更新する
        </button>
    </form>
@endsection
