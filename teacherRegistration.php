<?php
include("header.php");
include("connection.php");
session_start();
if(isset($_SESSION['teacherId'])){

    $sessionTeacherId = $_SESSION['teacherId'];
}
else if(isset($_SESSION['admin'])){
    $admin=true;
}
else{
    header("Location: index.php");
}
$updateTeacher = false;
if(isset($_REQUEST['updateTeacherProfile'])&& $_REQUEST['updateTeacherProfile']==$sessionTeacherId)
{
    $updateTeacher = true;
    $query0 = "SELECT * FROM `teacher-table` WHERE `id`='$sessionTeacherId'";
    $res0 = mysqli_query($connection,$query0);
    $rowarr0 = mysqli_fetch_array($res0);
}

$query1 = "SELECT * FROM `class-table`";
$res1 = mysqli_query($connection, $query1);
$query2 = "SELECT * FROM `subject-table`";
$res2 = mysqli_query($connection, $query2);


?>
<header class="">
        <nav
      class="flex justify-between h-16 items-center bg-white fixed z-30 top-0 left-0 w-full px-10 md:px-8 lg:px-20 shadow-sm"
    >
      <!-- logoArea -->
      <h1 class="text-xl font-semibold">
        Admin Dashboard
      </h1>
      <!-- tabArea -->
      <div
        id="navTabs"
        class="flex text-center white md:bg-transparent z-0 md:z-10 absolute top-16 duration-500 left-[-100vw] md:static w-72 h-screen md:h-auto bg-white md:w-auto flex-col md:flex-row md:gap-[4vw] gap-[8vw] py-[2vw] md:py-0 font-poppins font-medium text-base select-none shadow-2xl md:shadow-none"
      >
        
        <a href="adminTeacherTable.php"
          ><div class="hover:underline underline-offset-4 leading-[3rem]">
            Teachers
          </div></a
        >
        
        <a href="teacherRegistration.php"
          ><div class="hover:underline underline-offset-4 leading-[3rem]">
            Register a Teacher
          </div></a
        >
        
        <a class="mx-auto md:mx-0" href="logout.php"
          ><div
            class="bg-[#3461FF] h-12 w-32 leading-[3rem] text-white rounded-full"
          >
            Logout
          </div></a
        >
      </div>
      <div class="md:hidden">
        <i
          class="fa-solid fa-bars text-lg cursor-pointer"
          onclick="menuToggleBtn(this)"
        ></i>
      </div>
    </nav>
    </header>
<div style="margin-top:4%">
    <!--@ left side form -->
    <div class="lg:w-3/5 w-full z-10 bg-white/50 backdrop-blur-sm py-8 px-4">
        <!-------Headings------->
        <div class="flex gap-10 lg:mx-12 mx-0 w-full flex-col md:flex-row">
            <div class=" font-bold font-sans text-4xl w-1/2">Teacher's<br>
            <?php 
                if($updateTeacher){
                    echo "Updation";
                }
                else{
                    echo "Registration";
                }
            ?>
        
        </br>form</div>
            <div class="md:w-1/2 w-3/5 ">We need you to help us with some basic <br>information for your profile creation. Here are our</br><span class="text-blue-600 font-bold">terms and conditions.</span> Please read them carefully.</br></div>
        </div>

        <img src=" ./Img/Line 7.svg" alt="" class="lg:mx-12 mx-0 mt-10 w-[48rem]">
        <!-- Main form -->
        <div class="flex flex-col mt-10 lg:mx-12 mx-0 w-full gap-10">
            <!--* row 1 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <label for="firstName" class=" font-semibold w-full">First name</label>
                    <input type="text" id="firstName" placeholder=" First name" name="firstName" class=" h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off" value="<?php 
                    if($updateTeacher){
                       echo $rowarr0['firstName'];
                    }
                    ?>">
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <label class="font-semibold">Last name</label>
                    <input type="text" id="lastName" placeholder=" Last name" name="lastName" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off"
                    value="<?php 
                    if($updateTeacher){
                       echo $rowarr0['lastName'];
                    }
                    ?>">
                </div>
            </div>
            <!--* row 2 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <label class=" font-semibold w-full">Phone number</label>
                    <input type="number" placeholder="Enter your Ph.no" name="phoneNumber" class=" h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" id="phoneNumber" autocomplete="off"
                    value="<?php 
                    if($updateTeacher){
                       echo $rowarr0['phoneNumber'];
                    }
                    ?>">
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <label class="font-semibold">Email</label>
                    <input type="email" placeholder="Enter your mail" name="studLName" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" id="email" autocomplete="off"
                    value="<?php 
                    if($updateTeacher){
                       echo $rowarr0['email'];
                    }
                    ?>">
                </div>
            </div>
            <!--* row 3 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <label for="gender" class=" font-semibold w-full">Gender</label>
                    <select name="gender" id="gender" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md">
                        <option class="capitalize text-black/50" selected value="">Select your gender</option>
                        <option class="" value="Male" <?php 
                            if($updateTeacher && $rowarr0['gender']=="Male" ){
                                echo "selected";
                            }
                    ?> >Male</option>
                        <option class="" value="Female" <?php 
                            if($updateTeacher && $rowarr0['gender']=="Female" ){
                                echo "selected";
                            }
                    ?> >Female</option>
                        <option class="" value="Others" <?php 
                            if($updateTeacher && $rowarr0['gender']=="Others" ){
                                echo "selected";
                            }
                    ?> >Others</option>
                    </select>
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <label class="font-semibold">Age</label>
                    <input type="number" placeholder="Enter your age" name="age" id="age" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" value="<?php 
                    if($updateTeacher){
                       echo $rowarr0['age'];
                    }
                    ?>">
                </div>
            </div>
            <!--* row 4 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label class=" font-semibold">Experience(optional)</label>
                        <img src=" ./Img/Vector.svg" alt="" class="h-5 " title="(Enter in terms of year eg: enter 4 for 4 years)">

                    </div>
                    <input id="experience" type="number" placeholder="Enter your experience" name="experience" class=" h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off" value="<?php 
                    if($updateTeacher){
                       echo $rowarr0['experience'];
                    }
                    ?>">
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label class=" font-semibold">Qualificaiton</label>
                        <img src=" ./Img/Vector.svg" alt="" class="h-5 " title="(eg: B.tech, M.Tech)">

                    </div>
                    <input id="qualification" type="text" placeholder="Enter your Qualification" name="qualification" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off" value="<?php 
                    if($updateTeacher){
                       echo $rowarr0['qualification'];
                    }
                    ?>">
                </div>
            </div>
            <!--* row 4.1 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label class=" font-semibold">Locality</label>
                        <img src=" ./Img/Vector.svg" alt="" class="h-5 " title="eg:Sector V, Naihati, Kharda etc.">

                    </div>
                    <input id="locality" type="text" placeholder="Enter your locality" name="experience" class="capitalize h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off" value="<?php 
                    if($updateTeacher){
                       echo $rowarr0['locality'];
                    }
                    ?>">
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label class=" font-semibold">Google map link</label>
                        <img src=" ./Img/Vector.svg" alt="" class="h-5 " title="Click on share after selecting your google map location and paste the link here">

                    </div>
                    <input id="googleMapLink" type="text" placeholder="ex: https://maps.app.goo.gl/...." class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off" value="<?php 
                    if($updateTeacher){
                       echo $rowarr0['mapLink'];
                    }
                    ?>">
                </div>
            </div>
            <!--* row 5 -->
            <div class="flex gap-10 w-full justify-between md:flex-row flex-col">
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <label class=" font-semibold">Address</label>
                        <img src=" ./Img/Vector.svg" alt="" class="h-5 " title="Full address with pin number">

                    </div>
                    <input id="address" type="text" placeholder="Enter your Complete Address" name="studFName" class=" h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" autocomplete="off" value="<?php 
                    if($updateTeacher){
                       echo $rowarr0['address'];
                    }
                    ?>">
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <label class="font-semibold">State</label>
                    <input type="text" placeholder="Enter your State" name="studLName" class="h-16 w-full outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md" id="state" autocomplete="off" value="<?php 
                    if($updateTeacher){
                       echo $rowarr0['state'];
                    }
                    ?>">
                </div>
            </div>
            <!--* row 6 (line img) -->
            <img src=" ./Img/Line 7.svg" alt="" class=" mt-5 w-[48rem] mb-5">
            <!--* row 7 -->
            <div id="cloningElement" class="relative flex gap-10 w-full justify-between md:flex-row flex-col">
                <?php
                if($updateTeacher) 
                {
                    $queryClsSubj0 = "SELECT * FROM `teacher-cls-subj` WHERE `teacherId` = '$sessionTeacherId'";
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
                <img id="delRow" class="hidden delRow md:static absolute top-0 right-0 cursor-pointer h-4 pt-0 md:pt-8 md:h-auto md:w-auto w-4 my-auto" src=" ./Img/ui-buttons/cross.svg" alt="" onclick="deleteThis(this)">
            </div>
            <!--* row-undefined-cloning area -->
            <div id="cloningArea" class="flex gap-10 w-full justify-between  flex-col">
            <?php 
               if($updateTeacher){ 
                $rowCount = 0;
                
                while($rowClsSubj0 = mysqli_fetch_array($resClsSubj0)){
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
            <!--* row 8(addrow btn)  -->
            <div class="flex flex-col gap-4 w-full">
                <button id="addRow" class="<?php if($updateTeacher&&$rowCount==4){echo "hidden";}?> h-16 w-48 outline-none border-2 border-black/20 px-4 bg-transparent backdrop-blur-md text-lg">Add row</button>
            </div>
            <!--* row 9 (submit section) -->
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
        <img src=" ./Img/Layer 12.svg" alt="" class="fixed top-0 right-0 h-screen -z-10 ">
    </div>
</div>
<?php
include("footer.php");

?>