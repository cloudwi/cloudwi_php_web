<?php
    session_start();
    if (isset($_SESSION["userlevel"])) $userid = $_SESSION["userid"];
    else $userid = "";

    $num = $_GET["num"];
    $page = $_GET["page"];

    $con = mysqli_connect("localhost", "root", "", "20173170");
    mysqli_query($con, "set names utf8");

    $sql = "select * from board where num=$num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $likes = $row["likes"];

    $sql3 = "select * from board_likes where num=$num and id = $userid";
    $result3 = mysqli_query($con, $sql3);
    $row3 = mysqli_fetch_array($result3);
    $id3 = $row3['id'];

    if ($userid == $id3)
    {
        echo("<script>
                alert('좋아요가 취소 되었습니다.');
                history.go(-1);
                </script>
            ");

        $sql5 = "delete from board_likes where num = $num and id = $userid";
        mysqli_query($con, $sql5);

        $new_likes = $likes - 1;
        $sql = "update board set likes=$new_likes where num=$num";   
        mysqli_query($con, $sql);

        mysqli_close($con);
        echo "
          <script>
              location.href = 'board_list.php?page=$page';
          </script>
        ";
        exit;
    }

    $sql2 = "insert into board_likes (id,num)";
    $sql2 .= "values('$userid','$num')";
    mysqli_query($con, $sql2);

    $new_likes = $likes + 1;
    $sql = "update board set likes=$new_likes where num=$num";   
    mysqli_query($con, $sql);

    mysqli_close($con); 
    echo "
	      <script>
	          location.href = 'board_list.php?page=$page';
	      </script>
	  ";
?>

   
