<?php
/*
Single Post Template: 图片
Description: 只有图片的文章，每页显示两张
*/
?>
<?php
    if(!$post){
      $post=get_post(get_the_ID());
    }
    $videos=get_all_video_uri($post->post_content);
    $video_href = $videos[0];
  ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>大竹县三务公开</title>

    <link rel="stylesheet" type="text/css" href="../css/header.css">
    

    <script type="text/javascript" src="../js/single_normal.js"></script>

    <style type="text/css">
      
      p{
        font-size: 3rem;
        text-align: center;
      }
    </style>
</head>
<body>
  <p>不支持视屏播放！！！</p>
  
</div>

<script type="text/javascript">
    var  $mp = new MediaPlayer();
    var nativePlayerInstanceID=null;
    $mp.setOutputSPDIFMode(1);
    $mp.setVolume(100);
    $mp.setVideoDisplayMode(1);              
    $mp.setMediaSource(<?php echo $video_href; ?>);
    $mp.play();  
    $mp.refresh(); 
    window.onunload = function(){
        $mp.setPauseMode(0);
        $mp.stop();
        $mp.unbindPlayerInstance(nativePlayerInstanceID);

    }
  </script>
</body>
</html>