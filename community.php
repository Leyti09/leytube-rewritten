<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>SubRocks - Community</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/static/css/new/www-core.css">
        <style>
            .channel-box-top {
                background: #666;
                color: white;
                padding: 5px;
            }

            .sub_button {
                position: relative;
                bottom: 2px;
            }

            .channel-box-description {
                background: #e6e6e6;
                border: 1px solid #666;
                color: #666;
                padding: 5px;
            }

            .channel-box-no-bg {
                border: 1px solid #666;
                color: black;
                padding: 5px;
            }

            .channel-pfp {
                height: 88px;
                width: 88px;
                border-color: #666;
                border: 3px double #999;
            }

            .channel-stats {
                display: inline-block;
                vertical-align: top;
            }

            .channel-stats-minor {
                font-size: 11px;
            }
            
            .comment-pfp {
                width: 52px;
                height: 52px;
                border-color: #666;
                display: inline-block;
                border: 3px double #999;
            }
        </style>
    </head>
    <body>
        <div class="www-core-container">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/static/module/header.php"); ?>
            <div class="channel-box-profle">
                <div class="channel-box-top" style="height: 12px;">
                    <h3 style="display: inline-block;">Forums</h3>
                </div>
                <div class="channel-box-no-bg">
                    <?php
                        $stmt = $conn->prepare("SELECT * FROM forum_category ORDER BY id DESC");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while($category = $result->fetch_assoc()) {
                            $latest_forum_post = $_user_fetch_utils->fetch_latest_forum_post($category['title']);
                    ?>
                        <hr class="thin-line">
                        <b><a href="/forum/category?c=<?php echo urlencode($category['title']); ?>"><?php echo htmlspecialchars($category['title']); ?></a></b>
                        <span style="font-size: 11px; color: gray;">(<?php echo $_video_fetch_utils->get_category_threads($category['title']); ?> threads)</span>
                        <br>
                        <?php echo htmlspecialchars($category['description']); ?><br><br>
                        <a href="/forum/thread?v=<?php echo $latest_forum_post['id']; ?>"><h4><?php echo htmlspecialchars($latest_forum_post['title']); ?></h4></a>
                        <div class="comment-watch">
                            <img class="comment-pfp" src="/dynamic/pfp/<?php echo $_user_fetch_utils->fetch_user_pfp($latest_forum_post['author']); ?>">
                            <span  style="display: inline-block; vertical-align: top;width: 575px;">
                                <span class="comment-info" style="display: inline-block;">
                                    <b><a style="text-decoration: none;" href="/user/<?php echo htmlspecialchars($latest_forum_post['author']); ?>">
                                        <?php echo htmlspecialchars($latest_forum_post['author']); ?> 
                                    </a></b> 
                                    <span style="color: #666;">(<?php echo $_video_fetch_utils->time_elapsed_string($latest_forum_post['date']); ?>)</span>
                                </span><br>
                                <span class="comment-text" style="display: inline-block;">
                                    <?php echo $_video_fetch_utils->parseTextDescription($latest_forum_post['contents']); ?>
                                </span>
                            </span>

                        </div>
                    <?php } ?>
                </div>
            </div><br>
        </div>
        <div class="www-core-container">
        <?php require($_SERVER['DOCUMENT_ROOT'] . "/static/module/footer.php"); ?>
        </div>

    </body>
</html>