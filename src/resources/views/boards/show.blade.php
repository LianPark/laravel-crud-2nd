@extends('board::layouts.layout')

@section('title')
  글목록
@endsection

@section('content')
    <h2 class="mt-4 mb-3">글보기</h2>
    <br />
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th width="100">제목</th>
                <td>{{ $board->subject }}</td>
            </tr>
            <tr>
                <td colspan="2">글쓴이 : {{ $board->userid }} / 조회수 : {{ number_format($board->count) }} / 등록일 : {{ $board->created_at }}</td>
            </tr>
            <tr>
                <th width="100">내용</th>               
                <td height=150>{!! nl2br($board->content) !!}</td>
            </tr>
        </tbody>
    </table>
    <div style="align:right">
        <a href="{{ route('boards.index', ['page' => $pagenumber]) }}" class="btn btn-primary">목록</a>
        <a href="{{ route('boards.edit', [$board, 'page' => $pagenumber]) }}" class="btn btn-primary">수정</a>
        
        <!-- <a href="{{ route('boards.destroy', $board->id) }}" class="btn btn-primary">삭제</a> -->
        <form action="{{route('boards.destroy', [$board->id, 'page' => $pagenumber])}}" method="post" style="display:inline-block;">
            {{-- delete method와 csrf 처리필요 --}}
            @method('delete')
            @csrf
            <input onclick="return confirm('정말로 삭제하겠습니까?')" type="submit" class="btn btn-primary" value="삭제"/>
        </form>
        <a href="{{ route('boards.create') }}" class="btn btn-primary">글쓰기</a>

        <?php if ($prev_post) { ?>
        <a href="{{ route('boards.show', [$prev_post, 'page' => $pagenumber]) }}" class="btn btn-primary">이전글</a>
        <?php } ?>
        <?php if ($next_post) { ?>
        <a href="{{ route('boards.show', [$next_post, 'page' => $pagenumber]) }}" class="btn btn-primary">다음글</a>
        <?php } ?>

        @auth()
          @if ($board->userid == auth()->user()->userid)
          <a href="/boards/delete/{{$board->bid}}/?page={{ $board->pagenumber }}" class="btn btn-primary">삭제</a>
          @endif
        @endauth
    </div>
@endsection