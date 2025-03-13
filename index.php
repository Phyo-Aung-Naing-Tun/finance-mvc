<?php

use Root\App\Services\Route\Route;

include __DIR__ . "/root/bootstrap.php";

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/resource/css/output.css" rel="stylesheet">
</head>

<body>
    <?php Route::dispatch() ?>
</body>

</html>