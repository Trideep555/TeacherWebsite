<!-- -----------------------------------navbar start ------------------------------------------------------>
<?php
include("connection.php");
include("header.php");
include("nav.php");
$bannerArray = array('TeacherProjectWebsite\Img\banner\banner 1.jpg','TeacherProjectWebsite\Img\banner\banner 1.jpg','TeacherProjectWebsite\Img\banner\banner 1.jpg');

$bannerSql = "SELECT *  FROM `teacher-bannerimg-table` order by rand() LIMIT 3";
$bannerRes = mysqli_query($connection,$bannerSql);
$i = 0;
while($row = mysqli_fetch_array($bannerRes)){
  $bannerArray[$i] = $row['bannerImgPath'];
  $i++;
}
?>
<!-- navbar end -->

<!-- this is the starting of the main section  -->

<!-- this is the starting of  carousel section -->
<!-- <main class="h-[calc(100vh-4rem)] mt-16 w-full relative overflow-x-hidden">
  <wrapper class="bannerCarousel duration-500 flex absolute top-0 left-0 overflow-hidden">
    <div class="h-[calc(100vh-4rem)] w-screen">
      <img class="w-full h-full" src="<?php echo $bannerArray[0];?>" alt="">
    </div>
    <div class="h-[calc(100vh-4rem)] w-screen">
      <img class="w-full h-full" src="<?php echo $bannerArray[1];?>" alt="">
    </div>
    <div class="h-[calc(100vh-4rem)] w-screen">
      <img class="w-full h-full" src="<?php echo $bannerArray[2];?>" alt="">
    </div>
  </wrapper>
</main> -->


<!-- this is the ending of  carousel section -->
<!-- starting of the first section  -->
<main class="bg-[#f1f1f1] w-auto lg:h-auto flex justify-evenly mt-0  relative h-screen ">
  <!-- left side div area -->
  <section class="px-5 md:pl-20 lg:w-1/2 py-28 flex flex-col gap-8 z-20 lg:bg-transparent bg-[#f1f1f1]/90 w-screen">
    <!-- main heading area with bold letter and font 2xl -->
    <heading class="font-semibold font-sans lg:text-8xl md:text-7xl text-6xl w-auto text-left select-none">Match,</br> Learn, And </br>Soar To </br>Success
    </heading>
    <!--------------------- sub heading part -------------------->
    <subHeading class="text-xl text-black/50 select-none">
      "Find your perfect teacher today"
    </subHeading>
    <!-------------------- lets talk area --------------------------->
    <contactArea>
      <form action="" class="flex gap-4 md:flex-row flex-col">
        <input type="text" name="" id="" placeholder="Enter your email" class="h-12 md:w-1/2 rounded-full px-4  outline-none border-black/30 border-[1px] placeholder:text-black/50 w-full">
        <input type="submit" class="bg-[#3461FF] h-12 md:w-32 rounded-full text-white cursor-pointer w-full" value="Lets Talk">
      </form>
    </contactArea>
  </section>
  <!-- right section of the first area -->
  <section class="lg:w-1/2 w-screen lg:relative absolute top-0 left-0 right-0 mx-auto z-10 lg:z-20">
    <img src="./Img/first-page-photos/heroImg.svg" class="lg:my-10 lg:h-4/5 lg:w-4/5 h-screen w-auto mx-auto lg:mx-0 z-10 lg:z-20" alt="" draggable="false">
  </section>
</main>
<!-- this is the end of first section hero -->

<!-- starting of the teacher section  -->
<main class="relative py-20 flex flex-col gap-20">
  <section class="font-semibold text-5xl w-4/5 h-auto mx-auto flex justify-between">
    <heading class="">Our Teachers</heading>
    <!-- This section is for button area with left and right button -->
    <section class="md:flex justify-evenly hidden">
      <img class=" leftSwipeArrow mx-2 cursor-pointer" src="./Img/ui-buttons/leftArrow.svg" alt="">
      <img class=" rightSwipeArrow mx-2 cursor-pointer" src="./Img/ui-buttons/rightArrow.svg" alt="">
    </section>
  </section>
  <!-- this section is for teacher cards area -->
  <section class="carousel-cu w-[90%] px-[5%] mx-auto grid grid-flow-col overflow-x-auto lg:overflow-x-hidden h-full py-8  gap-8">
    <!-- card section -->
    <!------------------ card 1 ------------------ ---->

    <?php
    $teacherQuery = "SELECT * FROM `teacher-table` ORDER BY rand() LIMIT 5";
    $res = mysqli_query($connection,$teacherQuery);
    
    while($rowarr = mysqli_fetch_array($res)){
    
      $randTeacherId = $rowarr['id'];
        $class = "SELECT * FROM `teacher-cls-subj`
                  INNER JOIN `class-table` ON `class-table`.`id` = `teacher-cls-subj`.`classId`
                  INNER JOIN `subject-table` ON `subject-table`.`id`=`teacher-cls-subj`.`subjectId`
                  WHERE `teacherId` = '$randTeacherId'
                  ORDER BY rand()  LIMIT 1";
        $classRes = mysqli_query($connection,$class);
        $classarr = mysqli_fetch_array($classRes);
        $profilequery = "SELECT * FROM `teacher-profileimage-table` WHERE `teacherId` = '$randTeacherId'";
        $profileRes = mysqli_query($connection,$profilequery);

    ?>

    <section class=" relative w-96  rounded-2xl shadow-lg border-t-2 border-black/20 py-8 flex flex-col gap-4">

      <!-- profile image area with absolute property -->
      <div class="px-4 h-20 w-full p-1 bg-white rounded-full flex ">
        <img class=" w-[4.5rem] h-[4.5rem] rounded-full" src="<?php 
                    if(mysqli_num_rows($profileRes)==0){
                        echo "./Img/Teacher card photos/user.png";
                    }
                    else{
                        $profileArr = mysqli_fetch_array($profileRes);
                        echo $profileArr['profileImgPath'];
                    }
                    
                    ?>" alt="" draggable="false">
        <span>
          <heading class="capitalize block px-4 font-semibold text-2xl"><?php echo $rowarr['firstName']." ".$rowarr['lastName'];?></heading>
          <!------------------- subject Names -------------------->
          <h1 class="px-4 text-black/60 mt-2"><?php echo $classarr['subjectName'];?>

          </h1>
        </span>
      </div>
      <!-- Teacher Name -->

      <!--------------- Tags area ---------------------------->
      <div class="px-4 flex gap-2 mt-3">
        <!-- tag 1 is for experience -->
        <?php 
        if($rowarr['experience']!="Not Yet"){
        ?>
        <tag class="border-black/70 border-2 px-4 py-1 select-none hover:scale-110 duration-300 rounded-full font-medium text-sm text-black/70"><?php echo $rowarr['experience'];?> years</tag>
        <!-- tag 2 is for class -->
        <?php 
        }
        ?>
        <tag class="border-black/70 border-2 px-4 py-1 select-none hover:scale-110 duration-300 rounded-full font-medium text-sm text-black/70"><?php echo $classarr['className'] ?></tag>
        <!-- tag 3 is for degree -->
        <tag class="border-black/70 border-2 px-4 py-1 select-none hover:scale-110 duration-300 rounded-full font-medium text-sm text-black/70"><?php echo $rowarr['qualification'];?></tag>

      </div>
      <!---------------------- connect button --------------------->
      <a href="teacherProfile.php?teachSuperId=<?php echo $randTeacherId;?>" class=""><button class="mx-[5%] w-[90%] bg-[#3461FF] h-12  rounded-full text-white text-lg ">Connect</button></a>
    </section>
    <?php 
    }
    ?>
    <section class=" relative w-96  rounded-2xl shadow-lg border-t-2 border-black/20 py-8">

      <!-- profile image area with absolute property -->
      <div class="px-4 h-20 w-full p-1 bg-white rounded-full flex ">
        <span class="w-full">
          <heading class="w-full text-center capitalize font-semibold text-2xl block">Need more?</heading>
          <!------------------- subject Names -------------------->
          <h1 class=" block text-center w-full capitalize px-4 text-black/60 mt-2">
            click the button below!
          </h1>
        </span>
      </div>
      

      <!--------------- Tags area ---------------------------->
      
      <!---------------------- connect button --------------------->
      <a href="hero.php" class=""><button class="mx-[5%] w-[90%] bg-[#3461FF] h-12 mt-8 rounded-full text-white text-lg ">Explore</button></a>
      </section>
  </section>
</main>
<!-- end of teacher card section  -->

<!-- starting of cta section -->
<main class="flex justify-center items-center bg-[#f1f1f1] py-40">
  <section class="w-4/5 bg-[#3461FF]  mx-auto h-80 rounded-3xl relative overflow-hidden">
    <wrapper class="flex justify-evenly lg:flex-row  flex-col  h-full w-full">
      <!-- left section text -->
      <div class="z-20 lg:w-1/2 w-full text-center lg:text-6xl text-4xl sm:text-5xl font-semibold lg:leading-[5rem] leading-[2rem] sm:leading-[3rem] lg:py-20 py-0 flex flex-col md:max-lg:flex-row md:max-lg:justify-center  lg:gap-0 gap-4 text-white">
        <div>Elevate Your</div>
        <div>Skills Today!</div>
      </div>
      <!-- right section -->
      <div class="lg:w-1/2 w-full px-12  text-base sm:text-xl lg:py-28 z-20 text-white">Unlock exciting opportinuties of your carrer. Next step - Register as a teacher today.
        <br>
        <a href="teacherRegistration.php"><button class="text-black bg-white md:w-32 w-full h-10 mt-8 rounded-full text-base font-medium">Register Now</button></a>
      </div>
    </wrapper>
    <!-- This is background ball -->
    <div class=" z-10 h-96 w-96 absolute top-0 bottom-0 left-72 my-auto  rounded-full 
          bg-gradient-to-l from-[#3461FF] via-[#3461FF] to-[#8399E9]
          "></div>
    <div class="z-0 h-96 w-96 absolute top-0 bottom-0 left-24 my-auto  rounded-full 
          bg-gradient-to-l from-[#3461FF]  to-[#8399E9]
          "></div>
    <!-- This is background ball -->
    <div class="h-96 w-96 absolute top-0 bottom-0 -left-24 my-auto  rounded-full 
          bg-gradient-to-l from-[#3461FF] to-[#8399E9]
          "></div>
    <!-- This is background ball -->
    <div class="h-96 w-96 absolute top-0 bottom-0 -left-72 my-auto  rounded-full bg-gradient-to-l from-[#3461FF] to-[#8399E9]
          "></div>

  </section>
</main>
<!-- ending of cta section -->

<!-- starting of why choose us section -->
<main id="about-us-section" class="bg-[#f1f1f1] lg:h-[55rem] w-full py-28 overflow-hidden relative">
  <div class="absolute flex justify-evenly rounded-[8rem] bg-white lg:h-[45rem] h-[85rem] sm:max-lg:h-[65rem] lg:w-full w-[90rem] -translate-x-1/4 lg:translate-x-0 shadow-lg rotate-3"></div>
  <img class="h-28 w-28 absolute top-0 -rotate-6 left-0 " src="./Img/ui-buttons/packman.svg" alt="design image">

  <wrapper class="relative  flex lg:justify-evenly lg:flex-row justify-center gap-20 pt-10 flex-col items-center w-full px-[5%] lg:px-0">

    <!-- this is the left section of why choose us area -->
    <section class="lg:w-1/2 w-[90%] flex flex-col gap-12 lg:px-32 px-0 justify-center">
      <heading class="font-semibold lg:text-6xl text-4xl text-justify">Why Choose Us?</heading>
      <p class="lf:w-[90%] w-full text-black/50 text-justify ">In our teacher matchmaking endeavor, we're dedicated to close collaboration with our clients. By understanding their goals and challenges deeply, we create tailored marketing campaigns that consistently deliver impressive results.</p>
      <img class="h-54 w-[90%] hidden lg:block" src="./Img/why-choose-us.png" alt="">
    </section>
    <!-- this is the right section of why choose us area -->
    <section class="flex flex-col gap-8 justify-center">
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
  <img class="h-24 w-36 absolute -bottom-12 right-8 -rotate-3" src="./Img/ui-buttons/Vector 245.svg" alt="">
  <!-- </div> -->
</main>
<!-- ending of why choose us section -->

<!-- starting of the testimonial section -->
<main class="relative py-20 flex flex-col gap-20 bg-[#f1f1f1] overflow-x-hidden">
  <section class="font-semibold text-5xl w-4/5 h-auto mx-auto flex justify-between bg-[#f1f1f1]">
    <heading class="">What Our Clients Said About Us</heading>
    <!-- This section is for button area with left and right button -->
    <section class="hidden justify-evenly md:flex">
      <img draggable="false" class=" leftSwipeArrowtes mx-2" src="./Img/ui-buttons/leftArrow.svg" alt="">
      <img draggable="false" class=" rightSwipeArrowtes mx-2" src="./Img/ui-buttons/rightArrow.svg" alt="">
    </section>
  </section>
  <!-- this section is for testimonial card area -->
  <section class="carousel-tes w-[90%] px-[5%] mx-auto grid grid-flow-col lg:overflow-x-hidden overflow-x-auto h-full py-8  gap-8">
    <!-- card section -->
    <div class="duration-500 h-auto group lg:w-96 w-60 bg-white hover:bg-[#3461FF] rounded-2xl p-4 ">
      <heading class="flex gap-4 group-hover:text-white">
        <img class="h-12 w-12 rounded-full" src="./Img/Teacher card photos/user.png " alt="">
        <div class="flex flex-col gap-1">
          <span class="text-xl font-medium ">Jacob Joshua</span>
          <span class="">Student</span>
        </div>
      </heading>
      <p class="mt-4 group-hover:text-white">"This is a game-changer in the education field. They not only matched me with an outstanding teaching position but also provided valuable guidance throughout the process. Their commitment to quality education shines through in every step."</p>
    </div>
    <div class="h-auto group lg:w-96 w-60 bg-white hover:bg-[#3461FF] rounded-2xl p-4 duration-500">
      <heading class="flex gap-4 group-hover:text-white">
        <img class="h-12 w-12 rounded-full" src="./Img/Teacher card photos/user.png " alt="">
        <div class="flex flex-col gap-1">
          <span class="text-xl font-medium ">Amelia Joseph</span>
          <span class="group-hover:text-white text-black/50">Professor</span>
        </div>
      </heading>
      <p class="mt-4 group-hover:text-white">"I had been searching for the right tutor for my child for months, and then I found [Your Teacher Finder Business]. Their platform made it easy to connect with experienced educators who understood my child's needs. The results speak for themselves - my child's academic performance has improved significantly"</p>
    </div>
    <div class="h-auto lg:w-96 w-60 bg-white hover:bg-[#3461FF] rounded-2xl p-4 group duration-500">
      <heading class="flex gap-4 group-hover:text-white">
        <img class="h-12 w-12 rounded-full" src="./Img/Teacher card photos/user.png " alt="">
        <div class="flex flex-col gap-1">
          <span class="text-xl font-medium ">Amelia Joseph</span>
          <span class="text-black/50 group-hover:text-white">Law Student</span>
        </div>
      </heading>
      <p class="mt-4 group-hover:text-white">"Finding the perfect teaching opportunity seemed like an overwhelming task until I discovered [Your Teacher Finder Business]. Their personalized approach and dedicated support helped me connect with the ideal teaching position. I can't thank them enough for helping me kickstart my teaching career."</p>
    </div>
  </section>
</main>
<!-- ending of the testimonial section -->

<!-- starting of Faq section -->
<main id="faq-section" class="relative py-20 flex flex-col gap-20">
  <section class="w-4/5 h-auto mx-auto flex justify-between lg:flex-row flex-col-reverse lg:gap-0 gap-16">
    <!-- this is the left section of the faq -->
    <div class="lg:w-1/2 w-full h-full font-medium text-lg ">

      <section class="h-auto w-full border-t-2 border-b-2 py-5 flex justify-between">How does Students platform work? <img src="./Img/ui-buttons/addicon.svg" alt="" class="h-10"></section>
      <section class="w-full border-t-2 border-b-2 py-5 flex justify-between"> How do you ensure the quality of teachers on your platform? <img src="./Img/ui-buttons/addicon.svg" alt="" class="h-10"></section>
      <section class="w-full border-t-2 border-b-2 py-5 flex justify-between">What subjects and grade levels are covered on your platform? <img src="./Img/ui-buttons/addicon.svg" alt="" class="h-10"></section>
    </div>
    <!-- this is the right section of the faq -->
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
<!-- ending of Faq section -->

<!-- starting of contact us section -->
<main id="contact-section" class="relative bg-[#f1f1f1] h-auto p-0 lg:p-20 pt-32 w-full flex justify-center items-center overflow-hidden">
  <section class="bg-white h-auto lg:h-[40rem] w-full lg:w-[90%] rounded-2xl p-2 flex flex-col lg:flex-row justify-between gap-2 shadow-lg z-10">

    <!-- This is left section of contact area -->
    <div class="relative bg-black rounded-2xl h-full w-full lg:w-2/5 p-2 lg:pl-8 pt-12 overflow-hidden">
      <heading class="block text-4xl font-semibold text-white text-center w-full lg:text-left">Contact Information</heading>
      <p class="text-white/50 mt-2 block text-center lg:text-left">Say something to start a live chat!</p>
      <section class="mt-20 text-white flex flex-col gap-8">
        <span class="flex-col lg:flex-row text-center lg:text-left mx-auto lg:mx-0 flex gap-4 lg:gap-8 font-poppins text-lg justify-center lg:justify-start lg:items-start items-center "><img class="h-6 w-6" src="./Img/ui-buttons/bxs_phone-call.svg" alt="">+91 1234567890</span>
        <span class="flex-col lg:flex-row text-center lg:text-left mx-auto lg:mx-0 flex gap-4 lg:gap-8 font-poppins text-lg justify-center lg:justify-start lg:items-start items-center "><img class="h-6 w-6" src="./Img/ui-buttons/ic_sharp-email.svg" alt="">demo@email.com</span>
        <span class="flex-col lg:flex-row text-center lg:text-left mx-auto lg:mx-0 flex gap-4 lg:gap-8 font-poppins text-lg justify-center lg:justify-start lg:items-start items-center "><img class="h-6 w-6" src="./Img/ui-buttons/carbon_location-filled.svg" alt="">Techno India University, EM-4, EM Block, Sector V, Bidhannagar, Kolkata, West Bengal 700091</span>
      </section>

      <!-- 2 circle div -->
      <div class="bg-white/40 absolute -bottom-32 -right-32 h-80 w-80 rounded-full"></div>
      <div class="bg-white/40 absolute bottom-16 right-16 h-40 w-40 rounded-full"></div>

      <!-- social icons section -->
      <section class="mt-40 flex gap-8 mx-auto lg:mx-0 justify-center ">
        <a href="#"><img src="./Img/ui-buttons/twitter.svg" alt=""></a>
        <a href="#"><img src="./Img/ui-buttons/insta.svg" alt=""></a>
        <a href="#"><img src="./Img/ui-buttons/Facebook.svg" alt=""></a>
      </section>
    </div>
    <!-- This is right section of contact area -->
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
<!-- ending of contact us section -->

<!-- footer section start -->
<footer class="relative bg-gradient-to-r from-[#3461FF] via-[#3461FF] to-[#6B88EF] w-full h-auto overflow-hidden">
  <img class="absolute top-0 left-0 z-0 w-screen mt-24" src="./Img/ui-buttons/Rectangle 207.svg" alt="">
  <section class="relative z-10 flex justify-between px-8 lg:px-12 py-32">
    <!-- this is the left section area of the footer -->
    <div class="z-10 flex  flex-col items-center w-[30%] gap-12">
      <img class="mt-24 w-52 relative z-10" src="Img\Logo\logo-dark.svg" alt="">
      <section class="flex gap-2 lg:gap-16 z-10">
        <a href="#"><img src="./Img/ui-buttons/twitter.svg" alt=""></a>
        <a href="#"><img src="./Img/ui-buttons/insta.svg" alt=""></a>
        <a href="#"><img src="./Img/ui-buttons/Facebook.svg" alt=""></a>
      </section>
      <button class="h-8 w-28 lg:h-12 bg-white lg:w-52 rounded-full">Contact Us</button>
    </div>
    <!-- this is the right section area of the footer mainly tab area-->
    <div class="w-full lg:w-[50%] mt-24 flex gap-20">
      <section class="lg:flex hidden  flex-col gap-12">
        <a href="#" class="  text-white font-semibold text-xl hover:underline underline-offset-4">Work With Us</a>
        <a href="#" class="text-white font-semibold text-xl hover:underline underline-offset-4">Advertise With Us</a>
        <a href="#" class="text-white font-semibold text-xl hover:underline underline-offset-4">Support Us</a>
        <a href="#" class="text-white font-semibold text-xl hover:underline underline-offset-4">Business Advices</a>
      </section>
      <section class="lg:flex hidden  flex-col gap-12 ">
        <a href="#" class="text-white font-semibold text-xl hover:underline underline-offset-4">Private Coaching</a>
        <a href="#" class="text-white font-semibold text-xl hover:underline underline-offset-4">Our Work</a>
        <a href="#" class="text-white font-semibold text-xl hover:underline underline-offset-4">Our Commitment</a>
        <a href="#" class="text-white font-semibold text-xl hover:underline underline-offset-4">Our Team</a>
      </section>
      <section class="flex md:flex-row lg:flex-col lg:justify-normal justify-between flex-col  gap-12 w-full lg:text-left text-center lg:items-start items-center px-8 lg:px-0">
        <a href="#" class="text-white font-semibold text-xl hover:underline underline-offset-4">About Us</a>
        <a href="#" class="text-white font-semibold text-xl hover:underline underline-offset-4">FAQs</a>
        <a href="#" class="text-white font-semibold text-xl hover:underline underline-offset-4">Report a bug</a>
      </section>
    </div>
  </section>
</footer>
<!-- copyright section -->
<section class="h-auto lg:h-20 full py-8 px-12 bg-black text-white font-medium text-base flex lg:flex-row flex-col text-center gap-4 justify-between">
  <span>&copy; 2024 Students, Inc. - All Rights Reserved</span>
  <div class="flex justify-around gap-8">
    <span>Terms Of Use</span>
    <span>Privacy Policy</span>
  </div>
</section>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script> -->
<?php
include("footer.php");
?>