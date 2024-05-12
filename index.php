<?php
    include("connection.php");
    include("head.php");  //html header
    include("nav.php"); //navigation bar
?>


<!-- section-0 -->
<?php
    $count = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM `carousel-banner-count`"))['count'];
    $carouselQuery="SELECT id, bannerPath FROM `banner-image-table` WHERE bannerPath IS NOT NULL AND bannerActivity = 1 ORDER BY rand() LIMIT $count";
    $carouselResult=mysqli_query($connection,$carouselQuery);
?>
<main class="mt-20  overflow-hidden">
    <wrapper class="bannerCarousel duration-500 flex">
        <?php
            while($path=mysqli_fetch_array($carouselResult))
            {
        ?>
                <a href="<?php echo 'teacherProfile.php?id='.$path['id'] ?>">
                    <img style="min-width: 100vw;" src="<?php echo $path['bannerPath'];?>" alt="Banner Image">
                </a>
        <?php } ?>
    </wrapper>
</main>
<script src="./js/carousel.js"></script>


<!-- section-1 -->
<main class="bg-[#f1f1f1] w-auto lg:h-auto flex justify-evenly relative h-screen">
    <!-- left side -->
    <section class="md:pl-20 lg:w-1/2 py-28 flex flex-col gap-8 justify-center z-20 lg:bg-transparent bg-[#f1f1f1]/90 w-screen">
        <!-- main heading -->
        <heading class="font-semibold font-sans lg:text-8xl md:text-7xl text-6xl w-auto text-left select-none">Match</br> Learn And </br>Soar To Success</heading>
        <!-- sub heading part -->
        <subHeading class="text-xl text-black/50 select-none">"Find your perfect teacher and institute today"</subHeading>
        <!-- lets talk area -->
        <contactArea>
            <form class="flex gap-4 md:flex-row flex-col">
                <input type="text" name="" id="" placeholder="Enter your email" class="h-12 md:w-1/2 rounded-full px-4  outline-none border-black/30 border-[1px] placeholder:text-black/50 w-full">
                <input type="submit" class="bg-[#3461FF] h-12 md:w-32 rounded-full text-white cursor-pointer w-full" value="Lets Talk">
            </form>
        </contactArea>
    </section>
    <!-- right side-->
    <section class="lg:w-1/2 w-screen lg:relative absolute top-0 left-0 right-0 flex flex-row items-center justify-end mx-auto z-10 lg:z-20">
        <img src="./Img/first-page-photos/heroImg.svg" class="lg:h-4/5 lg:w-4/5 h-screen w-auto mx-auto lg:mx-0 z-10 lg:z-20" alt="" draggable="false">
    </section>
</main>


<!-- section-2 -->
<main class="relative py-20 flex flex-col gap-10">
    <!-- heading and controls -->
    <section class="font-semibold text-5xl w-[90%] h-auto mx-auto flex justify-between">
        <heading class="">Our Teachers</heading>
        <!-- previous and next buttons -->
        <section class="md:flex justify-evenly hidden">
            <img id="left" class="tArrow mx-2 cursor-pointer" src="./Img/ui-buttons/leftArrow.svg" alt="">
            <img id="right" class="tArrow mx-2 cursor-pointer" src="./Img/ui-buttons/rightArrow.svg" alt="">
        </section>
    </section>
    <!-- cards -->
    <section class="carousel-cu mx-auto grid grid-flow-col overflow-x-hidden h-full py-8 px-2 gap-8 scroll-smooth select-none" style="width: calc(90% - 0.5rem);">
        <!-- teacher card generator -->
        <?php
            $teacherQuery = "SELECT * FROM `teacher-table` JOIN `profile-image-table` ON `teacher-table`.`id` = `profile-image-table`.`id` WHERE `activity` = '1' AND `role` = 'Teacher' ORDER BY rand() LIMIT 5";
            $res = mysqli_query($connection,$teacherQuery);
            
            while($rowarr = mysqli_fetch_array($res))
            {
            
                $randTeacherId = $rowarr['id'];
                $class="SELECT * FROM `teacher-cls-subj`
                        INNER JOIN `class-table` ON `class-table`.`id` = `teacher-cls-subj`.`classId`
                        INNER JOIN `subject-table` ON `subject-table`.`id`=`teacher-cls-subj`.`subjectId`
                        WHERE `teacherId` = '$randTeacherId'
                        ORDER BY rand()  LIMIT 1";
                $classRes = mysqli_query($connection,$class);
                $classarr = mysqli_fetch_array($classRes);
        ?>
                <section class=" relative w-96  rounded-2xl shadow-lg py-8 flex flex-col gap-4">
                    <!-- profile image area with absolute property -->
                    <div class="px-4 h-20 w-full p-1 bg-white rounded-full flex ">
                        <img class=" w-[4.5rem] h-[4.5rem] rounded-full" src="<?php echo $rowarr['profileImagePath']; ?>" alt="" draggable="false">
                        <span>
                            <heading class="capitalize block px-4 font-semibold text-2xl"><?php echo $rowarr['firstName']." ".$rowarr['lastName'];?></heading>
                            <!------------------- subject Names -------------------->
                            <h1 class="px-4 text-black/60 mt-2">
                                <?php 
                                    if($classarr)
                                    {
                                        echo $classarr['subjectName']; 
                                    }
                                ?>
                            </h1>
                        </span>
                    </div>
                    <!-- Teacher Name -->
                    <!--------------- Tags area ---------------------------->
                    <div class="px-4 flex gap-2 mt-3">
                        <!-- tag 1 is for experience -->
                        <?php 
                            if($rowarr['experience']!="")
                            {
                        ?>
                                <tag class="border-black/70 border-2 px-4 py-1 select-none hover:scale-110 duration-300 rounded-full font-medium text-sm text-black/70"><?php echo $rowarr['experience'];?> Years</tag>
                        <!-- tag 2 is for class -->
                        <?php } ?>
                        <?php
                            if($classarr)
                            {
                        ?>
                                <tag class="border-black/70 border-2 px-4 py-1 select-none hover:scale-110 duration-300 rounded-full font-medium text-sm text-black/70"><?php echo $classarr['className']; ?></tag>
                        <?php } ?>
                        <!-- tag 3 is for mode -->
                        <tag class="border-black/70 border-2 px-4 py-1 select-none hover:scale-110 duration-300 rounded-full font-medium text-sm text-black/70"><?php echo $rowarr['mode'];?></tag>

                    </div>
                    <!---------------------- connect button --------------------->
                    <a href="teacherProfile.php?id=<?php echo $randTeacherId;?>" class=""><button class="mx-[5%] w-[90%] bg-[#3461FF] h-12  rounded-full text-white text-lg ">Connect</button></a>
                </section>
        <?php } ?>
        <!-- explore more card -->
        <section class=" relative w-96  rounded-2xl shadow-lg py-8">
            <!-- profile image area with absolute property -->
            <div class="px-4 h-20 w-full p-1 bg-white rounded-full flex ">
                <span class="w-full">
                    <heading class="w-full text-center capitalize font-semibold text-2xl block">Need more?</heading>
                    <!------------------- subject Names -------------------->
                    <h1 class=" block text-center w-full capitalize px-4 text-black/60 mt-2">click the button below!</h1>
                </span>
            </div>
            <!-- Explore More -->
            <a href="allTeachers.php" class=""><button class="mx-[5%] w-[90%] bg-[#3461FF] h-12 mt-8 rounded-full text-white text-lg ">Explore</button></a>
        </section>
    </section>
</main>


<!-- section-3 -->
<main class="flex justify-center items-center bg-[#f1f1f1] py-20">
    <section class="w-4/5 bg-[#3461FF]  mx-auto h-80 rounded-3xl relative overflow-hidden">
        <wrapper class="flex justify-evenly lg:flex-row  flex-col  h-full w-full">
            <!-- left section text -->
            <div class="z-20 lg:w-1/2 w-full text-center lg:text-6xl text-4xl sm:text-5xl font-semibold lg:leading-[5rem] leading-[2rem] sm:leading-[3rem] lg:py-20 py-0 flex flex-col md:max-lg:flex-row md:max-lg:justify-center  lg:gap-0 gap-4 text-white">
                <div>Elevate Your</div>
                <div>Skills Today!</div>
            </div>
            <!-- right section -->
            <div class="lg:w-1/2 w-full px-12  text-base sm:text-xl lg:py-28 z-20 text-white">
                Unlock exciting opportinuties of your carrer. Next step - Register as a teacher today.
                <br>
                <a href="index.php#contact-section"><button class="text-black bg-white md:w-32 w-full h-10 mt-8 rounded-full text-base font-medium">Contact Now</button></a>
            </div>
        </wrapper>
        <!-- background ball -->
        <div class=" z-10 h-96 w-96 absolute top-0 bottom-0 left-72 my-auto  rounded-full bg-gradient-to-l from[#3461FF] via-[#3461FF] to-[#8399E9]"></div>
        <div class="z-0 h-96 w-96 absolute top-0 bottom-0 left-24 my-auto  rounded-full bg-gradient-to-l from-[#3461FF]  to-[#8399E9]"></div>
        <!-- background ball -->
        <div class="h-96 w-96 absolute top-0 bottom-0 -left-24 my-auto  rounded-full bg-gradient-to-l from-[#3461FF] to-[#8399E9]"></div>
        <!-- background ball -->
        <div class="h-96 w-96 absolute top-0 bottom-0 -left-72 my-auto  rounded-full bg-gradient-to-l from-[#3461FF] to-[#8399E9]"></div>
    </section>
</main>


<!-- section-4 -->
<main class="relative py-20 flex flex-col gap-10">
    <!-- heading and controls -->
    <section class="font-semibold text-5xl w-[90%] h-auto mx-auto flex justify-between">
        <heading class="">Institutes</heading>
        <!-- previous and next buttons -->
        <section class="md:flex justify-evenly hidden">
            <img id="left" class="iArrow mx-2 cursor-pointer" src="./Img/ui-buttons/leftArrow.svg" alt="">
            <img id="right" class="iArrow mx-2 cursor-pointer" src="./Img/ui-buttons/rightArrow.svg" alt="">
        </section>
    </section>
    <!-- cards -->
    <section class="carousel-cu mx-auto grid grid-flow-col overflow-x-hidden h-full py-8 px-2 gap-8 scroll-smooth select-none" style="width: calc(90% - 0.5rem);">
        <!-- institute card generator -->
        <?php
            $teacherQuery = "SELECT * FROM `teacher-table` JOIN `profile-image-table` ON `teacher-table`.`id` = `profile-image-table`.`id` WHERE `activity` = '1' AND `role` = 'Institute' ORDER BY rand() LIMIT 5";
            $res = mysqli_query($connection,$teacherQuery);
            
            while($rowarr = mysqli_fetch_array($res))
            {
            
                $randTeacherId = $rowarr['id'];
                $class="SELECT * FROM `teacher-cls-subj`
                        INNER JOIN `class-table` ON `class-table`.`id` = `teacher-cls-subj`.`classId`
                        INNER JOIN `subject-table` ON `subject-table`.`id`=`teacher-cls-subj`.`subjectId`
                        WHERE `teacherId` = '$randTeacherId'
                        ORDER BY rand()  LIMIT 1";
                $classRes = mysqli_query($connection,$class);
                $classarr = mysqli_fetch_array($classRes);
        ?>
                <section class=" relative w-96  rounded-2xl shadow-lg py-8 flex flex-col gap-4">
                    <!-- profile image area with absolute property -->
                    <div class="px-4 h-20 w-full p-1 bg-white rounded-full flex ">
                        <img class=" w-[4.5rem] h-[4.5rem] rounded-full" src="<?php echo $rowarr['profileImagePath']; ?>" alt="" draggable="false">
                        <span>
                            <heading class="capitalize block px-4 font-semibold text-2xl"><?php echo $rowarr['firstName']." ".$rowarr['lastName'];?></heading>
                            <!------------------- subject Names -------------------->
                            <h1 class="px-4 text-black/60 mt-2">
                                <?php 
                                    if($classarr)
                                    {
                                        echo $classarr['subjectName']; 
                                    }
                                ?>
                            </h1>
                        </span>
                    </div>
                    <!-- Teacher Name -->
                    <!--------------- Tags area ---------------------------->
                    <div class="px-4 flex gap-2 mt-3">
                        <!-- tag 1 is for experience -->
                        <?php 
                            if($rowarr['experience']!="")
                            {
                        ?>
                                <tag class="border-black/70 border-2 px-4 py-1 select-none hover:scale-110 duration-300 rounded-full font-medium text-sm text-black/70"><?php echo $rowarr['experience'];?> Years</tag>
                        <!-- tag 2 is for class -->
                        <?php } ?>
                        <?php
                            if($classarr)
                            {
                        ?>
                                <tag class="border-black/70 border-2 px-4 py-1 select-none hover:scale-110 duration-300 rounded-full font-medium text-sm text-black/70"><?php echo $classarr['className']; ?></tag>
                        <?php } ?>
                        <!-- tag 3 is for mode -->
                        <tag class="border-black/70 border-2 px-4 py-1 select-none hover:scale-110 duration-300 rounded-full font-medium text-sm text-black/70"><?php echo $rowarr['mode'];?></tag>

                    </div>
                    <!---------------------- connect button --------------------->
                    <a href="teacherProfile.php?id=<?php echo $randTeacherId;?>" class=""><button class="mx-[5%] w-[90%] bg-[#3461FF] h-12  rounded-full text-white text-lg ">Connect</button></a>
                </section>
        <?php } ?>
        <!-- explore more card -->
        <section class=" relative w-96  rounded-2xl shadow-lg py-8">
            <!-- profile image area with absolute property -->
            <div class="px-4 h-20 w-full p-1 bg-white rounded-full flex ">
                <span class="w-full">
                    <heading class="w-full text-center capitalize font-semibold text-2xl block">Need more?</heading>
                    <!------------------- subject Names -------------------->
                    <h1 class=" block text-center w-full capitalize px-4 text-black/60 mt-2">click the button below!</h1>
                </span>
            </div>
            <!-- Explore More -->
            <a href="allInstitutes.php" class=""><button class="mx-[5%] w-[90%] bg-[#3461FF] h-12 mt-8 rounded-full text-white text-lg ">Explore</button></a>
        </section>
    </section>
</main>

<!-- section-5 -->
<main id="about-us-section" class="bg-[#f1f1f1] lg:h-[55rem] w-full py-20 overflow-hidden relative">
    <div class="absolute flex justify-evenly rounded-[8rem] bg-white lg:h-[45rem] h-[85rem] sm:max-lg:h-[65rem] lg:w-full w-[90rem] -translate-x-1/4 lg:translate-x-0 shadow-lg rotate-3"></div>
    <img class="h-28 w-28 absolute top-0 -rotate-6 left-0 " src="./Img/ui-buttons/packman.svg" alt="design image">
    <wrapper class="relative  flex lg:justify-between lg:flex-row justify-center gap-20 pt-10 flex-col items-center w-full px-[5%] lg:px-0">

        <!-- left side-->
        <section class="lg:w-45 w-full flex flex-col lg:pl-32 px-0 justify-center">
            <heading class="font-semibold lg:text-6xl text-4xl">Why Choose Us?</heading>
            <p class="lf:w-[90%] w-full text-black/50 text-justify py-4 pt-12">In our teacher matchmaking endeavor, we're dedicated to close collaboration with our clients. By understanding their goals and challenges deeply, we create tailored marketing campaigns that consistently deliver impressive results.</p>
            <img class="hidden lg:block" src="./Img/why-choose-us.svg" alt="" style="height: 26rem;">
        </section>
        <!-- right side -->
        <section class="flex flex-col gap-8 justify-center lg:pr-32">
            <!-- points -->
            <div class="flex gap-4 lg:flex-row flex-col">
                <img class="lg:h-20 lg:w-20 h-16 w-16" src="./Img/ui-buttons/icon1.svg" alt="">
                <span class="my-auto">
                    <h1 class="font-medium text-2xl">Quality Assurance</h1>
                    <p class="text-black/50">Education at Your Fingertips: Easy Access to Quality Learning</p>
                </span>
            </div>
            <div class="flex gap-4 lg:flex-row flex-col">
                <img class="lg:h-20 lg:w-20 h-16 w-16" src="./Img/ui-buttons/icon2.svg" alt="">
                <span class="my-auto">
                    <h1 class="font-medium text-2xl">Personalized Matchmaking</h1>
                    <p class="text-black/50 ">Tailored to Your Needs: Personalized Learning Matches</p>
                </span>
            </div>
            <div class="flex gap-4 lg:flex-row flex-col">
                <img class="lg:h-20 lg:w-20 h-16 w-16" src="./Img/ui-buttons/icon3.svg" alt="">
                <span class="my-auto">
                    <h1 class="font-medium text-2xl">Convinience And Accessibility</h1>
                    <p class="text-black/50">Education at Your Fingertips: Easy Access to Quality Learning</p>
                </span>
            </div>
            <div class="flex gap-4 lg:flex-row flex-col md:px-0 pr-20 ">
                <img class="lg:h-20 lg:w-20 h-16 w-16" src="./Img/ui-buttons/icon4.svg" alt="">
                <span class="my-auto">
                    <h1 class="font-medium text-2xl">Continous Support</h1>
                    <p class="text-black/50">Guidance Every Step of the Way: Ongoing Support and Abundant Resources</p>
                </span>
            </div>
        </section>
    </wrapper>
    <img class="h-24 w-36 absolute bottom-0 right-8 -rotate-3" src="./Img/ui-buttons/Vector 245.svg" alt="">
</main>


<!-- section-6 -->
<main id="faq-section" class="relative py-20 flex flex-col gap-20">
    <section class="w-4/5 h-auto mx-auto flex justify-between lg:flex-row flex-col-reverse lg:gap-0 gap-16">
        <!-- left side -->
        <div class="lg:w-1/2 w-full h-full font-medium text-lg ">
            <section class="w-full border-t-2 border-b-2 py-5">
                <div class="flex justify-between items-center">
                How does Teacher platform work?
                <img src="./Img/ui-buttons/addicon.svg" alt="" class="h-10 cursor-pointer" onclick="showFAQText(0)">
                </div>
                <div class="hidden-faq-text text-base font-normal">
                    A teacher platform serves as a centralized digital space designed to streamline various aspects of teaching and classroom management. Typically, teachers begin by creating an account and customizing their profile with information such as their teaching subjects, grade levels, and educational background. The platform offers tools for lesson planning, curriculum development, and resource sharing, allowing educators to create engaging and interactive learning experiences for their students. Teachers can upload instructional materials, assign homework and assessments, and track student progress through the platform's intuitive interface. Communication features enable seamless interaction with students, parents, and colleagues, facilitating feedback, collaboration, and support. Additionally, teacher platforms often integrate data analytics and reporting tools, empowering educators to analyze student performance and tailor their instruction to meet individual needs effectively. Ultimately, teacher platforms streamline administrative tasks, enhance instructional quality, and foster a collaborative learning environment conducive to student success.
                </div>
            </section>
            <section class="w-full border-t-2 border-b-2 py-5">
                <div class="flex justify-between">
                How do you ensure the quality of teachers on your platform?
                <img src="./Img/ui-buttons/addicon.svg" alt="" class="h-10 cursor-pointer" onclick="showFAQText(1)">
                </div>
                <div class="hidden-faq-text text-base font-normal">
                    Ensuring the quality of teachers on our platform is a top priority, and we employ several strategies to maintain high standards of expertise and professionalism. Firstly, we carefully vet each teacher before they are approved to join the platform, conducting thorough background checks and verifying their educational qualifications and teaching experience. Additionally, we may require teachers to undergo training or certification programs to ensure they are equipped with the necessary skills and knowledge to effectively instruct students. Once on board, we continuously monitor teacher performance through student feedback, peer evaluations, and periodic assessments of teaching effectiveness. We also provide ongoing professional development opportunities to help teachers stay abreast of best practices and innovative instructional techniques. By implementing these rigorous vetting processes and ongoing quality assurance measures, we strive to uphold the excellence of our teaching community and deliver a superior learning experience for students.
                </div>
            </section>
            <section class="w-full border-t-2 border-b-2 py-5">
                <div class="flex justify-between">
                How to register an teacher?
                <img src="./Img/ui-buttons/addicon.svg" alt="" class="h-10 cursor-pointer" onclick="showFAQText(2)">
                </div>
                <div class="hidden-faq-text text-base font-normal">
                    Registering a teacher on our platform is a straightforward process designed to ensure efficiency and accuracy. Teachers interested in joining our community simply navigate to the contact page on our platform's website. There, they are prompted to fill out a contact form, providing essential information such as their full name, email address, teaching credentials, educational background, and teaching experience. Additionally, they may be asked to upload relevant documents, such as proof of certification and identification. Once the registration form is completed and submitted, our team reviews the information provided to verify the teacher's qualifications and suitability for the platform. Upon approval, the teacher receives a confirmation email with login credentials, granting them access to their personalized dashboard and the full range of features and resources available on our platform. Our registration process is designed to be user-friendly, efficient, and transparent, ensuring that qualified teachers can quickly and easily join our vibrant teaching community.
                </div>
            </section>
        </div>
        <!-- right side -->
        <div class="lg:w-1/2 w-full  h-full flex text-left gap-8 flex-col  lg:pl-32">
            <heading class="text-4xl font-semibold">How can we help you?</heading>
            <p class="font-normal text-black/50">Follow our newsletter. We will regulary update our latest project and availability.</p>
            <contactArea class="flex gap-4 mt-8 sm:flex-row flex-col">
                <input type="text" name="" id="faq-mail" placeholder="Enter your email" class=" bg-[#fafafa] border-black/20 border-2 h-12 sm:w-4/5 w-full rounded-full px-4  outline-none  placeholder:text-black/50">
                <a href="#contact-section"><input id="faq-submit-button" type="button" class="bg-[#3461FF] h-12 sm:w-32 w-full rounded-full text-white cursor-pointer" value="Lets Talk"></a>

            </contactArea>
            <a class="font-bold text-[#3461FF] text-lg hover:underline underline-offset-2" href="">More FAQ -></a>
        </div>
    </section>
</main>


<!-- section-7 -->
<main id="contact-section" class="relative bg-[#f1f1f1] h-auto p-0 lg:p-20 pt-32 w-full flex justify-center items-center overflow-hidden">
    <section class="bg-white h-auto lg:h-[40rem] w-full lg:w-[90%] rounded-2xl p-2 flex flex-col lg:flex-row justify-between gap-2 shadow-lg z-10">
        <!-- left side -->
        <div class="relative bg-black rounded-2xl h-full w-full lg:w-2/5 p-2 lg:pl-8 pt-12 overflow-hidden">
            <heading class="block text-4xl font-semibold text-white text-center w-full lg:text-left">Contact Information</heading>
            <p class="text-white/50 mt-2 block text-center lg:text-left">Say something to start a live chat!</p>
            <section class="mt-20 text-white flex flex-col gap-8">
                <span class="flex-col lg:flex-row text-center lg:text-left mx-auto lg:mx-0 flex gap-4 lg:gap-8 font-poppins text-lg justify-center lg:justify-start lg:items-start items-center "><img class="h-6 w-6" src="./Img/ui-buttons/bxs_phone-call.svg" alt="">+91 6291604272</span>
                <span class="flex-col lg:flex-row text-center lg:text-left mx-auto lg:mx-0 flex gap-4 lg:gap-8 font-poppins text-lg justify-center lg:justify-start lg:items-start items-center "><img class="h-6 w-6" src="./Img/ui-buttons/ic_sharp-email.svg" alt="">educontacthub@email.com</span>
            </section>
            <!-- 2 circle div -->
            <div class="bg-white/40 absolute -bottom-32 -right-32 h-80 w-80 rounded-full"></div>
            <div class="bg-white/40 absolute bottom-16 right-16 h-40 w-40 rounded-full"></div>
            <!-- social -->
            <section class="mt-40 flex gap-8 mx-auto lg:mx-0 justify-center" style="display: none;">
                <a href="#"><img src="./Img/ui-buttons/twitter.svg" alt=""></a>
                <a href="#"><img src="./Img/ui-buttons/insta.svg" alt=""></a>
                <a href="#"><img src="./Img/ui-buttons/Facebook.svg" alt=""></a>
            </section>
        </div>
        <!-- right side -->
        <div class="relative rounded-2xl h-full w-full lg:w-3/5 px-8 pt-12">
            <form class="flex flex-col gap-16 font-poppins" action="">
                <section class="flex sm:flex-row flex-col justify-evenly gap-12">
                    <span class="w-full sm:w-1/2 flex flex-col gap-2">
                        <label for="FName">First Name</label>
                        <input type="text" id="FName" class="border-b-2 border-t-0 border-x-0 border-black/50 !outline-none w-full text-black/50" required autocomplete="off">
                    </span>
                    <span class="w-full sm:w-1/2 flex flex-col gap-2">
                        <label for="LName">Last Name</label>
                        <input type="text" id="LName" class="border-b-2 border-t-0 border-x-0 border-black/50 !outline-none w-full text-black/50" required autocomplete="off">
                    </span>
                </section>
                <section class="flex flex-col sm:flex-row justify-evenly gap-12">
                    <span class="w-full sm:w-1/2 flex flex-col gap-2">
                        <label for="email">Email</label>
                        <input type="text" id="email" class="border-b-2 border-t-0 border-x-0 border-black/50 !outline-none w-full text-black/50" required autocomplete="off">
                    </span>
                    <span class="w-full sm:w-1/2 flex flex-col gap-2">
                        <label for="Pnumber">Phone Number</label>
                        <input type="number" id="Pnumber" class="border-b-2 border-t-0 border-x-0 border-black/50 outline-none w-full text-black/50" required autocomplete="off">
                    </span>
                </section>
                <section>
                    <heading class="text-black text-xl font-semibold">Select Subject?</heading>
                    <div class="mt-4 gap-12 flex lg:flex-row flex-col">
                        <span class="flex flex-col gap-4" >
                        <span class="flex gap-2" >
                            <input type="radio" class="" name="subjectContact" id="ginquiry" value="ginquiry" required>
                            <label for="ginquiry">General inquiry</label>
                        </span>
                        <span class="flex gap-2" >
                            <input type="radio" class="" name="subjectContact" id="refund" value="refund" required>
                            <label for="refund">Refund</label>
                        </span>
                        </span>
                        <span class="flex flex-col gap-4" >
                        <span class="flex gap-2" >
                            
                            <input type="radio" class="" name="subjectContact" id="working" value="working" required>
                            <label for="working">How it works?</label>
                        </span>
                        <span class="flex gap-2" >
                            <input type="radio" class="" name="subjectContact" id="Others" value="Others" required>
                            <label for="Others">Others</label>
                        </span>
                        </span>
                    </div>
                </section>
                <span class="w-full flex flex-col gap-2 -mt-10">
                <label for="textBox">Your message</label>
                <input type="text" id="textBox" class="border-b-2 border-black/50 outline-none w-full text-black/50" required>
                </span>
                <div class="w-full flex justify-end items-end">
                    <input type="submit" class="contact-form-submit-btn h-12 w-60 rounded-full text-white bg-[#3461FF] cursor-pointer hover:scale-105 duration-300" id="contact-form-submit-btn" value="Send message" />
                </div>
            </form>
        </div>
    </section>
    <section class="bg-gradient-to-r from-[#3461FF] via-[#3461FF] to-[#6B88EF] w-screen h-96 rounded-tr-[17rem] rounded-tl-[10rem] absolute -bottom-12 left-0  z-0"></section>
</main>

<?php 
    include("footer.php"); //website footer
    include("foot.php"); //html footer
?>