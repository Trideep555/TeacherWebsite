<?php
    include("head.php");
    include("nav.php");
    include("connection.php");

    if(!isset($_REQUEST['id']))
    {
        @header("location: index.php");
    }
    $id = $_REQUEST['id'];

    $query = "SELECT * FROM `teacher-table` WHERE `id` = '$id'";
    $res = mysqli_query($connection, $query);
    $teacherRow = mysqli_fetch_array($res);

    $query = "SELECT * FROM `profile-image-table` WHERE `id` = '$id'";
    $res = mysqli_query($connection,$query);
    $profileImage = mysqli_fetch_array($res)['profileImagePath'];
?>

<link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

<profile class="bg-[#F1F1F1] relative overflow-x-hidden">
    <!-- main div -->
    <div class="h-auto w-full mt-[4.1rem] flex flex-col gap-12 lg:gap-0 lg:flex-row justify-center pt-12 border-b-2 border-black/30 py-16">
        <!-- left part -->
        <div class="h-full w-full flex flex-col justify-center">
            <div class="flex justify-center text-[#6C6C6C] font-sans font-medium tracking-wide text-xl">Profile</div>

            <div class=" flex justify-center mt-4">
                <div class="group/imgOverlay h-28 w-28 rounded-full bg-[#6C6C6C] flex justify-center items-center relative" style="object-fit: cover;">
                    <img class=" h-[6.5rem] w-[6.5rem] rounded-full" src="<?php echo (($profileImage == "")?"./Img/user.png":$profileImage); ?>" alt="" /> 
                </div>
            </div>

            <div class="flex justify-center items-center mt-4 flex-col">
                <div class="capitalize text-black font-sans font-bold tracking-wide text-xl">
                    <?php echo $teacherRow['firstName']." ".$teacherRow['lastName']; ?>
                </div>
                <div class="text-[#6C6C6C] font-sans font-light tracking-wide text-xl">
                    <?php echo $teacherRow['role']; ?>
                </div>
            </div>

            <div class="flex justify-evenly my-4">
                <div class="h-[6.5rem] w-[8rem] flex justify-center items-center flex-col">
                    <div class="text-black font-sans font-light h-8 md:text-xl vsm:text-sm">Curriculum</div>
                    <div class="text-[#6C6C6C] font-sans font-extralight text-lg ">
                        <button id="showTable" class="hover:underline underline-offset-4">View</button>
                    </div>
                </div>
                <?php
                    if($teacherRow['experience'] != "")
                    {
                ?>
                        <img src="./Img/Rectangle 3.png" alt="" />
                        <div class="h-[6.5rem] w-[8rem] flex justify-center items-center flex-col">
                            <div class="text-black font-sans font-light tracking-wide text-2xl h-8">
                                <?php echo $teacherRow['experience'] ?>
                            </div>
                            <div class="text-[#6C6C6C] font-sans font-extralight text-base text-center capitalize leading-4">
                                Years of experience
                            </div>
                        </div>
                <?php
                    }
                ?>
                <img src="./Img/Rectangle 3.png" alt="" />
                <div class="h-[6.5rem] w-[8rem] flex justify-center items-center flex-col">
                    <div class="text-black font-sans font-light tracking-wide lg:text-2xl md:text-xl">
                        <?php echo $teacherRow['mode']; ?>
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center mt-8 flex-col">
                <a href="tel: <?php $teacherRow['phoneNumber'] ?>">
                    <button class="h-10 w-[13rem] bg-[#3461FF] flex justify-center items-center rounded-xl text-white font-sans font-light tracking-wide text-lg capitalize">Contact</button>
                </a>
                <div class="text-[#6C6C6C] font-sans font-extralight text-base text-center capitalize leading-4 mt-2">
                    <?php echo $teacherRow['state']; ?>
                </div>
            </div>
        </div>

        <!-- right part -->
        <div class="h-full w-full flex flex-col gap-7 px-2 sm:px-16 relative border-l-2 border-black/30">
            <div class="font-bold text-lg">BASIC INFO</div>

            <div class="w-full">
                <img class="w-full" src="./Img/Rectangle 21.png" alt="" />
            </div>

            <div class="flex w-full flex-col sm:flex-row justify-between gap-8">
                <div class="flex flex-col w-full">
                    <label class="text-black font-sans leading-4 tracking-tight"><?php echo ($teacherRow['role'] == "Teacher") ? "First Name" : "Institute Name" ?></label>
                    <data class="flex items-center border-2 rounded-md border-[#E5E5E5] mt-3 w-full h-10 px-4" disabled>
                        <?php echo $teacherRow['firstName']; ?>
                    </data>
                </div>
                <?php 
                    if($teacherRow['role'] == "Teacher")
                    {
                ?>
                        <div class="flex flex-col w-full">
                            <label class="text-black font-sans leading-4 tracking-tight">Last Name</label>
                            <data class="flex items-center border-2 rounded-md border-[#E5E5E5] mt-3 w-full h-10 px-4" disabled>
                                <?php echo $teacherRow['lastName']; ?>
                            </data>
                        </div>
                <?php } ?>
            </div>

            <div class="flex w-full justify-between gap-8">
                <div class="flex flex-col w-full">
                    <label class="text-black font-sans leading-4 tracking-tight">Contact Number</label>
                    <data class="flex items-center border-2 rounded-md border-[#E5E5E5] mt-3 w-full h-10 px-4" disabled>
                        <?php echo $teacherRow['phoneNumber']; ?>
                    </data>
                </div>
            </div>

            <div class="flex w-full justify-between gap-8">
                <div class="flex flex-col w-full">
                    <label class="text-black font-sans leading-4 tracking-tight">Email</label>
                    <data class="flex items-center border-2 rounded-md border-[#E5E5E5] mt-3 w-full h-10 px-4" disabled>
                        <?php echo $teacherRow['email']; ?>
                    </data>
                </div>
            </div>

            <?php
                if($teacherRow['address'] != "" || $teacherRow['mapLink'] != "")
                {
            ?>
                    <div class="uppercase font-bold text-lg">Address</div>

                    <div class="w-full">
                        <img class="w-full" src="./Img/Rectangle 21.png" alt="" />
                    </div>

                    <div class=" w-full justify-between gap-8 z-10">
                        <?php 
                            if($teacherRow['mapLink']!="")
                            {
                        ?>
                                <a target="_blank"  href="<?php echo $teacherRow['mapLink'];?>" class="w-full capitalize font-medium text-blue-500">
                                    Show location
                                    <i class="fa-solid fa-location-dot"></i>
                                </a>
                        <?php 
                            }
                        ?>
                        <div class="capitalize flex flex-col w-full">
                            <textarea class="border-2 bg-white/50 outline-none rounded-md border-[#E5E5E5] mt-3 w-full h-24 z-10 backdrop-blur-sm p-2" value="" type="text" disabled><?php echo $teacherRow['address'];?></textarea>
                        </div>
                    </div>
            <?php } ?>

            <?php
                if($teacherRow['about'] != "")
                {
            ?>
                    <div class="uppercase font-bold text-lg">About</div>

                    <div class="w-full">
                        <img class="w-full" src="./Img/Rectangle 21.png" alt="" />
                    </div>

                    <div class="capitalize flex flex-col w-full">
                        <textarea class="border-2 bg-white/50 outline-none rounded-md border-[#E5E5E5] mt-3 w-full h-24 z-10 backdrop-blur-sm p-2" value="" type="text" disabled><?php echo $teacherRow['about'];?></textarea>
                    </div>
            <?php } ?>
        </div>
    </div>
    <div class="w-full h-96 justify-between relative mt-2">
        <img class="absolute bottom-8 h-[30rem] w-[10rem] sm:w-auto left-0" src="./Img/profilepage/profileImage2.svg" alt="" />
        <img class="absolute bottom-20 h-[30rem] w-[10rem] sm:w-auto right-0" src="./Img/profilepage/profileImage1.svg" alt="" />
    </div>
    <section id="tableArea" class="hidden fixed top-0 left-0 z-30 h-screen backdrop-blur-sm w-screen bg-black/50">
        <div class="overflow-hidden rounded-lg absolute top-40 left-0 right-0 w-96 mx-auto bg-white backdrop-blur-md shadow-md z-30 py-8">
            <div id="tableSection"  class="tableArea h-[35rem] mx-auto bg-white z-30 overflow-y-auto">
                <table class="tableArea mx-auto w-[90%] border-2 rounded-lg border-black/50">
                    <tr class="border-2 border-black/50">
                        <th class="p-4 border-2 border-black/50">Class</th>    
                        <th class="p-4 border-2 border-black/50">Subject</th>
                    </tr>
                    <?php
                        $classSubjquery = "SELECT * FROM `teacher-cls-subj`
                        INNER JOIN `subject-table` ON `subject-table`.`id`=`teacher-cls-subj`.`subjectId`
                        INNER JOIN `class-table` ON `class-table`.`id`=`teacher-cls-subj`.`classId`
                        WHERE `teacherId`='$id'";
                        $resarr = mysqli_query($connection,$classSubjquery);

                        while($rowarr = mysqli_fetch_array($resarr))
                        {
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
        </div>
    </section>
</profile>
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
    include("footer.php");
    include("foot.php");
?>