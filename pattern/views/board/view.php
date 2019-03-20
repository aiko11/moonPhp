
<h2>여기는 게시판 글 보기(board/index)입니다.</h2>
<p>이 페이지는 http://127.0.0.1/board/view/글번호 와 같이 접근할 수 있습니다.</p>
<div class="board-view">
	<h2><?=$idx;?> 번 글을 보고 계십니다.</h2>
    <ul>
        <li><?=$board_view->writer?></li>
        <li><?=$board_view->title?></li>
        <li><?=$board_view->content?></li>
    </ul>
</div>
<button onclick="location.href='../'">목 록 으 로</button>