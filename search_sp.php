<?php
session_start();
require_once('../lib/util.php');
<<<<<<< HEAD
$gobackURL = 'index.php';
=======
<<<<<<< HEAD
$gobackURL = 'all.php';
=======
<<<<<<< HEAD
$gobackURL = 'all.php';
=======
$gobackURL ='all.php';
>>>>>>> root/master
>>>>>>> root/master
>>>>>>> root/master
require_once "db_connect.php";
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
              <li><input type="submit" value="検索する"></li>
            </ul>
          </form>
          <h2>ジャンル検索</h2>
          <form method="POST" action="search_kind.php">
            <ul>
              <li>
                <label>ジャンルで検索します：<br>
                  <select name="kind_name">
                    <?php
                          try {

                            $sql = "SELECT * FROM kind";
                            $stm = $pdo->prepare($sql);
                            $stm->execute();
                            $kind = $stm->fetchAll(PDO::FETCH_ASSOC);
                          } catch (Exception $e) {
                            echo 'エラーがありました。';
                            echo $e->getMessage();
                            exit();
                          }
                          foreach ($kind as $row) {
                            echo '<option value="', $row["id"], '">', $row["name"], "</option>";
                          }
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
              <li><input type="submit" value="検索する"></li>
            </ul>
          </form>
          <h2>ジャンル検索</h2>
          <form method="POST" action="search_kind.php">
            <ul>
              <li>
                <label>ジャンルで検索します：<br>
                  <select name="kind_name">
                    <?php
                          try {

                            $sql = "SELECT * FROM kind";
                            $stm = $pdo->prepare($sql);
                            $stm->execute();
                            $kind = $stm->fetchAll(PDO::FETCH_ASSOC);
                          } catch (Exception $e) {
                            echo 'エラーがありました。';
                            echo $e->getMessage();
                            exit();
                          }
                          foreach ($kind as $row) {
                            echo '<option value="', $row["id"], '">', $row["name"], "</option>";
                          }
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
              <li><input type="submit" value="検索する"></li>
            </ul>
          </form>
          <h2>ジャンル検索</h2>
          <form method="POST" action="search_kind.php">
            <ul>
              <li>
                <label>ジャンルで検索します：<br>
                  <select name="kind_name">
                    <?php
                          try {

                            $sql = "SELECT * FROM kind";
                            $stm = $pdo->prepare($sql);
                            $stm->execute();
                            $kind = $stm->fetchAll(PDO::FETCH_ASSOC);
                          } catch (Exception $e) {
                            echo 'エラーがありました。';
                            echo $e->getMessage();
                            exit();
                          }
                          foreach ($kind as $row) {
                            echo '<option value="', $row["id"], '">', $row["name"], "</option>";
                          }
=======
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
        <h2>ジャンル検索</h2>
    <form method="POST" action="search_kind.php">
    <ul>
      <li>
        <label>ジャンルで検索します：<br>
        <select name="kind_name">
                          <?php
                                  try{
                                    
                                    $sql = "SELECT * FROM kind";
                                    $stm = $pdo->prepare($sql);
                                    $stm->execute();
                                    $kind=$stm->fetchAll(PDO::FETCH_ASSOC);
                                }catch(Exception $e){
                                    echo 'エラーがありました。';
                                    echo $e->getMessage();
                                    exit();
                                }
                            foreach($kind as $row){
                              echo '<option value="',$row["id"],'">',$row["name"],"</option>";
                            }
>>>>>>> root/master
>>>>>>> root/master
>>>>>>> root/master
                          ?>
                  </select>
                </label>
              </li>
              <li><input type="submit" value="検索する"></li>
            </ul>
          </form>
        </section>
        <section id="point">
          <h2>金額検索</h2>
          <form method="POST" action="search_money.php">
            <ul>
              <li>
                <label>金額で検索します:<br>
                  <input type="number_format" name="money1">以上
                  <input type="number_format" name="money2">以下
              </li>
              <li><input type="submit" value="検索する"></li>
            </ul>
          </form>
          <h2>ユーザ検索</h2>
          <form method="POST" action="search_user.php">
            <ul>
              <li>
                <label>ユーザを検索します（部分一致）：<br>
                  <input type="text" name="user_name" placeholder="名前を入れてください。">
                </label>
              </li>
              <li><input type="submit" value="検索する"></li>
            </ul>
          </form>
        </section>
      </div>
      <!--/メイン-->
<<<<<<< HEAD

=======
<<<<<<< HEAD

      <!--サイド-->
      <?php
      require_once('side.php');
      ?>
      <!--/サイド-->
    </div>
    <!--/wrapper-->

=======

<<<<<<< HEAD
>>>>>>> root/master
      <!--サイド-->
      <?php
      require_once('side.php');
      ?>
      <!--/サイド-->
    </div>
    <!--/wrapper-->

<<<<<<< HEAD
=======
>>>>>>> root/master
>>>>>>> root/master
    <!--フッター-->
    <footer>
      <div id="footer_nav">
        <ul>
<<<<<<< HEAD
          <li class="current"><a href="index.php">HOME</a></li>
          <li><a href="add_db.php">商品登録</a></li>
          <li><a href="user_chat_list.php">一覧</a></li>
=======
          <li class="current"><a href="all.php">HOME</a></li>
          <li><a href="add_db.php">商品登録</a></li>
          <li><a href="list.php">一覧</a></li>
>>>>>>> root/master
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