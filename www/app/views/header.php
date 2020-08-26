<?php

    use app\common\DI;

    $mainActive = (DI::router()->getCurrentUri() === "/") ? "active" : "";

?>

<header class="header">
    <ul class="navbar">
        <li class="bottom_line <? echo $mainActive ?>"><a href="/">Главная</a></li>
    </ul>
    <ul class="navbar navbar-right clearfix">
        <li class="bottom_line"><a href="https://github.com/anilibria">GitHub</a></li>
        <li class="bottom_line"><a href="https://github.com/anilibria/docs">API</a></li>
    </ul>
</header>

<div class="divider"></div>
