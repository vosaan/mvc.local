<?php
/* Подключение файлов с базовыми классами Model, View и Controller */
require_once('core/model.php');
require_once('core/view.php');
require_once('core/controller.php');

/* Подключение маршретизатора и его вызов */
require_once('core/route.php');
Route::start();
?>
