@extends('board::layouts.layout')

@section('content')
    <h2 class="mt-4 mb-3">글수정</h2>
    <br />
    <form method="post" action="{{route('boards.update', [$board->id, 'page' => $pagenumber])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="attcnt" id="attcnt" value="0">
        <input type="hidden" name="imgUrl" id="imgUrl" value="">
        <input type="hidden" name="attachFile" id="attachFile" value="">
        <div class="form-group">
            <div class="col-md-12">
                <input type="text" name="userid" id="userid" class="form-control input-lg" placeholder="글쓴이를 입력하세요." value="{{$board->userid}}" />
            </div>
        <br />
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <input type="text" name="subject" id="subject" class="form-control input-lg" placeholder="제목을 입력하세요." value="{{$board->subject}}" />
            </div>
        <br />
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <textarea class="form-control" id="content" name="content" rows="5" placeholder="내용을 입력하세요.">{{$board->content}}</textarea>
            </div>
        </div>
        <br />
        <br />
        <div class="form-group">
            <div class="col-md-12 text-center">
                <button type="submit" name="edit" class="btn btn-primary input-lg">수정하기</button>
                <a href="/boards" class="btn btn-primary input-lg">홈으로</a>
            </div>
        </div>
    </form>
@endsection