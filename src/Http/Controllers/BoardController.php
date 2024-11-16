<?php

namespace Lianpark\Board\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lianpark\Board\Models\Board;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    private $board;

    public function __construct(Board $board){
        // Laravel 의 IOC(Inversion of Control) 입니다
        // 일단은 이렇게 모델을 가져오는 것이 추천 코드라고 생각하시면 됩니다.
        $this->board = $board;
    }

    /**
     * 게시판 글목록
     */
    public function index(Request $request)
    {
      $rows_per_page = config('lalaboard.rows_per_page');
      $pagenumber = $_GET["page"] ?? 1;

      if ($request->input('type') === 'search') {

          $bo_table = $request->input('bo_table');
          $sch_category = $request->input('sca');
          $sch_op    = $request->input('sop');
          $sch_field = $request->input('sfl');
          $sch_text  = $request->input('stx');

          //echo "$sch_category, $sch_op, $sch_field, $sch_text";

          // select * from boards where subject like '%데이터%';
          $boards = Board::where($sch_field, 'LIKE', "%" . $sch_text . "%")->paginate($rows_per_page);

      } else {

          //print_r($request);
          //echo $request->input('page');
          // rows_per_page 적용
          
          $boards = Board::orderBy('id','desc')->paginate($rows_per_page);
          //echo "<pre>";print_r($boards);echo "</pre>";
          
          $boards->appends(['sort' => 'votes']);
          
      }

      return view('board::boards.index', compact('boards', 'rows_per_page', 'pagenumber'));
    }


    /**
     * 검색기능 추가
     */
    public function search(Request $request)
    {
        $rows_per_page = config('lalaboard.rows_per_page');
        $pagenumber = $_GET["page"] ?? 1;

        $bo_table = $request->input('bo_table');
        $sch_category = $request->input('sca');
        $sch_op    = $request->input('sop');
        $sch_field = $request->input('sfl');
        $sch_text  = $request->input('stx');

        //echo "$sch_category, $sch_op, $sch_field, $sch_text";

        // select * from boards where subject like '%데이터%';
        $boards = Board::where($sch_field, 'LIKE', "%" . $sch_text . "%")->paginate($rows_per_page);

        //$search  = $request->input('search');
        //$results = Product::where('name', 'like', "%$search%")->get();

        //return view('products.index', ['results' => $results]);
        return view('board::boards.index', compact('boards', 'rows_per_page', 'pagenumber'));
    }


    /**
     * 게시판 새글 쓰기폼
     */
    public function create()
    {      
      return view('board::boards.create');
    }

    /**
     * 게시판 새글 저장
     */
    public function store(Request $request)
    {
        $request = $request->validate([
            'userid' => 'required|max:30',
            'subject' => 'required|max:255',
            'content' => 'required',
        ]);
        $this->board->create($request);
        return redirect()->route('boards.index');
    }


    /**
     * 게시판 상세글 보기
     */
    public function show(Board $id)
    {
        echo "LEN::" . strlen($id->subject);

        /* 이전글, 다음글 */
        $prev = DB::select('SELECT * FROM boards WHERE id > ? ORDER BY id asc limit 1', [$id->id]);
        $next = DB::select('SELECT * FROM boards WHERE id < ? ORDER BY id desc limit 1', [$id->id]);
        if ( (isset($prev[0]->id) && $prev[0]->id)) {
            $prev_post = $prev[0]->id;
        } else {
          $prev_post = 0;
        }
        if ( (isset($next[0]->id) && $next[0]->id)) {
            $next_post = $next[0]->id;
        } else {
          $next_post = 0;
        }

        $pagenumber = $_GET['page'];
        $board = $id;
        DB::table("boards")->where('id', $board->id)->increment('count');

        //$this->board->increment('count'); // 3개가 업데이트 됨.
        return view('board::boards.show', compact('board', 'pagenumber', 'prev_post', 'next_post'));
    }

    /**
     * 게시판 상세글 수정화면
     */
    public function edit(Board $id)
    {
        $pagenumber = $_GET['page'];
        $board = $id;
        return view('board::boards.edit', compact('board', 'pagenumber'));
    }

    /**
     * 게시판 상세글 수정하기
     */
    public function update(Request $request, Board $id)
    {
        $pagenumber = $_GET['page'];
        $board = $id;
        $request = $request->validate([
            'userid' => 'required',
            'subject' => 'required',
            'content' => 'required',
        ]);
        print_r($request);
        // $product는 수정할 모델 값이므로 바로 업데이트 해줍시다.
        $board->update($request);
        return redirect()->route('boards.index', ['page'=>$pagenumber]);
    }

    /**
     * 상세글 삭제
     */
    public function destroy(Board $id)
    {
        $pagenumber = $_GET['page'];
        $board = $id;
        $board->delete();
        return redirect()->route('boards.index', ['page'=>$pagenumber]);
    }

    public function test()
    {
      echo config('board.admin_email');
      //return view('board::test');
      return $this->board::currentPage();;
    }
}
