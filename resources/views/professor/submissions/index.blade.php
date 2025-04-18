@extends('layouts.professor')

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $assignment->title }} の提出一覧</h1>

    @if($submissions->isEmpty())
        <p>まだ提出はありません。</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">学生名</th>
                        <th class="px-4 py-2 border">コメント</th>
                        <th class="px-4 py-2 border">提出日時</th>
                        <th class="px-4 py-2 border">ファイル</th>
                        <th class="px-4 py-2 border">点数</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                        <tr class="border-t">
                            <td class="px-4 py-2 border">{{ $submission->user->name }}</td>
                            <td class="px-4 py-2 border">{{ $submission->comment }}</td>
                            <td class="px-4 py-2 border">{{ $submission->submitted_at }}</td>
                            <td class="px-4 py-2 border">
                                @if(Storage::exists('public/' . $submission->file_path))
                                    <a href="{{ route('files.show', basename($submission->file_path)) }}"
                                       class="text-blue-600 underline"
                                       target="_blank">ファイルを見る</a>
                                @else
                                    <span class="text-red-600">ファイルが存在しません</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border">
                                <form action="{{ route('professor.submissions.score', $submission->id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')

                                    <input type="number" name="score" value="{{ $submission->score }}"
                                           min="0" max="{{ $assignment->max_score }}"
                                           class="w-20 border rounded px-2 py-1">

                                    <button type="submit"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                        保存
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
