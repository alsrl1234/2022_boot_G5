<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    define('G5_IS_COMMUNITY_PAGE', true);
    include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
    return;
}
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<!-- 상단 시작 { -->
<nav class="navbar navbar-expand-sm navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">
            <img src="<? echo G5_THEME_IMG_URL ?>/m_logo.svg" alt="" style="width:180px">
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#" >Link</a>
                </li>

                <?php
                $menu_datas = get_menu_db(0, true);
                $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
                $i = 0;
                foreach( $menu_datas as $row ){
                    if( empty($row) ) continue;
                    $add_class = (isset($row['sub']) && $row['sub']) ? 'gnb_al_li_plus' : '';
                ?>
                <li class="nav-item>
                    <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" ><?php echo $row['me_name'] ?></a>
                    
                </li>
                <?php
                $i++;
                }   //end foreach $row

               ?>
               
            </ul>
        </div>
  </div>
</nav>





<nav id="gnb">
        <h2>메인메뉴</h2>
        <div class="gnb_wrap">
            <ul id="gnb_1dul">
                
                <?php
				$menu_datas = get_menu_db(0, true);
				$gnb_zindex = 999; // gnb_1dli z-index 값 설정용
                $i = 0;
                foreach( $menu_datas as $row ){
                    if( empty($row) ) continue;
                    $add_class = (isset($row['sub']) && $row['sub']) ? 'gnb_al_li_plus' : '';
                ?>
                <li class="gnb_1dli <?php echo $add_class; ?>" style="z-index:<?php echo $gnb_zindex--; ?>">
                    <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                    <?php
                    $k = 0;
                    foreach( (array) $row['sub'] as $row2 ){

                        if( empty($row2) ) continue; 

                        if($k == 0)
                            echo '<span class="bg">하위분류</span><div class="gnb_2dul"><ul class="gnb_2dul_box">'.PHP_EOL;
                    ?>
                        <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
                    <?php
                    $k++;
                    }   //end foreach $row2

                    if($k > 0)
                        echo '</ul></div>'.PHP_EOL;
                    ?>
                </li>
                <?php
                $i++;
                }   //end foreach $row

                if ($i == 0) {  ?>
                    <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                <?php } ?>
            </ul>
            <div id="gnb_all">
                <h2>전체메뉴</h2>
                <ul class="gnb_al_ul">
                    <?php
                    
                    $i = 0;
                    foreach( $menu_datas as $row ){
                    ?>
                    <li class="gnb_al_li">
                        <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_al_a"><?php echo $row['me_name'] ?></a>
                        <?php
                        $k = 0;
                        foreach( (array) $row['sub'] as $row2 ){
                            if($k == 0)
                                echo '<ul>'.PHP_EOL;
                        ?>
                            <li><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><?php echo $row2['me_name'] ?></a></li>
                        <?php
                        $k++;
                        }   //end foreach $row2

                        if($k > 0)
                            echo '</ul>'.PHP_EOL;
                        ?>
                    </li>
                    <?php
                    $i++;
                    }   //end foreach $row

                    if ($i == 0) {  ?>
                        <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                    <?php } ?>
                </ul>
                <button type="button" class="gnb_close_btn"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div id="gnb_all_bg"></div>
        </div>
    </nav>

<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <div id="container_wr">
   
    <div id="container">
        <?php if (!defined("_INDEX_")) { ?><h2 id="container_title"><span title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></span></h2><?php }