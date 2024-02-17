<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php
  if(!isset($_SESSION['siteusername']))
  header("Location: /sign_in");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SubRocks - Video Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/static/css/new/www-core.css">
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                text-align: left;
                padding: 3px;
            }

            th {
                border: 1px solid #dddddd;
                background: rgb(230,230,230);
                background: -moz-linear-gradient(0deg, rgba(230,230,230,1) 0%, rgba(255,255,255,1) 100%, rgba(255,255,255,1) 100%);
                background: -webkit-linear-gradient(0deg, rgba(230,230,230,1) 0%, rgba(255,255,255,1) 100%, rgba(255,255,255,1) 100%);
                background: linear-gradient(0deg, rgba(230,230,230,1) 0%, rgba(255,255,255,1) 100%, rgba(255,255,255,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#e6e6e6",endColorstr="#ffffff",GradientType=1); 
            }

            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
        </style>
    </head>
    <body>
        <div class="www-core-container">
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/static/module/header.php"); ?>
            <?php require($_SERVER['DOCUMENT_ROOT'] . "/static/module/module_sidebar.php"); ?>
            <div class="manage-top">
                <div style="width: 100%;border-top: 1px solid #CACACA;border-bottom: 1px solid #CACACA;">
                    <h3 style="margin-top: 0px;padding: 16px;">Favorites</h3>
                </div>
            </div>
                <?php
                    $search = $_SESSION['siteusername'];
                    $stmt56 = $conn->prepare("SELECT * FROM videos WHERE author = ? AND visibility = 'v'");
                    $stmt56->bind_param("s", $search);
                    $stmt56->execute();
                    $result854 = $stmt56->get_result();
                    $result56 = $result854->num_rows;

                    $results_per_page = 12;

                    $stmt = $conn->prepare("SELECT * FROM videos WHERE author = ? ORDER BY id DESC");
                    $stmt->bind_param("s", $_SESSION['siteusername']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $results = $result->num_rows;

                    $number_of_result = $result->num_rows;
                    $number_of_page = ceil ($number_of_result / $results_per_page);  

                    if (!isset ($_GET['page']) ) {  
                        $page = 1;  
                    } else {  
                        $page = (int)$_GET['page'];  
                    }  

                    $page_first_result = ($page - 1) * $results_per_page;  

                    $stmt->close();
                ?>
            <div class="manage-base">
                <table style="width: 100%;">
                    <tr>
                        <!-- <th style="margin: 5px; width: 5%;"></th> -->
                        <th style="width: 80%;"></th>
                    </tr>
                    <?php
                        $stmt = $conn->prepare("SELECT * FROM favorite_video WHERE sender = ? ORDER BY id DESC LIMIT ?, ?");
                        $stmt->bind_param("sss", $search, $page_first_result, $results_per_page);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while($favorite = $result->fetch_assoc()) {     
                            if($_video_fetch_utils->video_exists($favorite['reciever'])) {
                                $video = $_video_fetch_utils->fetch_video_rid($favorite['reciever']);                   
                    ?> 
                    <tr style="margin-top: 5px;" id="videoslist">
                        <td class="video-manager-left">
                            <span style="display: inline-block;float: right;"></span>
                            <div class="video-thumbnail r120" 
                            style="background-image: url('/dynamic/thumbs/<?php echo $video['thumbnail']; ?>'), url('/dynamic/thumbs/default.png');">
                            <div class="video-timestamp">
                                <span>
                                <?php echo $_video_fetch_utils->timestamp($video['duration']); ?>
                                </span>
                            </div>
                        </div>
                            <span class="video-manager-info">
                            <a class="video-manager-title" href="watch?v=<?php echo $video['rid']; ?>"><?php echo htmlspecialchars($video['title']); ?></a>
                            <br>
                            <span style="color: #919191;"><?php echo date("F d, Y g:sA", strtotime($video['publish'])); ?></span><br>
                            <a href="/get/unfavorite?v=<?php echo $video['rid']; ?>">
                                <button type="button" class=" www-button www-button-grey" role="button">
                                    Unfavorite
                                </button>
                            </a>
                            <br>         
                        </td>
                    </tr>
                    <?php } 
                    } ?>
                </table> <br>
                <?php for($page = 1; $page<= $number_of_page; $page++) { ?>
                    <a href="video_manager?page=<?php echo $page ?>">
                        <button class="www-button www-button-grey"><?php echo $page; ?></button>
                    </a>
                <?php } ?>   
            </div>
        </div>
        <div class="www-core-container">
        <?php require($_SERVER['DOCUMENT_ROOT'] . "/static/module/footer.php"); ?>
        </div>

    </body>
</html>