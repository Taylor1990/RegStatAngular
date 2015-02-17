<?php
// получаем логин и отправляем случайное слово 
    require_once 'protected/Tea.php';
    if(isset($_GET['login'])){
        $login = mysql_real_escape_string(htmlspecialchars(strip_tags($_GET['login'])));
        
    }

