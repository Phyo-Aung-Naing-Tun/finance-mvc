<div>
    <?php component("headerNavigation", ["title" => "Login", "showMenuButton" => false]) ?>
    <div class=" p-4 mt-[20%] space-y-[28px]">
        <form action="" method="post" class=" space-y-[30px] ">
            <input class=" w-full border border-gray-300 h-[54px] ps-3 rounded-xl" type="email" placeholder="Email">
            <input class=" w-full border border-gray-300 h-[54px] ps-3 rounded-xl" type="password" placeholder="Password">
            <button class=" w-full h-[54px] tracking-wide font-bold bg-primary rounded-xl text-white text-lg">Login</button>
        </form>
        <a href="/forgot_password" class=" tracking-wide text-lg font-bold text-primary text-center w-full inline-block">Forgot Password?</a>
        <div class="tracking-wide flex justify-center">
            <span class=" me-2 ">Don’t have an account yet? </span>
            <a class="text-primary font-semibold" href="/register">Sign Up</a>
        </div>
    </div>
</div>