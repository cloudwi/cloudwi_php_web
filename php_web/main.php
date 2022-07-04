        
        <div id="main_img_bar">
            <a href="https://www.kr.playblackdesert.com/Intro/Update_Nova"><img src="./img/main_img.png"></div></a>
        <div id="main_content">
            <div id="latest">
                <h4>최근 게시글</h4>
                <ul>
<!-- 최근 게시 글 DB에서 불러오기 -->
<?php
    $con = mysqli_connect("localhost", "root", "", "20173170");
    $sql = "select * from board order by num desc limit 5";
    $result = mysqli_query($con, $sql);

    if (mysqli_fetch_array($result) == null)
        echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
    else
    {
    	$result = mysqli_query($con, $sql);
        while( $row = mysqli_fetch_array($result) )
        {
            $regist_day = substr($row["regist_day"], 0, 10);
?>
                <li>
                    <span><?=$row["subject"]?></span>
                    <span><?=$row["name"]?></span>
                    <span><?=$regist_day?></span>
                </li>
<?php
        }
    }
?>
            </div>
            <div id="point_rank">
                <h4>포인트 랭킹</h4>
                <ul>
<!-- 포인트 랭킹 표시하기 -->
<?php
    $rank = 1;
    $sql2 = "select * from members order by point desc limit 5";
    $result2 = mysqli_query($con, $sql2);

    if (mysqli_fetch_array($result2) == null)
        echo "회원 DB 테이블(members)이 생성 전이거나 아직 가입된 회원이 없습니다!";
    else
    {
    	$result2 = mysqli_query($con, $sql2);
        while( $row = mysqli_fetch_array($result2) )
        {
            $name  = $row["name"];        
            $id    = $row["id"];
            $point = $row["point"];
            $name = mb_substr($name, 0, 1)." * ".mb_substr($name, 2, 1);
?>
                <li>
                    <span><?=$rank?></span>
                    <span><?=$name?></span>
                    <span><?=$id?></span>
                    <span><?=$point?></span>
                </li>
<?php
            $rank++;
        }
    }

    mysqli_close($con);
?>
                </ul>
            </div>

<!-- -------------------------------------------- -->


<!-- -------------------------------------------- -->

        </div>