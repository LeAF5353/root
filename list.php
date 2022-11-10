<?php
session_start(); 
require_once('../lib/util.php');
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
}
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
				<div><a href="all.php"><img src="images/home.png"  style="width:70px" /><span>HOME　　　</span></a></div>
				<div><a href="add_db.php"><img src="images/register.png"  style="width:70px" /><span>商品登録　　</span></span></a></div>
				<div><a href="search_sp.php"><img src="images/search.png"  style="width:70px" /><span>検索　　　　</span></span></a></div>
				<div><a href="list.php"><img src="https://cdn08.net/dqwalk/data/img0/img2_5.png?6e1"  style="width:70px" /><span>一覧　　　　</span></a></div>
				<div><a href="mypage.php"><img src="https://cdn08.net/dqwalk/data/img0/img93_5.png?87b"  style="width:70px" /><span>マイページ　</span></span></a></div>
				<div><a href="contact.php"><img src="images/contact.png"  style="width:70px" /><span>お問い合わせ</span></a></div>
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