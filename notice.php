<?php
session_start(); 
require_once('../lib/util.php');
$gobackURL ='all.php';
$user='root';
$password='';
$dbName = 'loan_db';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
$pdo=new PDO($dsn,$user,$password);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>

<!DOCTYPE html>
<html lang="ja" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.faceboook.com/2008/fbml">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta charset="UTF-8">
<meta property="og:title" content="フラワーアレンジメント教室　Bloom【ブルーム】">
<meta property="og:description" content="東京都千代田区にあるフラワーアレンジメント教室Bloom【ブルーム】">
<meta property="og:url" content="http://bloom.ne.jp">
<meta property="og:image" content="images/main_visual.jpg">
<title>貸し借り|一覧</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="東京都千代田区にあるフラワーアレンジメント教室Bloom【ブルーム】。一人ひとりに向き合った、その人らしいアレンジメントを考えながら楽しく学べます。初心者の方も安心してご参加ください。">
<link rel="stylesheet" href="css/styled.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/original.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/l.css">
<link rel="stylesheet" href="css/m.css">
<link rel="stylesheet" href="css/s.css">
<link rel="favicon.ico">
<link rel="apple-touch-icon" href="webclip152.png">
<script src="js/original.js">
</script>
</head>
<body>
<script src="js/original.js"></script>
<div id="cursor"></div>
<audio id="audio"></audio>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5&appId=643231655816289";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  
  <!--ヘッダー-->
		<div id="header">
<div class="game_bar" style="background-image: url(images/main_visual.jpg);">
		<div class="game_title">
				<a href="all.php"><img src=""class="mr5" /></a>
				<a  href="all.php">貸し借りサイト</a>
			<div id="menu_s">
				<div>
				<div><a href="all.php"><img src="images/home.png"  style="width:70px" /><span>HOME</span></a></div>
				<div><a href="add_db.php"><img src="images/register.png"  style="width:70px" /><span>商品登録</span></span></a></div>
				<div><a href="search_sp.php"><img src="images/search.png"  style="width:70px" /><span>検索</span></span></a></div>
				<div><a href="list.php"><img src="https://cdn08.net/dqwalk/data/img0/img2_5.png?6e1"  style="width:70px" /><span>一覧</span></a></div>
				<div><a href="mypage.php"><img src="https://cdn08.net/dqwalk/data/img0/img93_5.png?87b"  style="width:70px" /><span>マイページ</span></span></a></div>
				<div><a href="contact.php"><img src="images/contact.png" style="width:70px" /><span>お問い合わせ</span></a></div>
			</div>
			</div>
			<?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]===true){
          ?>
          <a href="javascript:if(confirm('ログアウトしますか？')) location.href='logout.php';"  style="width:30px;"><img height="30" width="30" src="my_image.php?id=<?php echo $_SESSION["id"];?>" style="border-radius: 50%"/></a>

        <?php }else{?>
          <a href="javascript:location.href='login.php';" style="width:30px;" class="open_login_menu pl5 pr5"><img src="https://cdn08.net/pokemongo/wiki/login.png" alt="ログイン"></a>		
                            <?php }?>
		</div>
		</div>

<div>
  <!-- 入力フォームを作る -->
  
  <div id="wrapper">
    <!--メイン-->
    <div id="main">
      <section id="point">
        <h1>お知らせ欄</h1>
        <?php
        $count=0;
        $count2=0;
        $count_chat=0;
        $count_chat2=0;
        $id=$_SESSION["id"];
        $sql = "SELECT * FROM list WHERE user_id=$id";
        $stm = $pdo->prepare($sql);
        $stm->execute();
        $result_chat=$stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($result_chat as $row_chat){
          $count_chat+=1;
          $chat_list[]=$row_chat["id"];
        }
        if($count_chat!=0){
          $chat_list=implode(",",$chat_list);
          $sql = "SELECT * FROM chat WHERE list_id IN ($chat_list)";
          $stm = $pdo->prepare($sql);
          $stm->execute();
          $chat_result=$stm->fetchAll(PDO::FETCH_ASSOC);
          foreach($chat_result as $row_chat2){
            $count_chat2+=1;
            $chat_list2[]=$row_chat2["list_id"];
          }
        }
        $sql = "SELECT * FROM list WHERE user_id=$id";
        $stm = $pdo->prepare($sql);
        $stm->execute();
        $result2=$stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($result2 as $row2){
          $count+=1;
          $list_list[]=$row2["id"];
        }
        if($count!=0){
        $list_list=implode(",",$list_list);
        $sql = "SELECT * FROM likes WHERE list_id IN ($list_list)";
        $stm = $pdo->prepare($sql);
        $stm->execute();
        $result=$stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
          $count2+=1;
          $main_list[]=$row["list_id"];
        }
      }
      ?>
      <?php
        if($count2!=0){
          $main_list=implode(",",$main_list);
          $pdo=new PDO($dsn,$user,$password);
          $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
          $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          $sql = "SELECT * FROM list WHERE id IN ($main_list)";
          $stm = $pdo->prepare($sql);
          $stm->execute();
          $result=$stm->fetchAll(PDO::FETCH_ASSOC);
          echo "<h2>この商品が「いいね」されました。</h2>";
          echo '<table class="table table-striped">';
          echo '<thead><tr>';
          echo '<th>','貸出物','</th>';
          echo '<th>','金額','</th>';
          echo '<th>','画像','</th>';
          echo '<th>','いいね数','</th>';
          echo '<th>','既読にする','</th>';
          echo '</tr></thead>';
          echo '<tbody>';
          foreach($result as $row){
              $good_count=0;
              echo '<tr>';
              echo '<td>',$row['item'],'</td>';
              echo '<td>￥',number_format($row['money']),'</td>';
              echo "<td><a href=detail.php?id={$row["id"]}>",'<img height="100" width="100" src="image.php?id=',$row['id'],'"></a></td>';
              $sql = "SELECT * FROM likes WHERE list_id=".$row["id"];
              $stm = $pdo->prepare($sql);
              $stm->execute();
              $result_good=$stm->fetchAll(PDO::FETCH_ASSOC);
              foreach($result_good as $row_good){
                $good_count+=1;
              }
              echo "<td><img src='images/good.png' style='max-width:50px'><div style='font-size:35px;'>",$good_count,'</div></td>';
              echo '<td><input id="check" type="checkbox" name="#" class="big"></td>';
              echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
        }
      ?>
      <?php
        try{
          $pdo=new PDO($dsn,$user,$password);
          $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
          $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          $sql = "SELECT * FROM list WHERE  user_id=:id and loan=1";
          $stm = $pdo->prepare($sql);
          $stm->bindValue(':id',$id,PDO::PARAM_STR);
          $stm->execute();
          $result=$stm->fetchAll(PDO::FETCH_ASSOC);
          echo "<h2>この商品が「購入」されました。</h2>";
          echo '<table class="table table-striped">';
          echo '<thead><tr>';
          echo '<th>','掲載日','</th>';
          echo '<th>','貸出物','</th>';
          echo '<th>','ジャンル','</th>';
          echo '<th>','金額','</th>';
          echo '<th>','画像','</th>';
          echo '<th>','既読にする','</th>';
          echo '</tr></thead>';
          echo '<tbody>';
          foreach($result as $row){
              echo '<tr>';
              echo '<td>',$row['created_at'],'</td>';
              echo '<td>',$row['item'],'</td>';
              echo '<td>',$row['kind'],'</td>';
              echo '<td>￥',number_format($row['money']),'</td>';
              echo "<td><a href=detail.php?id={$row["id"]}>",'<img height="100" width="100" src="image.php?id=',$row['id'],'"></a></td>';
              echo '<td><input id="check" type="checkbox" name="#" class="big"></td>';
              echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
      }catch(Exception $e){
          echo 'エラーがありました。';
          echo $e->getMessage();
          exit();
      }
      ?>
            <?php
        if($count_chat!=0){
          $chat_list2=implode(",",$chat_list2);
          $pdo=new PDO($dsn,$user,$password);
          $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
          $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          $sql = "SELECT * FROM chat WHERE list_id IN ($chat_list2) and checked=0";
          $stm = $pdo->prepare($sql);
          // $stm->bindValue(':id',$id,PDO::PARAM_STR);
          $stm->execute();
          $result=$stm->fetchAll(PDO::FETCH_ASSOC);
          echo "<h2>この商品に「チャット」が届きました。</h2>";
          echo '<table class="table table-striped">';
          echo '<thead><tr>';
          echo '<th>','時間','</th>';
          echo '<th>','コメント内容','</th>';
          echo '<th>','画像','</th>';
          echo '<th>','既読にする','</th>';
          echo '</tr></thead>';
          echo '<tbody>';
          foreach($result as $row){
              echo '<tr>';
              echo '<td>',$row['created_at'],'</td>';
              echo '<td>',$row['text'],'</td>';
              echo "<td><a href=loan.php?id={$row["list_id"]}>",'<img height="100" width="100" src="image.php?id=',$row['list_id'],'"></a></td>';
              echo '<td><input id="check" type="checkbox" name="#" class="big" ></td>';
              echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
      }
      ?>
      
      <style>
input.big {
	transform: scale(2.0);
}
</style>
    </div>
    <!--/メイン-->

    <!--サイド-->
    <aside id="sidebar">
      <section id="side_banner">
        <h2>関連リンク</h2>
        <ul>
        <li><a href="notice.php"><img src="images/kanban.gif"></a></li>
        <li><a href="keijiban.php"><img src="images/keijiban.png" style="width:90%;"></a></li>
          <li><a href="../phpmyadmin" target="_blank"><img src="images/banner01.jpg" alt="ブルームブログ"></a></li>
          <div class="block-download">
					<p>アプリのダウンロードはコチラ！</p>
					<a href="https://apps.apple.com/jp/app/final-fantasy-x-x-2-hd%E3%83%AA%E3%83%9E%E3%82%B9%E3%82%BF%E3%83%BC/id1297115524" onclick="gtag('event','click', {'event_category': 'download','event_label': 'from-fv-to-appstore','value': '1'});gtag_report_conversion('https://itunes.apple.com/jp/app/%E3%83%95%E3%83%AA%E3%83%9E%E3%81%A7%E3%83%AC%E3%83%B3%E3%82%BF%E3%83%AB-%E3%82%AF%E3%82%AA%E3%83%83%E3%82%BF-%E8%B2%B8%E3%81%97%E5%80%9F%E3%82%8A%E3%81%AE%E3%83%95%E3%83%AA%E3%83%9E%E3%82%A2%E3%83%97%E3%83%AA/id1288431440?l=en&mt=8');" class="btn-download"target="_blank">
						<img src="https://quotta.net/wp-content/themes/quotta_2019/assets/img/common/btn_apple.png" alt="アップルストアでダウンロード" loading="lazy">
					</a>
				</div>
        </ul>
      </section>

    </aside>
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
</body>
</html>