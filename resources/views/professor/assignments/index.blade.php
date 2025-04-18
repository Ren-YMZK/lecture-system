@extends('layouts.professor')

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $course->title }} の課題一覧</h1>

    <a href="{{ route('professor.assignments.create', ['course' => $course->id]) }}"
       class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 mb-4">
        課題を追加
    </a>

    @if($assignments->isEmpty())
        <p>まだ課題が登録されていません。</p>
    @else
        <ul class="space-y-4">
            @foreach($assignments as $assignment)
                <li class="border rounded p-4 bg-white shadow">
                    <strong class="text-lg">{{ $assignment->title }}</strong>（満点: {{ $assignment->max_score }} 点）<br>
                    締切: {{ $assignment->deadline }}

                    <div class="mt-2 space-x-2">
                        <a href="{{ route('professor.assignments.edit', $assignment->id) }}"
                           class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                            編集
                        </a>

                        <form action="{{ route('professor.assignments.destroy', $assignment->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('本当に削除しますか？')"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                削除
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
