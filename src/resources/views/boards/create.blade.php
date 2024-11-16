@extends('board::layouts.layout')

@section('content')
    <h2 class="mt-4 mb-3">글쓰기</h2>
    <br />
    {{-- 유효성 검사에 걸렸을 경우 --}}
    @if ($errors->any())
        <div class="alert alert-warning" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('boards.store') }}" onsubmit="return oncheck()" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="attcnt" id="attcnt" value="0">
        <input type="hidden" name="imgUrl" id="imgUrl" value="">
        <input type="hidden" name="attachFile" id="attachFile" value="">
        <div class="form-group">
            <div class="col-md-12">
                <input type="text" name="userid" id="userid" class="form-control input-lg" value="{{old('userid')}}" placeholder="글쓴이를 입력하세요." />
            </div>
        </div>
        <br />
        <div class="form-group">
            <div class="col-md-12">
                <input type="text" name="subject" id="subject" class="form-control input-lg" value="{{old('subject')}}" placeholder="제목을 입력하세요." />
            </div>
        </div>
        <br />
        <div class="form-group">
            <div class="col-md-12">
                <textarea class="form-control" id="content" name="content" rows="5" placeholder="내용을 입력하세요.">{{old('content')}}</textarea>
            </div>
        </div>
        <br />
        <br />
        <div class="form-group">
            <div class="col-md-12 text-center">
                <button type="submit" name="edit" class="btn btn-primary input-lg">저장</button>
                <a href="/boards" class="btn btn-primary input-lg">목록보기</a>
            </div>
        </div>
    </form>
    <br />
    <br />
<script>
  function oncheck() {
      elem = document.getElementById('subject');
      alert('data: ' + elem.value + ', ' + elem.value.length);
      return true;
  }
</script>
@endsection