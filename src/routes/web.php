<?php

use Illuminate\Support\Facades\Route;
use Lianpark\Board\Http\Controllers\BoardController;

Route::get('/test', [BoardController::class, 'test']);


Route::group(['middleware' => ['web']], function () {

    // 게시판 글목록
    Route::get('/boards', [BoardController::class, 'index'])->name('boards.index');
    // 게시판 새글 쓰기 화면만들기
    Route::get('/boards/create', [BoardController::class, 'create'])->name('boards.create');
    // 게시판 새글 저장
    Route::post('/boards', [BoardController::class, 'store'])->name('boards.store');
    // 게시판 상세글 보기
    Route::get('/boards/{id}', [BoardController::class, 'show'])->name('boards.show');
    // 게시판 상세글 수정화면
    Route::get('/boards/{id}/edit', [BoardController::class, 'edit'])->name('boards.edit');
    // 게시판 상세글 수정저장
    Route::put('/boards/{id}', [BoardController::class, 'update'])->name('boards.update');
    // 게시판 상세글 삭제
    Route::delete('/boards/{id}', [BoardController::class, 'destroy'])->name('boards.destroy');

    Route::get('/search', [BoardController::class, 'search'])->name('boards.search');

});


// //Route::get('/boards/view/{id}/{page}', [BoardController::class, 'view'])->name('boards.view');
// Route::get('/boards/view', [BoardController::class, 'view'])->name('boards.view');
// // {product}는 주소의 변경가능한 값이 오는 것을 product로 받는 것을 의미합니다, 이 값은 현재 아이디가 오는 데
// // 해당 아이디에 맞춘 모델 객체를 ProductController의 show 함수에 매개변수로 보내는 동작을 >수행합니다.
// Route::get('boards/{board}',[BoardController::class, 'show'])->name("boards.show");
// // 글쓰기
// Route::get('/boards/write', [BoardController::class, 'write'])->name('boards.write');
// Route::post('/boards/create', [BoardController::class, 'store'])->name('boards.store');
// // 글수정
// Route::get('/boards/{id}/edit', [BoardController::class, 'edit'])->name('boards.edit');
// Route::put('/boards/{id}', [BoardController::class, 'update'])->name('boards.update');