<?php
session_start();
require_once('../lib/util.php');
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> root/master
>>>>>>> root/master
$myURL = 'list.php';
$option = '';
$gobackURL = 'all.php';
require_once "db_connect.php";
$block_count = 0;
$block=0;
define('MAX', '12');
// require_once("block_check.php");
if (!isset($_SESSION["check"])) {
  $check = 0;
} else {
  $check = $_SESSION["check"];
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
$gobackURL ='all.php';
require_once "db_connect.php";
$block_count=0;
define('MAX','12');
if(isset($_SESSION["id"])){
  $sql = "SELECT * FROM blocklist WHERE my_id =:id";
  $stm = $pdo->prepare($sql);
  $stm->bindValue(':id',$_SESSION["id"],PDO::PARAM_STR);
  $stm->execute();
  $result=$stm->fetchAll(PDO::FETCH_ASSOC);
  foreach($result as $row){
    $block_count+=1;
    $block_list[]=$row["user_id"];
  }
}
if(!isset($_SESSION["check"])){
  $check=0;
}else{
  $check=$_SESSION["check"];
>>>>>>> root/master
>>>>>>> root/master
>>>>>>> root/master
}
?>

<!DOCTYPE html>
<<<<<<< HEAD
<?php require_once("head.php") ?>
=======
<<<<<<< HEAD
<?php require_once("head.php") ?>
=======
<<<<<<< HEAD
<?php require_once("head.php") ?>
=======
<?php require_once("head.php")?>
>>>>>>> root/master
>>>>>>> root/master
>>>>>>> root/master
<title>貸し借り|一覧</title>
</head>

<body>
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> root/master
>>>>>>> root/master
  <script src="js/original.js"></script>
  <div id="cursor"></div>
  <audio id="audio"></audio>
  <div id="fb-root"></div>


<<<<<<< HEAD
  <!--ヘッダー-->
  <?php require_once("header.php"); ?>

  <div>
    <!-- 入力フォームを作る -->

    <div id="wrapper">
      <!--メイン-->
      <div id="main">
        <section id="point">
          <h2>検索</h2>
          <form method="POST" action="search1.php">
            <ul>
              <li>
                <label>名前を検索します（部分一致）：<br>
                  <input type="text" name="item" placeholder="名前を入れてください。">
                </label>
              </li>
              <?php
              $block=0;
              require_once('block_check.php');
              ?>
              <li><input type="submit" value="検索する"></li>
            </ul>
          </form>
          <section id="point">
            <h2>出品物一覧</h2>
            <div>
              <?php
              try {
                $count = 0;
                if ($block_count != 0) {
                  $block_list = implode(",", $block_list);
                  $sql = "SELECT * FROM list WHERE user_id not in ($block_list) ORDER BY created_at desc";
                } else {
                  $sql = "SELECT * FROM list ORDER BY created_at desc";
                }
                $stm = $pdo->prepare($sql);
                $stm->execute();
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                require_once("paging.php");
                echo '<table>';
                echo '<thead><tr>';
                echo '</tr></thead>';
                echo '<tbody>';
                echo '<tr>';
                foreach ($disp_data as $row) {
                  $count += 1;
                  echo '<div class="container mt-3">';
                  echo '<td class="border border-dark">';
                  echo '<div class="sample5"><a href=detail.php?', "id={$row["id"]}>";
                  echo '<img id="parent" src="image.php?id=', $row["id"], ' alt="" height="232" width="232"/>';
                  if ($row["loan"] == 1) {
                    echo '<img id="child" src="images/sold.png" height="232" width="232"/>';
                  }
                  echo '<div class="mask">';
                  echo '<div class="caption">', $row["item"], '</div>';

                  echo '<div class="price"><p class="rainbow">￥', number_format($row["money"]), '</p></div>';
                  echo '</div></div></a></td></div>';
                  if ($count % 4 == 0) {
                    echo "</tr>";
                    echo "<tr>";
                  }
                }
                echo "</tr>";
                echo '</tbody>';
                echo '</table>';
              } catch (Exception $e) {
                echo 'エラーがありました。';
                echo $e->getMessage();
                exit();
              }
              require_once('paging2.php');
              ?>
            </div>
          </section>
      </div>
      <!--/メイン-->

      <!--サイド-->

      <?php
      require_once('side.php');
      ?>


      <!--/サイド-->
    </div>
    <!--/wrapper-->

=======
<<<<<<< HEAD
  <!--ヘッダー-->
  <?php require_once("header.php"); ?>

  <div>
    <!-- 入力フォームを作る -->

    <div id="wrapper">
      <!--メイン-->
      <div id="main">
        <section id="point">
          <h2>検索</h2>
          <form method="POST" action="search1.php">
            <ul>
              <li>
                <label>名前を検索します（部分一致）：<br>
                  <input type="text" name="item" placeholder="名前を入れてください。">
                </label>
              </li>
              <?php
              $block=0;
              require_once('block_check.php');
              ?>
              <li><input type="submit" value="検索する"></li>
            </ul>
          </form>
          <section id="point">
            <h2>出品物一覧</h2>
            <div>
              <?php
              try {
                $count = 0;
                if ($block_count != 0) {
                  $block_list = implode(",", $block_list);
                  $sql = "SELECT * FROM list WHERE user_id not in ($block_list)";
                } else {
                  $sql = "SELECT * FROM list";
                }

                $stm = $pdo->prepare($sql);
                $stm->execute();
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                require_once("paging.php");
                echo '<table>';
                echo '<thead><tr>';
                echo '</tr></thead>';
                echo '<tbody>';
                echo '<tr>';
                foreach ($disp_data as $row) {
                  $count += 1;
                  echo '<div class="container mt-3">';
                  echo '<td class="border border-dark">';
                  echo '<div class="sample5"><a href=detail.php?', "id={$row["id"]}>";
                  echo '<img id="parent" src="image.php?id=', $row["id"], ' alt="" height="232" width="232"/>';
                  if ($row["loan"] == 1) {
                    echo '<img id="child" src="images/sold.png" height="232" width="232"/>';
                  }
                  echo '<div class="mask">';
                  echo '<div class="caption">', $row["item"], '</div>';

                  echo '<div class="price"><p class="rainbow">￥', number_format($row["money"]), '</p></div>';
                  echo '</div></div></a></td></div>';
                  if ($count % 4 == 0) {
                    echo "</tr>";
                    echo "<tr>";
                  }
                }
                echo "</tr>";
                echo '</tbody>';
                echo '</table>';
              } catch (Exception $e) {
                echo 'エラーがありました。';
                echo $e->getMessage();
                exit();
              }
              require_once('paging2.php');
              ?>
            </div>
          </section>
      </div>
      <!--/メイン-->

      <!--サイド-->

      <?php
      require_once('side.php');
      ?>


      <!--/サイド-->
    </div>
    <!--/wrapper-->

=======
  <!--ヘッダー-->
  <?php require_once("header.php"); ?>

  <div>
    <!-- 入力フォームを作る -->

    <div id="wrapper">
      <!--メイン-->
      <div id="main">
        <section id="point">
          <h2>検索</h2>
          <form method="POST" action="search1.php">
            <ul>
              <li>
                <label>名前を検索します（部分一致）：<br>
                  <input type="text" name="item" placeholder="名前を入れてください。">
                </label>
              </li>
              <?php
              $block=0;
              require_once('block_check.php');
              ?>
              <li><input type="submit" value="検索する"></li>
            </ul>
          </form>
          <section id="point">
            <h2>出品物一覧</h2>
            <div>
              <?php
              try {
                $count = 0;
                if ($block_count != 0) {
                  $block_list = implode(",", $block_list);
                  $sql = "SELECT * FROM list WHERE user_id not in ($block_list)";
                } else {
                  $sql = "SELECT * FROM list";
                }

                $stm = $pdo->prepare($sql);
                $stm->execute();
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                require_once("paging.php");
                echo '<table>';
                echo '<thead><tr>';
                echo '</tr></thead>';
                echo '<tbody>';
                echo '<tr>';
                foreach ($disp_data as $row) {
                  $count += 1;
                  echo '<div class="container mt-3">';
                  echo '<td class="border border-dark">';
                  echo '<div class="sample5"><a href=detail.php?', "id={$row["id"]}>";
                  echo '<img id="parent" src="image.php?id=', $row["id"], ' alt="" height="232" width="232"/>';
                  if ($row["loan"] == 1) {
                    echo '<img id="child" src="images/sold.png" height="232" width="232"/>';
                  }
                  echo '<div class="mask">';
                  echo '<div class="caption">', $row["item"], '</div>';

                  echo '<div class="price"><p class="rainbow">￥', number_format($row["money"]), '</p></div>';
                  echo '</div></div></a></td></div>';
                  if ($count % 4 == 0) {
                    echo "</tr>";
                    echo "<tr>";
                  }
                }
                echo "</tr>";
                echo '</tbody>';
                echo '</table>';
              } catch (Exception $e) {
                echo 'エラーがありました。';
                echo $e->getMessage();
                exit();
              }
              require_once('paging2.php');
              ?>
            </div>
          </section>
      </div>
      <!--/メイン-->

      <!--サイド-->

      <?php
      require_once('side.php');
      ?>


      <!--/サイド-->
=======
<script src="js/original.js"></script>
<div id="cursor"></div>
<audio id="audio"></audio>
<div id="fb-root"></div>

  
  <!--ヘッダー-->
  <?php require_once("header.php");?>

<div>
  <!-- 入力フォームを作る -->
  
  <div id="wrapper">
    <!--メイン-->
    <div id="main">
      <section id="point">
        <h2>検索</h2>
  <form method="POST" action="search1.php">
    <ul>
      <li>
        <label>名前を検索します（部分一致）：<br>
        <input type="text" name="item" placeholder="名前を入れてください。">
        </label>
      </li>
      <li><input type="submit" value="検索する"></li>
    </ul>
  </form>
      <section id="point">
        <h2>出品物一覧</h2>
        <div>
    <?php
        try{
          if($block_count!=0){
            $block_list=implode(",",$block_list);
          }
            $count=0;
            
            if($block_count!=0){
                $sql = "SELECT * FROM list WHERE user_id not in ($block_list)";
            }else{
                $sql = "SELECT * FROM list";
            }

            $stm = $pdo->prepare($sql);
            $stm->execute();
            $result=$stm->fetchAll(PDO::FETCH_ASSOC);
            $books_num = count($result);
            $max_page = ceil($books_num / MAX);
            if(!isset($_GET['page_id'])){
                $now = 1;
            }else{
                $now = $_GET['page_id'];
            }
            $start_no = ($now - 1) * MAX;
            $disp_data = array_slice($result, $start_no, MAX, true);
            echo '<table>';
            echo '<thead><tr>';
            echo '</tr></thead>';
            echo '<tbody>';
            echo '<tr>';
            foreach($disp_data as $row){
                $count+=1;
                echo '<div class="container mt-3">';
                echo '<td class="border border-dark">';
                echo'<div class="sample5"><a href=detail.php?',"id={$row["id"]}>";
                echo '<img id="parent" src="image.php?id=',$row["id"],' alt="" height="232" width="232"/>';
                if($row["loan"]==1){
                echo '<img id="child" src="images/sold.png" height="232" width="232"/>';
                }
                echo '<div class="mask">';
                echo '<div class="caption">',$row["item"],'</div>';
                
                echo '<div class="price"><p class="rainbow">￥',number_format($row["money"]),'</p></div>';
                echo '</div></div></a></td></div>';
                if($count%4==0){
                  echo "</tr>";
                  echo "<tr>";
                }
            }
            echo "</tr>";
            echo '</tbody>';
            echo '</table>';
        }catch(Exception $e){
            echo 'エラーがありました。';
            echo $e->getMessage();
            exit();
        }
        echo '全件数'. $books_num. '件'. '　';
            if($now > 1){ // リンクをつけるかの判定
                echo '<a href=list.php?page_id='.($now - 1).'>前へ</a>'. '　';
            } else {
                echo '前へ'. '　';
            }
            
            for($i = 1; $i <= $max_page; $i++){
                if ($i == $now) {
                    echo $now. '　'; 
                } else {
                    echo '<a href=list.php?page_id='. $i. '>'. $i. '</a>'. '　';
                }
            }
             
            if($now < $max_page){ // リンクをつけるかの判定
                echo '<a href=list.php?page_id='.($now + 1).'>次へ</a>'. '　';
            } else {
                echo '次へ';
            }
    ?>
</div>
      </section>
>>>>>>> root/master
    </div>
    <!--/wrapper-->

<<<<<<< HEAD
>>>>>>> root/master
>>>>>>> root/master
    <!--フッター-->
    <footer>
      <div id="footer_nav">
        <ul>
          <li class="current"><a href="all.php">HOME</a></li>
          <li><a href="add_db.php">商品登録</a></li>
          <li><a href="list.php">一覧</a></li>
          <li><a href="mypage.php">マイページ</a></li>
          <li><a href="register.php">アカウント登録</a></li>
          <li><a href="login.php">ログイン</a></li>
        </ul>
      </div>
      <small>&copy; 2015 Bloom.</small>
    </footer>
    <!--/フッター-->
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
    <!--サイド-->
    
      <?php
    require_once('side.php');
    ?>

    
    <!--/サイド-->
  </div>
  <!--/wrapper-->

  <!--フッター-->
  <footer>
    <div id="footer_nav">
    <ul>
        <li class="current"><a href="all.php">HOME</a></li>
        <li><a href="add_db.php">商品登録</a></li>
        <li><a href="list.php">一覧</a></li>
        <li><a href="mypage.php">マイページ</a></li>
        <li><a href="register.php">アカウント登録</a></li><li><a href="login.php">ログイン</a></li>
      </ul>
    </div>
    <small>&copy; 2015 Bloom.</small>
  </footer>
  <!--/フッター-->
>>>>>>> root/master
>>>>>>> root/master
>>>>>>> root/master
</body>

</html>