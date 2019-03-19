
<h2>여기는 게시판 목록 페이지(board/index)입니다.</h2>
<p>이 페이지는 http://127.0.0.1/board 또는 http://127.0.0.1/board/index 로 접근할 수 있습니다.</p>

<ul class="board-list">
<?php foreach($board_list as $row){ ?>
<li><a href="/pattern/board/view/<?php echo $row->dl_number;?> ">/ <?php echo $row->dm_id;?> / <?php echo $row->dl_createAt;?></a></li>
<?php } ?>
</ul>

<button onclick="location.href='/board/write'">글쓰기</button>