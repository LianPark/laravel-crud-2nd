@extends('board::layouts.layout')

@section('content')
    <h2 class="mt-4 mb-3"><a href="{{ route('boards.index') }}">게시판 목록11</a></h2>
    <div style="text-align:right; margin-bottom:30px;">
        <button class="text-xl"><a href="/boards/write">글쓰기</a></button></a>
    </div>
   
    <table class="table table-striped table-hover">
        <colgroup>
            <col width="10%"/>
            <col width="15%"/>
            <col width="45%"/>
            <col width="15%"/>
            <col width="15%"/>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">Num</th>
            <th scope="col">Name</th>
            <th scope="col">Subject</th>
            <th scope="col">Hit</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
          <?php
              $pagenumber = $_GET["page"] ?? 1;
              $idx = $boards->total()-(($boards->currentPage()-1) * config('board.rows_per_page') );
          ?>
          @foreach($boards as $board)
            <tr>
              <td>{{$board->id}}</td>
              <td>{{$board->userid}}</td>
              <!-- td><a href="/boards/view/{{$board->id}}/{{$pagenumber}}">{{$board->subject}}</a></td -->
              <td><a href="{{ route('boards.show', $board->id)}}">{{$board->subject}}</a></td>
              <td>{{$board->count}}</td>
              <td>{{ date("Y-m-d",strtotime($board->created_at)) }}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
    <div>
      {!! $boards->onEachSide(1)->links() !!}
    </div>
@endsection

@section('footer')
    @include('board::layouts.footer', ['companyName'=>'Vantip Solutions'])
@endsection