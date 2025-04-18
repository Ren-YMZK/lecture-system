@extends('layouts.professor')

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $course->title }} に課題を追加</h1>

    <form action="{{ route('professor.assignments.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course->id }}">

        <div>
            <label class="block font-semibold mb-1">タイトル:</label>
            <input type="text" name="title" required class="w-full border border-gray-300 rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">説明:</label>
            <textarea name="description" class="w-full border border-gray-300 rounded p-2"></textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">締切:</label>
            <input type="datetime-local" name="deadline" required class="border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">満点:</label>
            <input type="number" name="max_score" value="100" required class="border rounded p-2 w-24">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            課題を作成
        </button>
    </form>
@endsection
