<div>
    <?php component("headerNavigation", ["title" => "Forgot Password", "showMenuButton" => false, "route" => "/login"]) ?>
    <div class=" p-4 mt-[20%] space-y-[28px]">
        <div class=" text-xl font-bold tracking-wide space-y-3">
            <p>Don’t worry. </p>
            <p>Enter your email and we’ll </p>
            <p>send you a link to reset your </p>
            <p>password. </p>
        </div>
        <form action="" method="post" class=" space-y-[30px] ">
            <input class=" w-full border border-gray-300 h-[54px] ps-3 rounded-xl" type="email" placeholder="Email">
            <button class=" w-full h-[54px] tracking-wide font-bold bg-primary rounded-xl text-white text-lg">Continue</button>
        </form>
    </div>
</div>