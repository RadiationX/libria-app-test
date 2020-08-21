<?php

function getSlogan() {
    $slogans = [
        'больше приложений богу приложений',
        'приложение для чайника coming soon',
        'смотри аниме почти на любом девайсе'
    ];

    return $slogans[array_rand( $slogans )];
}
?>

<div class='logo'>
    <div class='logo_img_shape'>
        <img src='res/icons/ic_anilibria_white.svg' alt='' class='logo_img'>
    </div>
    <span class='logo_name'>AniLibria</span>
    <span class='logo_slogan'>
        <?php echo getSlogan() ?>
    </span>
</div>
