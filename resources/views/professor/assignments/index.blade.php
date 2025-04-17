@extends('layouts.student')

@section('content')
    <h1>{{ $course->title }} の課題一覧</h1>

    <a href="{{ route('professor.assignments.create', ['course' => $course->id]) }}"
       style="display:inline-block; padding: 6px 12px; background-color: #4A90E2; color: white; border-radius: 4px; text-decoration: none; margin-bottom: 10px;">
        課題を追加
    </a>

    @if($assignments->isEmpty())
        <p>まだ課題が登録されていません。</p>
    @else
        <ul>
    @foreach($assignments as $assignment)
        <li>
            <strong>{{ $assignment->title }}</strong>（満点: {{ $assignment->max_score }} 点）<br>
            締切: {{ $assignment->deadline }}

            <!-- 編集リンク -->
            <a href="{{ route('professor.assignments.edit', $assignment->id) }}"
               style="padding: 6px 12px; background-color: #4A90E2; color: white; text-decoration: none; border-radius: 4px; margin-right: 5px;">
                編集
            </a>

            <!-- 削除ボタン -->
            <form action="{{ route('professor.assignments.destroy', $assignment->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('本当に削除しますか？')"
                        style="padding: 6px 12px; background-color: #E24A4A; color: white; border-radius: 4px;">
                    削除
                </button>
            </form>
        </li>
    @endforeach
</ul>

    @endif
@endsection
