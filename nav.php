<?php 
    session_start();
    $adminSession = false; 
    if(isset($_SESSION['admin']))
    {
        $adminSession = true;
    }
?>
<nav class="flex justify-between h-20 items-center bg-white fixed z-30 top-0 left-0 w-full px-10 md:px-8 lg:px-20 shadow-sm">
    <!-- logoArea -->
    <div class="w-48">
        <img class="" src="Img\Logo\logo-light.svg" alt="" draggable="false" />
    </div>
    <!-- tabArea -->
    <div id="navTabs" class="flex text-center white md:bg-transparent z-0 md:z-10 absolute top-16 duration-500 left-[-100vw] md:static w-72 h-screen md:h-auto bg-white md:w-auto flex-col md:flex-row md:gap-[4vw] gap-[8vw] py-[2vw] md:py-0 font-poppins font-medium text-base lg:text-lg select-none shadow-2xl md:shadow-none">
        <a href="index.php">
            <div class="hover:underline underline-offset-4 leading-[3rem]">Home</div>
        </a>
        <a href="allTeachers.php">
            <div class="hover:underline underline-offset-4 leading-[3rem]">Teachers</div>
        </a>
        <a href="allInstitutes.php">
            <div class="hover:underline underline-offset-4 leading-[3rem]">Institutes</div>
        </a>
        <a href="index.php#faq-section">
            <div class="hover:underline underline-offset-4 leading-[3rem]">FAQs</div>
        </a>
        <a class="mx-auto md:mx-0" href="<?php echo (!$adminSession)?"#contact-section":"logout.php"; ?>">
            <div class="bg-[#3461FF] h-12 w-32 leading-[3rem] text-white rounded-full">
                <?php echo (!$adminSession)?"Book a call":"Logout"; ?>
            </div>
        </a>
    </div>
    <div class="md:hidden">
        <i class="fa-solid fa-bars text-lg cursor-pointer" onclick="menuToggleBtn(this)"></i>
    </div>
</nav>