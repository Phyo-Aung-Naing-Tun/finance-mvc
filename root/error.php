<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
</head>

<body>
    <div class=" mt-10 space-y-2 p-3 w-full break-words">
        <h1 class=" text-center text-xl font-bold tracking-wide">Error Page</h1>
        <h1 class=" text-center text-red-600 font-bold text-3xl tracking-wide"><?= $status ?></h1>
        <?php if (!empty($errorMessages)): ?>
            <div class=" text-lg mb-3">
                <?php foreach ($errorMessages as $message): ?>
                    <p><strong><?= htmlspecialchars($message) ?></strong></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>