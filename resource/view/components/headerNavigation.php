<div>
    <div class="grid grid-cols-4 p-3 items-center ">
        <a href="<?= $route ? $route : "/" ?>" class=" text-start col-span-1"><img src="/storage/images/arrowLeft.svg" alt=""></a>
        <div class="col-span-2 text-center font-semibold text-xl  capitalize"><?= $title ?? null ?></div>
        <?php if ($showMenuButton ?? false): ?>
            <p class="col-span-1 text-end">Menu button</p>
        <?php endif; ?>
    </div>
</div>