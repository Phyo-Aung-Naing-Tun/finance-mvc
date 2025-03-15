<div>

    <?php component("headerNavigation", ["title" => "sign up", "showMenuButton" => false]) ?>
    <div class=" p-4 mt-[20%] space-y-[28px]">
        <form action="" method="post" class=" space-y-[30px] ">
            <input class=" w-full border border-gray-300 h-[54px] ps-3 rounded-xl" type="name" placeholder="Name">
            <input class=" w-full border border-gray-300 h-[54px] ps-3 rounded-xl" type="email" placeholder="Email">
            <input class=" w-full border border-gray-300 h-[54px] ps-3 rounded-xl" type="password" placeholder="Password">
            <div class=" flex items-center space-x-3">
                <input type="checkbox" class=" accent-purple-600 flex-1 min-w-5 min-h-5">
                <div class="">
                    <span class=" font-semibold">By signing up, you agree to the</span>
                    <a class=" text-primary" href="#">Terms of Service and Privacy Policy</a>
                </div>
            </div>
            <div class=" space-y-3">
                <button class=" w-full h-[54px] tracking-wide font-bold bg-primary rounded-xl text-white text-lg">Sign Up</button>
                <div class=" text-gray-400 text-center font-bold tracking-wide">Or with</div>
                <button class=" flex justify-center items-center gap-3 w-full h-[54px] tracking-wide font-bold border border-gray-300 rounded-xl text-gray text-lg">
                    <img src="/storage/images/google.svg" alt="">
                    <span> Sign Up with Google</span>
                </button>
            </div>
        </form>
        <div class="tracking-wide flex justify-center">
            <span class=" me-2 ">Already have an account? </span>
            <a class="text-primary font-semibold" href="/login">Login </a>
        </div>
    </div>
</div>