@extends('board::layouts.layout')

@section('content')
    <h2 class="mt-4 mb-3">글쓰기</h2>
    <div style="text-align:right; margin-bottom:30px;">
        <button class="text-xl">글쓰기</button></a>
    </div>
    <br />
    <form method="post" action="/boards/create" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="attcnt" id="attcnt" value="0">
        <input type="hidden" name="imgUrl" id="imgUrl" value="">
        <input type="hidden" name="attachFile" id="attachFile" value="">
        <div class="form-group">
            <div class="col-md-12">
                <input type="text" name="userid" id="userid" class="form-control input-lg" placeholder="글쓴이를 입력하세요." />
            </div>
        <br />
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <input type="text" name="subject" id="subject" class="form-control input-lg" placeholder="제목을 입력하세요." />
            </div>
        <br />
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <textarea class="form-control" id="content" name="content" rows="5" placeholder="내용을 입력하세요."></textarea>
            </div>
        </div>
        <br />
        <br />
        <div class="form-group">
            <div class="col-md-12 text-center">
                <button type="button" name="edit" class="btn btn-primary input-lg" onclick="sendsubmit()">등록</button>
                <a href="/boards" class="btn btn-primary input-lg">홈으로</a>
            </div>
        </div>
    </form>
<script>
    function sendsubmit(){
        var userid=$("#userid").val();
        var subject=$("#subject").val();
        var content=$("#content").val();

        if (!userid) {
          alert('no userid');
          return false;
        }

        if (!subject) {
          alert('no subject');
          return false;
        }

        if (!content) {
          alert('no content');
          return false;
        }

        var data = {
            userid : userid,
            subject : subject,
            content : content
        };

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'post',
            url: '{{ route('boards.store') }}',
            dataType: 'json',
            data: data,
            success: function(data) {
                location.href='/boards/view/'+data.bid;
            },
            error: function(data) {
                console.log("error: " + JSON.stringify(data));
            }
        });
    }
</script>    
@endsection