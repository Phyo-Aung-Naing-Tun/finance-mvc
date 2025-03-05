<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
</head>

<body>
    <div>
        <h1>Error Page</h1>
        <h1><?= $status ?></h1>
        <?php if (!empty($errorMessages)): ?>
            <div>
                <?php foreach ($errorMessages as $message): ?>
                    <p><strong><?= htmlspecialchars($message) ?></strong></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>