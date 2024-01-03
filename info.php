<?php include("path.php");
include (ROOT_PATH . "/app/controllers/posts.php");

if (isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]);
}

$posts = getPublishedPosts();
$topics = selectAll('topics');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu - AnimeWiki</title>
    <link rel="stylesheet" href="assets/css/single.css">
    <link rel="stylesheet" href="assets/css/info.css">
    <link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/54e93fea1b.js" crossorigin="anonymous"></script>
</head>
<body>
    <!--Header-->
    <?php include(ROOT_PATH . "/app/include/header.php"); ?>

    <!--Body page-->
    <div class="page-wrapper">

        <!-- Nội dung page -->

        <div class="content clearfix">
            <div class="main-content single">
            <h1 class="logo-text"><span>Anime</span>Wiki</h1>
                <div class="post-content">
                    <p>&nbsp; &nbsp; Manh nha xuất hiện từ đầu thế kỷ XX, bắt đầu phát triển mạnh mẽ từ thập niên 1950, trải qua nhiều thập kỷ, anime giờ đây đã vươn ra khỏi Nhật Bản, trở thành một hiện tượng phổ biến toàn cầu. Vậy điều gì khiến anime trở nên phổ biến như vậy? Sức hút của nó là gì?<br><br>

&nbsp; &nbsp; “Anime” thật ra cũng chỉ là cách người Nhật dùng để phát âm chữ “animation” tức là phim hoạt hình. Như vậy anime có thể hiểu là phim hoạt hình Nhật. Ấy nhưng bản thân anime lại thay đổi hoàn toàn khái niệm “phim hoạt hình”.

Ở nhiều nước phương Tây, Mỹ và ngay cả Việt Nam, khi nhắc đến “phim hoạt hình” chúng ta đều nghĩ ngay đó là một sản phẩm giải trí dành cho trẻ em. Thế nhưng đối tượng khách hàng mà anime nhắm đến lại có phạm vi vô cùng rộng lớn.<br><br>

&nbsp; &nbsp; Thế giới anime đa dạng, phong phú dành cho mọi lứa tuổi,

không lệ thuộc vào quy tắc “dành cho trẻ em”, chủ đề anime truyền tải trở nên rộng lớn hơn và mang nhiều vấn đề trưởng thành hơn. Bản thân nội dung của anime cũng vì thế mà trở nên phức tạp. Sự phức tạp này hoàn toàn trái ngược với yêu cầu “đơn giản dễ hiểu” ở phim hoạt hình thông thường. Và cũng vì vậy mà tuyến nhân vật thường có sự thay đổi theo sự phát triển của cốt truyện.

Điểm này vốn không giống như hầu hết các phim hoạt hình, nơi nhân vật một khi đã được thiết lập cho một tính cách, chúng ta sẽ hiếm khi thấy sự phát triển nhân vật. Ở phim hoạt hình ngày trước, đây là một điều rất hiếm thấy.

Những sự khác biệt ấy thay đổi khái niệm phim hoạt hình vốn có. Hay đúng hơn, mọi người dùng chính từ “anime” để phân biệt hẳn với phim hoạt hình, để khi nhắc đến anime mọi người đều nghĩ đến một khái niệm phim hoạt hình khác hẳn.<br> <br>
&nbsp; &nbsp; Anime Wiki là 1 “bách khoa toàn thư mở” về anime, là kết quả của sự cộng tác của chính những fan hâm mộ từ khắp nơi trên thế giới. Website này có tính chất “wiki”, có nghĩa là mọi người đều có thể viết bài, sửa đổi bài ở bất cứ trang nào.
Đây là nơi dành cho những người hâm mộ anime để họ có thể cùng nhau thảo luận, chia sẻ cho nhau những kiến thức hiểu biết về anime, 1 cộng đồng người hâm mộ đông đảo trên khắp thế giới đến để chia sẻ tình yêu và niềm đam mê của họ với anime.<br><br>
&nbsp; &nbsp; &nbsp; - AnimeWiki -
</p>
                </div>
            </div>

            <!--Sidebar-->
            <div class="sidebar single">
                <div class="section search">
                    <h6 class="section-title">Tìm kiếm</h6>
                    <form action="index.php" method="post">
                        <input type="text" name="search-form" class="text-input" placeholder="Tìm kiếm...">
                    </form>
                </div>
                <div class="section recommend-post">
                    <h6 class="section-title">Có thể bạn muốn biết</h6>
                    <?php foreach ($posts as $post): ?>
                    <div class="recommend">
                        <img src="<?php echo BASE_URL . '/assets/images/' . $post['image'] ?>" alt="" class="recommend-image">
                        <div class="recommend-info">
                            <h4><a href="single.php?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ?></a></h4>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <div class="section topics">
                    <h6 class="section-title">Chủ đề</h6>
                    <ul>
                        <?php foreach ($topics as $key => $topic): ?>
                            <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>    

    <?php include(ROOT_PATH . "/app/include/footer.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/script.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Philosopher&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">
</body>
</html>