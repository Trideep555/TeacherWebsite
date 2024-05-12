<?php
    include("head.php");
    include("connection.php");
    session_start();
    if(isset($_SESSION['admin']))
    {
        $admin=true;
    }
    else
    {
        @header("location: index.php");
    }
    $profileImage = "";
    $updateTeacher = false;
    if(isset($_REQUEST['id']))
    {
        $id=$_REQUEST['id'];
        $updateTeacher = true;

        $query = "SELECT * FROM `teacher-table` WHERE `id`= '$id'";
        $res = mysqli_query($connection,$query);
        $rowarr = mysqli_fetch_array($res);

        $query = "SELECT * FROM `profile-image-table` WHERE `id` = '$id'";
        $res = mysqli_query($connection,$query);
        $profileImage = mysqli_fetch_array($res)['profileImagePath'];
    }

$query1 = "SELECT * FROM `class-table`";
$res1 = mysqli_query($connection, $query1);
$query2 = "SELECT * FROM `subject-table`";
$res2 = mysqli_query($connection, $query2);
?>
<header class="">
    <nav class="flex justify-between h-16 items-center bg-white fixed z-30 top-0 left-0 w-full px-10 md:px-8 lg:px-20 shadow-sm">
        <!-- logoArea -->
        <h1 class="text-xl font-semibold">Admin Dashboard</h1>
        <!-- tabArea -->
        <div id="navTabs" class="flex text-center white md:bg-transparent z-0 md:z-10 absolute top-16 duration-500 left-[-100vw] md:static w-72 h-screen md:h-auto bg-white md:w-auto flex-col md:flex-row md:gap-[4vw] gap-[8vw] py-[2vw] md:py-0 font-poppins font-medium text-base select-none shadow-2xl md:shadow-none">
            <a href="adminDashboard.php">
                <div class="hover:underline underline-offset-4 leading-[3rem]">Dashboard</div>
            </a>
            <a href="teacherRegistration.php">
                <div class="hover:underline underline-offset-4 leading-[3rem]">Register a Teacher</div>
            </a>
            <a class="mx-auto md:mx-0" href="logout.php">
                <div class="bg-[#3461FF] h-12 w-32 leading-[3rem] text-white rounded-full">Logout</div>
            </a>
        </div>
        <div class="md:hidden">
            <i class="fa-solid fa-bars text-lg cursor-pointer" onclick="menuToggleBtn(this)"></i>
        </div>
    </nav>
</header>
<div style="margin-top:75px">
    <!--@ left side form -->
    <div class="lg:w-3/5 w-full z-10 bg-white/50 backdrop-blur-sm py-8 px-4">
        <!-------Headings------->
        <div class="flex gap-10 lg:mx-12 mx-0 w-full flex-col md:flex-row">
            <div class=" font-bold font-sans text-4xl w-1/2">
                <?php 
                    if($updateTeacher)
                    {
                        echo "Updation";
                    }
                    else
                    {
                        echo "Registration";
                    }
                ?>
                </br>
                Form
            </div>
            <div class="md:w-1/2 w-3/5 ">We need you to help us with some basic <br>information for your profile creation. Here are our</br><span class="text-blue-600 font-bold"><a href="tcs.php">terms and conditions.</a></span> Please read them carefully.</br></div>
        </div>

        <img src=" ./Img/Line 7.svg" alt="" class="lg:mx-12 mx-0 mt-10 w-[48rem]">
        <!-- Main form -->
        <div class="flex flex-col mt-10 lg:mx-12 mx-0 w-full gap-10">
            <input type="hidden" id="targetId" value="<?php if($updateTeacher){ echo $id; } ?>">

            <div class="flex justify-center mt-4">
                
            </div>

            <!-- row 0 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex gap-4 w-full">
                    <label class="font-semibold">Register: </label>
                    <label for="teacher">Teacher</label>
                    <input type="radio" id="teacher" name="reg-type" class="outline-none border-2 border-black/20 px-4" <?php if($updateTeacher){if($rowarr['role'] == "Teacher"){echo "checked";}}else{echo "checked";} ?> autocomplete="off" value="Teacher" onclick="checkRegType(this)">
                    <label for="teacher">Institute</label>
                    <input type="radio" id="institute" name="reg-type" class="outline-none border-2 border-black/20 px-4" <?php if($updateTeacher && $rowarr['role'] == "Institute"){echo "checked";} ?> autocomplete="off" value="Institute" onclick="checkRegType(this)">
                </div>
            </div>

            <!-- row 1 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex gap-4 items-center w-full">
                    <label class="font-semibold text-2xl">Profile Image: </label>
                    <div class="group/imgOverlay flex justify-center items-center relative">
                        <img id="profileImage" style="border: 3px solid rgb(0 0 0 / 0.5);" class=" h-[4.5rem] w-[4.5rem] rounded-full" src="<?php echo (($profileImage == NULL || !$updateTeacher)?"./Img/user.png":$profileImage); ?>" alt=""/>

                        <label for="upload-dp">
                            <div class="group-hover/imgOverlay:block hidden  bg-black/30  h-[4.5rem] w-[4.5rem] rounded-full absolute top-0 left-0 text-white text-center font-semibold cursor-pointer py-3">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <div>Upload</div>
                            </div>
                        </label>
                        <input class="hidden" type="file" name="upload-dp" id="upload-dp">
                    </div>

                    <button class="hover:bg-red-500 bg-rose-500 px-2 py-1 text-white font-medium rounded-lg cursor-pointer" id="removeProfile">Remove</button>

                    <?php 
                        if($updateTeacher)
                        {

                    ?>
                            <button class="hover:bg-red-500 bg-rose-500 px-2 py-1 text-white font-medium rounded-lg cursor-pointer" id="cancelPIChanges">Cancel</button>
                    <?php } ?>
                </div>
            </div>

            <!-- row 2 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label for="firstName" class="font-semibold w-full">First Name</label>
                        <label style="color: #9ca3af;" class="font-semibold" title="Maximum number of characters. Exceeding this will truncate the remaining.">*required</label>
                    </div>
                    <input type="text" id="firstName" placeholder="First name" name="firstName" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off" value="<?php 
                    if($updateTeacher){ echo $rowarr['firstName']; } ?>">
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label for="lastName" class="font-semibold">Last name</label>
                        <label for="lastName" style="color: #9ca3af;" class="font-semibold" title="Maximum number of characters. Exceeding this will truncate the remaining.">*required</label>
                    </div>
                    <input type="text" id="lastName" placeholder="Last name" name="lastName" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off"
                    value="<?php if($updateTeacher){ echo $rowarr['lastName']; } ?>">
                </div>
            </div>

            <!-- row 3 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label class=" font-semibold w-full">Phone number</label>
                        <label style="color: #9ca3af;" class="font-semibold" title="Maximum number of characters. Exceeding this will truncate the remaining.">*required</label>
                    </div>
                    <input type="number" placeholder="Enter your Ph.no" name="phoneNumber" class=" h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" id="phoneNumber" autocomplete="off"
                    value="<?php 
                    if($updateTeacher){ echo $rowarr['phoneNumber']; } ?>">
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <label class="font-semibold">Email</label>
                    <input type="email" placeholder="Enter your mail" name="studLName" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" id="email" autocomplete="off"
                    value="<?php 
                    if($updateTeacher){ echo $rowarr['email']; } ?>">
                </div>
            </div>

            <!-- row 4 -->
            <div id="row-3" class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label for="gender" class=" font-semibold w-full">Gender</label>
                        <label style="color: #9ca3af;" class="font-semibold" title="Maximum number of characters. Exceeding this will truncate the remaining.">*required</label>
                    </div>
                    <select name="gender" id="gender" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md">
                        <option class="capitalize text-black/50" selected value="">Select your gender</option>
                        <option class="" value="Male" <?php 
                            if($updateTeacher && $rowarr['gender']=="Male" ){
                                echo "selected";
                            }
                    ?> >Male</option>
                        <option class="" value="Female" <?php 
                            if($updateTeacher && $rowarr['gender']=="Female" ){
                                echo "selected";
                            }
                    ?> >Female</option>
                        <option class="" value="Others" <?php 
                            if($updateTeacher && $rowarr['gender']=="Others" ){
                                echo "selected";
                            }
                    ?> >Others</option>
                    </select>
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <label class="font-semibold">Age</label>
                    <input type="number" placeholder="Enter your age" name="age" id="age" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" value="<?php if($updateTeacher){ echo $rowarr['age']; } ?>">
                </div>
            </div>

            <!-- row 5 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label class=" font-semibold">Experience</label>
                    </div>
                    <input id="experience" type="number" placeholder="Enter your experience" name="experience" class=" h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off" value="<?php 
                    if($updateTeacher){
                       echo $rowarr['experience'];
                    }
                    ?>">
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label for="mode" class=" font-semibold w-full">Mode of Teaching</label>
                        <label style="color: #9ca3af;" class="font-semibold" title="Maximum number of characters. Exceeding this will truncate the remaining.">*required</label>
                    </div>
                    <select name="mode" id="mode" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md">
                        <option class="capitalize text-black/50" selected value="">Select mode of teaching</option>
                        <option class="" value="Online" <?php 
                            if($updateTeacher && $rowarr['mode'] === "Online" ){
                                echo "selected";
                            }
                        ?>>Online</option>
                        <option class="" value="Offline" <?php 
                            if($updateTeacher && $rowarr['mode'] === "Offline" ){
                                echo "selected";
                            }
                        ?> >Offline</option>
                        <option class="" value="Online/Offline" <?php 
                            if($updateTeacher && $rowarr['mode'] === "Online/Offline" ){
                                echo "selected";
                            }
                        ?> >Online/Offline</option>
                    </select>
                </div>
            </div>

            <!-- row 6 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label class="font-semibold">Locality</label>
                        <label for="locality"style="color: #9ca3af;" class="font-semibold" title="Maximum number of characters. Exceeding this will truncate the remaining.">*required</label>
                    </div>
                    <input id="locality" type="text" placeholder="Enter your locality" name="experience" class="capitalize h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off" value="<?php 
                    if($updateTeacher){
                       echo $rowarr['locality'];
                    }
                    ?>">
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label class=" font-semibold">Google Map Link</label>
                    </div>
                    <input id="googleMapLink" type="text" placeholder="ex: https://maps.app.goo.gl/...." class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off" value="<?php 
                    if($updateTeacher){
                       echo $rowarr['mapLink'];
                    }
                    ?>">
                </div>
            </div>

            <!-- row 7 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label class=" font-semibold">Address</label>
                        <label for="address" style="color: #9ca3af;" class="font-semibold" title="Maximum number of characters. Exceeding this will truncate the remaining.">*required</label>
                    </div>
                    <input id="address" type="text" placeholder="Enter your Complete Address" name="studFName" class=" h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off" value="<?php 
                    if($updateTeacher){
                       echo $rowarr['address'];
                    }
                    ?>">
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label class="font-semibold">State</label>
                        <label for="state" style="color: #9ca3af;" class="font-semibold" title="Maximum number of characters. Exceeding this will truncate the remaining.">*required</label>
                    </div>
                    <input type="text" placeholder="Enter your State" name="studLName" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" id="state" autocomplete="off" value="<?php 
                    if($updateTeacher){
                       echo $rowarr['state'];
                    }
                    ?>">
                </div>
            </div>

            <!-- row 8 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label class="font-semibold">About</label>
                        <label style="color: #9ca3af;" class="font-semibold" title="Maximum number of characters. Exceeding this will truncate the remaining.">2000 Characters Max</label>
                    </div>
                    <textarea placeholder="Write about you" style="min-height: 4rem;" class="h-16 w-full outline-none border-2 border-black/20 px-4 py-4 bg-transparent backdrop-blur-md" id="about" autocomplete="off"><?php 
                    if($updateTeacher){
                       echo $rowarr['about'];
                    }
                    ?></textarea>
                </div>
            </div>

            <!-- row 9 -->
            <img src=" ./Img/Line 7.svg" alt="" class=" mt-5 w-[48rem] mb-5">

            <!-- row 10 -->
            <div id="cloningElement" class="relative flex gap-10 w-full justify-between md:flex-row flex-col">
                <?php
                    if($updateTeacher) 
                    {
                        $queryClsSubj0 = "SELECT * FROM `teacher-cls-subj` WHERE `teacherId` = '$id'";
                        $resClsSubj0 = mysqli_query($connection,$queryClsSubj0);
                        $rowClsSubj0 = mysqli_fetch_array($resClsSubj0);

                    }
                ?>
                <div class="flex flex-col gap-4 w-full">
                    <label class=" font-semibold w-full">Class</label>
                    <select name="classes" id="classes" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md">
                        <option class="capitalize text-black/50" selected value="null">Select your Class</option>
                        <?php
                        while ($rowarr1 = mysqli_fetch_array($res1)) {
                        ?>
                            <option value="<?php echo $rowarr1['id']; ?>"<?php if($updateTeacher){if($rowarr1['id']==$rowClsSubj0['classId']){echo "selected";}}?> ><?php echo $rowarr1['className']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class=" flex flex-col gap-4 w-full">
                    <div class=" flex justify-between w-full">
                        <label class=" font-semibold w-full">Subject</label>

                    </div>
                    <select name="subjects" id="subjects" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md">
                        <option class="capitalize text-black/50" selected value="null">Select your subject</option>
                        <?php
                        while ($rowarr2 = mysqli_fetch_array($res2)) {
                        ?>
                            <option value="<?php echo $rowarr2['id']; ?>"<?php if($updateTeacher){if($rowarr2['id']==$rowClsSubj0['subjectId']){echo "selected";}}?> ><?php echo $rowarr2['subjectName']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <img id="delRow" class="delRow md:static absolute top-0 right-0 cursor-pointer h-4 pt-0 md:pt-8 md:h-auto md:w-auto w-4 my-auto" src=" ./Img/ui-buttons/cross.svg" alt="" onclick="deleteThis(this)" style="display: none;">
            </div>
            <!--* row-undefined-cloning area -->
            <div id="cloningArea" class="flex gap-10 w-full justify-between  flex-col">
                <?php 
                if($updateTeacher)
                { 
                        $rowCount = 0;
                        
                        while($rowClsSubj0 = mysqli_fetch_array($resClsSubj0))
                        {
                            $rowCount++;
                            $query1 = "SELECT * FROM `class-table`";
                            $res1 = mysqli_query($connection, $query1);
                            $query2 = "SELECT * FROM `subject-table`";
                            $res2 = mysqli_query($connection, $query2);
                ?> 
                            <div id="cloningElement" class="relative flex gap-10 w-full justify-between md:flex-row flex-col">
                                <div class="flex flex-col gap-4 w-full">
                                    <label class=" font-semibold w-full">Class</label>
                                    <select name="classes" id="classes" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md">
                                        <option class="capitalize text-black/50" selected value="null">Select your Class</option>
                                        <?php
                                        while ($rowarr1 = mysqli_fetch_array($res1)) {
                                        ?>
                                            <option value="<?php echo $rowarr1['id']; ?>"<?php if($rowarr1['id']==$rowClsSubj0['classId']){echo "selected";}?> ><?php echo $rowarr1['className']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class=" flex flex-col gap-4 w-full">
                                    <div class=" flex justify-between w-full">
                                        <label class=" font-semibold w-full">Subject</label>

                                    </div>
                                    <select name="subjects" id="subjects" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md">
                                        <option class="capitalize text-black/50" selected value="null">Select your subject</option>
                                        <?php
                                        while ($rowarr2 = mysqli_fetch_array($res2)) {
                                        ?>
                                            <option value="<?php echo $rowarr2['id']; ?>"<?php if($rowarr2['id']==$rowClsSubj0['subjectId']){echo "selected";}?> ><?php echo $rowarr2['subjectName']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <img id="delRow" class="delRow md:static absolute top-0 right-0 cursor-pointer h-4 pt-0 md:pt-8 md:h-auto md:w-auto w-4 my-auto" src=" ./Img/ui-buttons/cross.svg" alt="" onclick="deleteThis(this)">
                            </div>
                <?php
                        }
                    }
                ?>
            </div>

            <!-- row 11  -->
            <div class="flex flex-col gap-4 w-full">
                <button id="addRow" class="h-16 w-48 outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md text-lg">Add row</button>
            </div>

            <!-- row 12 -->
            <div class=" flex flex-col gap-8 sm:flex-row justify-between w-full pb-8">
                <div class=" flex flex-row gap-4 mt-8">
                    <input id="tnc" type="checkbox" class="h-4 w-4">
                    <label for="tnc" class="leading-3">I accept the <span class="text-blue-600 font-bold">terms and conditions</span></label>
                </div>
                <div class="">
                    <input id="<?php 
                    if($updateTeacher){
                        echo "teacherUpdateSubBtn";
                    }else{
                        echo "teacherRegSubBtn";
                    }
                    ?>" type="submit" class="rounded-3xl bg-blue-600 text-white font-bold h-12 w-full sm:w-60 cursor-pointer " value="<?php 
                    if($updateTeacher){
                        echo "Update";
                    }
                    else{
                        echo "Register";
                    }
                    
                    ?>">
                </div>
            </div>

        </div>
    </div>
    <!--@ right side image -->
    <div class="w-2/5">
        <img src=" ./Img/Layer 12.svg" alt="" class="fixed top-0 right-0 h-screen -z-10 mt-20">
    </div>
</div>
<?php
    include("foot.php");
?>
<script src="./js/profile-upload-function.js"></script>