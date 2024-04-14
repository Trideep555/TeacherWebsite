<?php
include("header.php");
include("nav.php");
include("connection.php");
$sessionTeacher = false;
$teacherId = $_REQUEST['teachSuperId'];
?>
<!-- <script>console.log('eyyyyy<?php echo $_SESSION['teacherId'];?>')</script> -->
<?php


if (isset($_SESSION['teacherId'])) {
    $sessionTeacherId = $_SESSION['teacherId'];
    if($teacherId==$sessionTeacherId){
        $sessionTeacher=true;
    }
}

$query = "SELECT * FROM `teacher-table` WHERE `id` = '$teacherId'";
$res = mysqli_query($connection, $query);
// if (mysqli_num_rows($res) == 0) {
//     @header("location:NoTeacher.php?");
//     exit();
// }
$row = mysqli_fetch_array($res);
$Fullname = $row['firstName'] . " " . $row['lastName'];

$profilequery = "SELECT * FROM `teacher-profileimage-table` WHERE `teacherId` = '$teacherId'";
$profileRes = mysqli_query($connection,$profilequery);
?>

<profile class="bg-[#F1F1F1] relative overflow-x-hidden">
    <!-- main div -->
    <div class="h-auto w-full mt-[4.1rem] flex flex-col gap-12 lg:gap-0 lg:flex-row justify-center pt-12 border-b-2 border-black/30 py-16">
        <!-- h-[35rem] w-[30rem] -->
        <!-- left part -->
        <div class="h-full w-full">
            <div class="flex justify-center text-[#6C6C6C] font-sans font-medium tracking-wide text-xl">
                Profile
            </div>
            <!-- img part aita -->
            <div class=" flex justify-center mt-4">
                <div class="group/imgOverlay h-28 w-28 rounded-full bg-[#6C6C6C] flex justify-center items-center relative">
                    <img class=" h-[6.5rem] w-[6.5rem] rounded-full" src="
                    <?php 
                    if(mysqli_num_rows($profileRes)==0){
                        echo "./Img/Teacher card photos/user.png";
                    }
                    else{
                        $profileArr = mysqli_fetch_array($profileRes);
                        echo $profileArr['profileImgPath'];
                    }
                    
                    ?>
                    
                    " alt="" />
                    <?php 
                    if($sessionTeacher){
                    ?>

                    <label for="upload-dp"><div class="group-hover/imgOverlay:block hidden  bg-black/30  h-28 w-28 rounded-full absolute top-0 left-0 text-white text-center py-12 font-semibold cursor-pointer "><i class="fa-solid fa-cloud-arrow-up"></i> Upload</div></label>
                    <input class="hidden" type="file" name="upload-dp" id="upload-dp">
                <?php 
                }
                ?>  
                </div>
            </div>
            <!-- img part aita -->
            <!-- name and work of Teacher -->
            <div class="flex justify-center items-center mt-4 flex-col">
                <div class="capitalize text-black font-sans font-bold tracking-wide text-xl">
                    <?php echo $Fullname; ?>
                </div>
                <div class="text-[#6C6C6C] font-sans font-light tracking-wide text-xl">
                    Teacher
                </div>
            </div>
            <!-- name and work of Teacher -->
            <!-- rest of the information -->
            <div class="flex justify-evenly">
                <div class="h-[6.5rem] w-[8rem] flex justify-center items-center flex-col">
                    <div class="text-black font-sans font-light h-8 w-[8rem] 
                     ">
                        Classes-Subjects
                    </div>
                    <div class="text-[#6C6C6C] font-sans font-extralight text-lg ">
                        <button id="showTable" class="hover:underline underline-offset-4">Show table</button>
                    </div>
                </div>
                <img src="./Img/Rectangle 3.png" alt="" />
                <div class="h-[6.5rem] w-[8rem] flex justify-center items-center flex-col">
                    <div class="text-black font-sans font-light tracking-wide text-2xl h-8">
                        <?php if($row['experience']!="Not Yet"){echo $row['experience'];}else{echo "1";}?>+
                    </div>
                    <div class="text-[#6C6C6C] font-sans font-extralight text-base text-center capitalize leading-4">
                        Years of experience
                    </div>
                </div>
                <img src="./Img/Rectangle 3.png" alt="" />
                <div class="h-[6.5rem] w-[8rem] flex justify-center items-center flex-col">
                    <div class="text-black font-sans font-light tracking-wide text-2xl">
                        <?php echo $row['qualification']; ?>
                    </div>
                </div>
            </div>
            <!-- rest of the information -->
            <!-- contact button and location -->
            <div class="flex justify-center items-center mt-8 flex-col">
                <a href="<?php if($sessionTeacher) echo "teacherRegistration.php?updateTeacherProfile=".$sessionTeacherId; ?>"><button class="h-10 w-[13rem] bg-[#3461FF] flex justify-center items-center rounded-xl text-white font-sans font-light tracking-wide text-lg capitalize">
                        <?php 
                        if($sessionTeacher){
                            echo "Edit Profile";
                        }
                        else{
                            echo "Contact";
                        }                      
                        ?>
                    </button></a>
                <div class="text-[#6C6C6C] font-sans font-extralight text-base text-center capitalize leading-4 mt-2">
                    India , <?php echo $row['state']; ?>
                </div>
            </div>
            <!-- contact button and location -->
        </div>
        <!-- left part -->

        <!-- h-[35rem] w-[40rem] -->
        <!-- right part -->
        <div class="h-full w-full flex flex-col gap-7 px-2 sm:px-16 relative 
            border-l-2 border-black/30
        ">
            <!--todo Element 1 -->
            <div class="uppercase font-bold text-lg">Basic info</div>

            <!--todo Element 2 (line img)-->
            <div class="w-full">
                <img class="w-full" src="./Img/Rectangle 21.png" alt="" />
            </div>

            <!--todo Element 3(first name & last name) -->
            <div class="flex w-full flex-col sm:flex-row justify-between gap-8">
                <div class="capitalize flex flex-col w-full">
                    <label class="text-black font-sans capitalize leading-4 tracking-tight" for="">First name</label>
                    <input class="capitalize border-2 bg-transparent outline-none rounded-md border-[#E5E5E5] mt-3 w-full h-10 px-4" type="text" value="<?php echo $row['firstName']; ?>" disabled />
                </div>
                <div class="capitalize flex flex-col w-full">
                    <label class="text-black font-sans capitalize leading-4 tracking-tight" for="">Last name</label>
                    <input class="capitalize border-2 bg-transparent outline-none rounded-md border-[#E5E5E5] mt-3 w-full h-10 px-4" value="<?php echo $row['lastName'];?>" type="text" disabled />
                </div>
            </div>

            <!--todo Element 4 (phoneNumber) -->
            <div class="flex w-full justify-between gap-8">
                <div class="capitalize flex flex-col w-full">
                    <label class="text-black font-sans capitalize leading-4 tracking-tight" for="">Contact Number</label>
                    <input class="border-2 bg-transparent outline-none rounded-md border-[#E5E5E5] mt-3 w-full h-10 px-4" value="<?php echo $row['phoneNumber'];?>" type="text" disabled />
                </div>
            </div>

            <!--todo Element 5 (email)-->
            <div class="flex w-full justify-between gap-8">
                <div class="capitalize flex flex-col w-full">
                    <label class="text-black font-sans capitalize leading-4 tracking-tight" for="">Email</label>
                    <input class="px-4 border-2 bg-transparent outline-none rounded-md border-[#E5E5E5] mt-3 w-full h-10" value="<?php echo $row['email'];?>" type="email" disabled />
                </div>
            </div>

            <!--todo Element 6 (about me heading)-->
            <div class="uppercase font-bold text-lg">Address</div>

            <!--todo Element 7 (line img) -->
            <div class="w-full">
                <img class="w-full" src="./Img/Rectangle 21.png" alt="" />
                
            </div>
            

            <!--todo Element 8 (about me section) -->
            <div class=" w-full justify-between gap-8 z-10">
                <?php 
                if($row['mapLink']!="Not Provided"){
                ?>
                <a target="_blank"  href="<?php echo $row['mapLink'];?>" class="w-full capitalize font-medium text-blue-500">
                    Show location <i class="fa-solid fa-location-dot"></i>
                </a>
                <?php 
                }
                ?>
                <div class="capitalize flex flex-col w-full">
                    <textarea class="border-2 bg-white/50 outline-none rounded-md border-[#E5E5E5] mt-3 w-full h-24 z-10 backdrop-blur-sm p-2" value="" type="text" disabled ><?php echo $row['address'];?></textarea>
                </div>
            </div>
        </div>
        <!-- right part ENDD-->

        <!-- <img src="./Img/Line 11.png" alt=""> -->
    </div>

    <!--* middle part(two images)  -->
    <div class="w-full h-96 justify-between relative">
        <img class="absolute bottom-8 h-[30rem] w-[10rem] sm:w-auto left-0" src="./Img/profilepage/profileImage2.svg" alt="" />
        <img class="absolute bottom-20 h-[30rem] w-[10rem] sm:w-auto right-0" src="./Img/profilepage/profileImage1.svg" alt="" />
    </div>

    <!-- //table -->
    <section id="tableArea" class="hidden fixed top-0 left-0 z-30 h-screen backdrop-blur-sm w-screen bg-black/50">
        <div id="tableSection"  class=" tableArea absolute top-40 left-0 right-0 h-96 w-96 mx-auto bg-white backdrop-blur-md shadow-md z-30 rounded-lg py-8">
            <table class="tableArea mx-auto w-[90%] border-2 rounded-lg border-black/50">
                <tr class="border-2 border-black/50">
                    <th class="p-4 border-2 border-black/50">Class</th>    
                    <th class="p-4 border-2 border-black/50">Subject</th>
                </tr>

                <?php 
                $classSubjquery = "SELECT * FROM `teacher-cls-subj`
                INNER JOIN `subject-table` ON `subject-table`.`id`=`teacher-cls-subj`.`subjectId`
                INNER JOIN `class-table` ON `class-table`.`id`=`teacher-cls-subj`.`classId`
                WHERE `teacherId`='$teacherId'";
                $resarr = mysqli_query($connection,$classSubjquery);

                while($rowarr = mysqli_fetch_array($resarr)){
                ?>
                <tr class="border-2 border-black/50">
                    <td class="p-4 text-center border-2 border-black/50"><?php echo $rowarr['className'];?></td>
                    <td class="p-4 text-center border-2 border-black/50"><?php echo $rowarr['subjectName'];?></td>
                </tr>
                <?php 
                }
                ?>
            </table>
        </div>
    </section>
<!-- gallery area -->
<?php 
$banners = array("./Img/banner/banner 1.jpg","./Img/banner/banner 2.jpg","./Img/banner/banner 3.jpg","./Img/banner/banner 1.jpg","./Img/banner/banner 2.jpg","./Img/banner/banner 3.jpg");
$bannerIDs = array();
$bannerSql = "SELECT * FROM `teacher-bannerimg-table` WHERE `teacherId` = '$teacherId'";
$bannerRes = mysqli_query($connection,$bannerSql);
$i = 0;
if(mysqli_num_rows($bannerRes)>0){
    while($bannerArr = mysqli_fetch_array($bannerRes)){
        $banners[$i] = strval($bannerArr['bannerImgPath']);
        // echo $bannerArr['id'];
        $bannerIDs[$i] = strval($bannerArr['id']);
        $i++;
    }
}

?>
<div class="container mx-auto px-5 py-2 lg:px-32 lg:pt-24">
  <div class="-m-1 flex flex-col sm:flex-row flex-wrap md:-m-2">
    <div class="flex w-full sm:w-1/2 flex-wrap">
      <div class="relative h-[15rem] w-screen sm:w-1/2 p-1 md:p-2">
        <img
          alt="gallery"
          class="block h-full w-full rounded-lg object-cover object-center"
          src="<?php echo $banners[0];?>" />
          <?php 
          if($sessionTeacher){
          ?>
          <div data-path = "<?php echo $banners[0];?>" class="deleteBanner cursor-pointer bg-black/30 absolute bottom-4 right-4 h-8 w-8 rounded-lg text-white flex justify-center items-center " data-bannerId = "<?php echo $bannerIDs[0];?>" >
          <i class="fa-solid fa-trash"></i>
          </div>
          <?php 
          }
          ?>
      </div>
      <div class="relative h-[15rem] w-screen sm:w-1/2 p-1 md:p-2">
        <img
          alt="gallery"
          class="block h-full w-full rounded-lg object-cover object-center"
          src="<?php echo $banners[1];?>" />
          <?php 
          if($sessionTeacher){
          ?>
          <div data-path = "<?php echo $banners[1];?>" class="deleteBanner cursor-pointer bg-black/30 absolute bottom-4 right-4 h-8 w-8 rounded-lg text-white flex justify-center items-center " data-bannerId = "<?php echo $bannerIDs[1];?>" >
          <i class="fa-solid fa-trash"></i>
          </div>
          <?php 
          }
          ?>
      </div>
      <div class="relative h-[15rem] w-screen sm:h-[20rem] sm:w-full p-1 md:p-2">
        <img
          alt="gallery"
          class="block h-full w-full rounded-lg object-cover object-center"
          src="<?php echo $banners[2];?>" />
          <?php 
          if($sessionTeacher){
          ?>
          <div data-path = "<?php echo $banners[2];?>" class="deleteBanner cursor-pointer bg-black/30 absolute bottom-4 right-4 h-8 w-8 rounded-lg text-white flex justify-center items-center " data-bannerId = "<?php echo $bannerIDs[2];?>" >
          <i class="fa-solid fa-trash"></i>
          </div>
          <?php 
          }
          ?>
      </div>
    </div>
    <div class="flex w-full sm:w-1/2 flex-wrap">
      <div class="relative h-[15rem] w-screen sm:h-[20rem] sm:w-full p-1 md:p-2">
        <img
          alt="gallery"
          class="block h-full w-full rounded-lg object-cover object-center"
          src="<?php echo $banners[3];?>" />
          <?php 
          if($sessionTeacher){
          ?>
          <div data-path = "<?php echo $banners[3];?>" class="deleteBanner cursor-pointer bg-black/30 absolute bottom-4 right-4 h-8 w-8 rounded-lg text-white flex justify-center items-center " data-BannerId = "<?php echo $bannerIDs[3];?>" >
          <i class="fa-solid fa-trash"></i>
          </div>
          <?php 
          }
          ?>
      </div>
      <div class="relative h-[15rem] w-screen sm:w-1/2 p-1 md:p-2">
        <img
          alt="gallery"
          class="block h-full w-full rounded-lg object-cover object-center"
          src="<?php echo $banners[4];?>" />
          <?php 
          if($sessionTeacher){
          ?>
          <div data-path = "<?php echo $banners[4];?>" class="deleteBanner cursor-pointer bg-black/30 absolute bottom-4 right-4 h-8 w-8 rounded-lg text-white flex justify-center items-center " data-BannerId = "<?php echo $bannerIDs[4];?>" >
          <i class="fa-solid fa-trash"></i>
          </div>
          <?php 
          }
          ?>
      </div>
      <div class="relative h-[15rem] w-screen sm:w-1/2 p-1 md:p-2">
        <img
          alt="gallery"
          class="block h-full w-full rounded-lg object-cover object-center"
          src="<?php echo $banners[5];?>" />
          <?php 
          if($sessionTeacher){
          ?>
          <div data-bannerid = "<?php echo $bannerIDs[5];?>" data-path = "<?php echo $banners[5];?>" class="deleteBanner cursor-pointer bg-black/30 absolute bottom-4 right-4 h-8 w-8 rounded-lg text-white flex justify-center items-center "   >
          <i class="fa-solid fa-trash"></i>
          </div>
          <?php 
          }
          ?>
      </div>
    </div>
  </div>
  <?php 
  if($sessionTeacher){
  ?>
  <input type="file" name="banner-upload" id="banner-upload" class="hidden">
  <label for="banner-upload" class=" block bg-blue-400 text-white text-lg font-medium h-10 w-36 px-2 mt-4 rounded-md leading-10 cursor-pointer">Upload Banner</label>
  <?php 
  }
  ?>
</div>
<!-- gallery area -->


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
</profile>
<?php
include("footer.php")
?>