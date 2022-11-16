<?php
session_start();
require_once('../lib/util.php');
require_once "db_connect.php";
$gobackURL = 'list.php';
$id = $_GET["id"];
$list_id = $_GET["id"];
if (isset($_GET["good"])) {
  $sql = "SELECT * FROM list WHERE id=$id";
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row) {
    $user_id = $row["user_id"];
  }
  $my_id = $_SESSION["id"];
  $count = 0;
  $memo="いいね";
  $myURL="detail.php?id=".$id;
  require_once('error.php');
  try {
    $sql = "SELECT * FROM likes WHERE my_id=$my_id and list_id=$list_id";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
      $count += 1;
    }
  } catch (Exception $e) {
    echo 'エラーがありました。';
    echo $e->getMessage();
    exit();
  }
  if ($count > 0) {
    $sql = "DELETE FROM likes WHERE list_id=:list_id and my_id=:my_id";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':list_id', $list_id, PDO::PARAM_STR);
    $stm->bindValue(':my_id', $my_id, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $sql = "INSERT INTO likes (list_id,my_id) VALUES(:list_id,:my_id)";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':list_id', $list_id, PDO::PARAM_STR);
    $stm->bindValue(':my_id', $my_id, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  }
  header('Location:detail.php?id=' . $id);
}
if (isset($_SESSION["id"])) {
  try {
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM users WHERE id =:id";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':id', $id, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
    }
    $money = $row["money"];
  } catch (Exception $e) {
    echo 'エラーがありました。';
    echo $e->getMessage();
    exit();
  }
?>

<?php
  $sql = "SELECT * FROM list WHERE id =$list_id";
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row) {
  }
  $text = "{$row["id"]}";
  //  $text="{$row["id"]}:{$row["item"]}";
  $data_item = array($text); //ここに保存したいテキスト（配列にしとく）
  $data_url = array($_SERVER["REQUEST_URI"]); //現在のURL（配列にしとく）
  $max = '10'; //保存する数

  //テキストの保存
  if (isset($_COOKIE['history_item'])) { //現在クッキーに保存されているものがあれば
    $status = unserialize($_COOKIE['history_item']); //まずアンシリアライズ（？）で配列に
    foreach ($status as $key => $name) {
      if (!in_array($name, $data_item)) { // data_itemにnameがなければ
        array_push($data_item, $name); // data_itemに突っ込む
      }
      if (count($data_item) == $max) { //保存する数で終了
        break;
      }
    }
  }

  //URL保存　テキスト保存とやってることは一緒
  if (isset($_COOKIE['history_url'])) {
    $status = unserialize($_COOKIE['history_url']);
    foreach ($status as $key => $name) {
      if (!in_array($name, $data_url)) {
        array_push($data_url, $name);
      }
      if (count($data_url) == $max) {
        break;
      }
    }
  }

  //クッキーセット
  setcookie('history_item', serialize($data_item), time() + 3600, '/');
  setcookie('history_url', serialize($data_url), time() + 3600, '/');
}
?>

<!DOCTYPE html>
<?php require_once("head.php") ?>
<title>貸し借り|詳細</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
</head>

<body>
  <audio id="audio"></audio>
  <div id="fb-root"></div>


  <!--ヘッダー-->
  <?php require_once("header.php"); ?>

  <div>
    <div id="wrapper">
      <!--メイン-->
      <div id="main">
        <section id="point">
          <h2>出品物詳細</h2>
          <div>
            <?php
    $data = $_GET["id"];
    try {
      $sql = "SELECT * FROM image_list WHERE list_id=$data";
      $stm = $pdo->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);
      $image_count = 0;
      foreach ($result as $row) {
        $image_count += 1;
      }
    } catch (Exception $e) {
      echo 'エラーがありました。';
      echo $e->getMessage();
      exit();
    }
    try {
      $sql = "SELECT * FROM likes WHERE list_id=$data";
      $stm = $pdo->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);
      $count = 0;
      foreach ($result as $row) {
        $count += 1;
      }
    } catch (Exception $e) {
      echo 'エラーがありました。';
      echo $e->getMessage();
      exit();
    }

    try {
      $sql = "SELECT * FROM list WHERE id=$data";
      $stm = $pdo->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>画像一覧</th>';
        echo '<td><a img data-lightbox="group" height="200" width="200  "href="image.php?id=', $row['id'], '">
                  <img src="image.php?id=', $row['id'], '"height="150" width="150"></a>';
        if ($image_count > 0) {
          echo '<a img data-lightbox="group" height="200" width="200  "href="image_next.php?id=', $row['id'], '&number=1">
                        <img src="image_next.php?id=', $row['id'], '&number=1"height="150" width="150"></a>';
          if ($image_count > 1) {
            echo '<a img data-lightbox="group" height="200" width="200  "href="image_next.php?id=', $row['id'], '&number=2">
                          <img src="image_next.php?id=', $row['id'], '&number=2"height="150" width="150"></a>';
            if ($image_count > 2) {
              echo '<a img data-lightbox="group" height="200" width="200  "href="image_next.php?id=', $row['id'], '&number=3">
                            <img src="image_next.php?id=', $row['id'], '&number=3"height="150" width="150"></a>';
              if ($image_count > 3) {
                echo '<a img data-lightbox="group" height="200" width="200  "href="image_next.php?id=', $row['id'], '&number=4">
                              <img src="image_next.php?id=', $row['id'], '&number=4"height="150" width="150"></a></td>';
              }
            }
          }
        }
        echo '</tr>';
        // echo '<tr>';
        echo '<tr>';
        echo '<th>最終編集時間</th>';
        echo '<td>', $row["created_at"], '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th>商品名</th>';
        echo '<td>', $row["item"], '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th>ジャンル</th>';
        echo '<td><a href="search_kind.php?kind_name=', $row["kind"], '">', ($row['kind']), '</a></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th>金額</th>';
        echo '<td>￥', number_format($row['money']), '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th>出品者</th>';
        echo '<td>';
        echo "<a href='profile.php?id={$row['user_id']}'><img id='image' height='100' width='100'src='my_image.php?id={$row['user_id']}'></a><br>";
        $user_id = $row["user_id"];
        $sql = "SELECT * FROM users WHERE id=$user_id";
        $stm = $pdo->prepare($sql);
        $stm->execute();
        $result2 = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result2 as $row2) {
          echo $row2["name"], "</td>";
        }
        echo '</tr>';
        echo '<tr>';
        echo '<th>コメント</th>';
        echo '<td>', $row["comment"], '</td>';
        echo '</tr>';
        if ($row["buy_user_id"] !== 0) {
          echo '<tr>';
          echo '<th>購入者</th>';
          echo '<td>';
          echo "<a href='profile.php?id={$row['buy_user_id']}'><img id='image' height='100' width='100'src='my_image.php?id={$row['buy_user_id']}'></a><br>";
          $user_id = $row["buy_user_id"];
          $sql = "SELECT * FROM users WHERE id=$user_id";
          $stm = $pdo->prepare($sql);
          $stm->execute();
          $result2 = $stm->fetchAll(PDO::FETCH_ASSOC);
          foreach ($result2 as $row2) {
            echo $row2["name"], "</td>";
          }
          echo '</tr>';
        }
        echo '</thead>';
        echo '</table>';
      }
    } catch (Exception $e) {
      echo 'エラーがありました。';
      echo $e->getMessage();
      exit();
    }
    ?>
            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
      
      // echo "<a href='favorite.php?id={$row["id"]}' class='btn'><img src='images/good.png' style='max-width:50px'>$count</a><br>";
      if ($row["buy_user_id"] === 0) {
        echo "<a href='loan.php?id={$row["id"]}' class='btn btn-success'>チャットをする</a><br>";
        echo '<form method="POST" action="detail.php?id=' . $row["id"] . '&good=1">';
        echo "<input type='image'src='images/good.png'style='max-width:50px'>$count<br>";
        echo '</form>';
      }
      if ($_SESSION['name'] === $row2["name"]) {
        if ($row["buy_user_id"] === 0) {
          echo "<a href='my_edit.php?id={$row["id"]}' class='btn btn-primary'>編集する</a>";
          echo "<a href='mydelete.php?id={$row["id"]}' class='btn btn-danger'>削除する</a>";
        }
      } else {
        if ($row["buy_user_id"] === 0) {
          echo "<a href='buy.php?id={$row["id"]}&money={$row["money"]}&user_id={$row["user_id"]}' class='btn btn-danger'>購入する</a>";
        } else {
          echo "<div style='color:red;'>※この商品は売り切れのため、チャットをすることはできません。</div><br>";
          echo "<a href='#' class='btn btn-danger'>売り切れ</a>";
        }
      }
    } ?>
            <hr>
            <p><a href="<?php echo $gobackURL ?>">戻る</a></p>
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

</body>

</html>