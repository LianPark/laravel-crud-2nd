@extends('board::layouts.layout')

@section('content')
<?php
    $idx = $boards->total()-(($boards->currentPage()-1) * $rows_per_page );
?>
    <h2 class="mt-4 mb-3"><a href="{{ route('boards.index') }}">게시판 목록</a></h2>
    <div style="text-align:right; margin-bottom:30px;">
        <form name="fsearch" method="get" action="{{ route('boards.search') }}" style="display:inline-block">
        <!-- <input type="hidden" name="type" value="search"> -->
        <input type="hidden" name="bo_table" value="tech">
        <input type="hidden" name="sca" value="">
        <input type="hidden" name="sop" value="and">
        <select name="sfl" id="sfl">
            <option value="subject">제목</option>
            <option value="content">내용</option>
            <option value="wr_subject||wr_content">제목+내용</option>
            <option value="userid">회원아이디</option>
            <option value="mb_id,0">회원아이디(코)</option>
            <option value="wr_name,1">글쓴이</option>
            <option value="wr_name,0">글쓴이(코)</option>
        </select>
        <label for="stx" class="sound_only">검색어</label>
        <input type="text" name="stx" value="" required="" id="stx" class="frm_input required" size="15" maxlength="15">
        <input type="submit" value="검색" class="btn_submit">
        </form>

        <button class="text-xl"><a href="{{ route('boards.create') }}">글쓰기</a></button></a>
    </div>
   
    <table class="table table-striped table-hover">
        <colgroup>
            <col width="7%"/>
            <col width="53%"/>
            <col width="15%"/>
            <col width="10%"/>
            <col width="15%"/>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">{{ ucfirst(__('board::messages.num')) }}</th>            
            <th scope="col">{{ ucfirst(__('board::messages.subject')) }}</th>
            <th scope="col">{{ ucfirst(__('board::messages.name')) }}</th>
            <th scope="col">{{ ucfirst(__('board::messages.hit')) }}</th>
            <th scope="col">{{ ucfirst(__('board::messages.date')) }}</th>
        </tr>
        </thead>
        <tbody>
          <?php
              //$pagenumber = $_GET["page"] ?? 1;
              $idx = $boards->total()-(($boards->currentPage()-1) * $rows_per_page );
          ?>
          @foreach($boards as $board)
            <tr>
              <td>{{ $idx-- }}</td>              
              <!-- td><a href="/boards/view/{{$board->id}}/{{$pagenumber}}">{{$board->subject}}</a></td -->
              <td><a href="{{ route('boards.show', [$board->id, 'page' => $pagenumber]) }}">{{$board->subject}}</a></td>
              <td>{{$board->userid}}</td>
              <td>{{$board->count}}</td>
              <td>{{ date("Y-m-d", strtotime($board->created_at)) }}</td>
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