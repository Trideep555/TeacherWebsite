<?php 
    include("connection.php");
    session_start();
    include("adminCheck.php");
    include("head.php");
?>

<!-- toogle switch css -->
<style>
    .switch
    {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30px;
    }
    .switch > input
    { 
        opacity: 0;
        width: 0;
        height: 0;
    }
    .slider
    {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgb(244, 63, 94);
        -webkit-transition: .4s;
        transition: .4s;
    }
    .slider:before
    {
        position: absolute;
        content: "";
        height: 22.5px;
        width: 22.5px;
        left: 4.5px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }
    input:checked + .slider
    {
        background-color: rgb(0, 200, 0);
    }
    input:focus + .slider
    {
        box-shadow: 0 0 1px #2196F3;
    }
    input:checked + .slider:before
    {
        -webkit-transform: translateX(28px);
        -ms-transform: translateX(28px);
        transform: translateX(28px);
    }
    .slider.round
    {
        border-radius: 34px;
    }
    .slider.round:before
    {
        border-radius: 50%;
    }
    #carousel-count:focus
    {
        outline: none;
    }
</style>


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


<main class="mt-16 overflow-auto px-10 md:px-8 lg:px-20">
    <h1 class="text-6xl w-full my-8">Welcome</h1>
    <?php
        $query = "SELECT * FROM `teacher-table` JOIN `banner-image-table` on `teacher-table`.`id` = `banner-image-table`.`id` WHERE `role` = 'Teacher'";
        $resT = mysqli_query($connection,$query);
        $query = "SELECT * FROM `teacher-table` JOIN `banner-image-table` on `teacher-table`.`id` = `banner-image-table`.`id` WHERE `role` = 'Institute'";
        $resI = mysqli_query($connection,$query);
        if(mysqli_num_rows($resT)==0)
        {
    ?>
            <div class="text-4xl font-semibold capitalize my-4 text-center">No Teachers Yet</div>
    <?php
        }
        else
        {
    ?>
            <h1 class="text-2xl w-full my-4">Teachers</h1>
            <table class="w-[64rem] lg:w-full">
                <tr class="">
                    <th colspan="10" class="border-2 border-black/50">Details</th>
                    <th colspan="2" class="border-2 border-black/50">Teacher</th>
                    <th colspan="2" class="border-2 border-black/50">Banner</th>
                </tr>
                <tr class="">
                    <th class="border-2 border-black/50">First Name</th>
                    <th class="border-2 border-black/50">Last Name</th>
                    <th class="border-2 border-black/50">Phone number</th>
                    <th class="border-2 border-black/50">Email</th>
                    <th class="border-2 border-black/50">Gender</th>
                    <th class="border-2 border-black/50">Age</th>
                    <th class="border-2 border-black/50">Experience</th>
                    <th class="border-2 border-black/50">Mode</th>
                    <th class="border-2 border-black/50">Locality</th>
                    <th class="border-2 border-black/50">Address</th>
                    <th class="border-2 border-black/50">Activity</th>
                    <th class="border-2 border-black/50">Action</th>
                    <th class="border-2 border-black/50">Activity</th>
                    <th class="border-2 border-black/50">Action</th>
                </tr>
                <?php 
                    while($rowarr = mysqli_fetch_array($resT))
                    {
                ?>
                        <tbody class="h-8 overflow-hidden">
                            <tr class="h-12 overflow-hidden">
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['firstName']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['lastName']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['phoneNumber']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['email']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['gender']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['age']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['experience']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['mode']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['locality']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1 w-60">
                                    <div class="h-12"><?php echo $rowarr['address']; ?></div>
                                </td>
                                <!-- enable/disable teacher -->
                                <td class="border-2 border-black/50 text-center px-1 py-1">
                                    <label class="switch">
                                        <input type="checkbox" <?php echo ($rowarr['activity']==1)?'checked':''; ?> onclick="location.href='updateChanges.php?id=<?php echo $rowarr['id']; ?>&type=teacher'">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <!-- delete/edit teacher -->
                                <td class="border-2 border-black/50 text-center px-1 py-1">
                                    <a class="hover:bg-red-500 bg-rose-500 px-2 py-1 text-white font-medium rounded-lg cursor-pointer" onclick="confirmDelete(<?php echo $rowarr['id']; ?>,0)">Delete</a>
                                    <a class="bg-[#3461FF] py-1 px-2 text-white font-medium rounded-lg cursor-pointer" href="teacherRegistration.php?id=<?php echo $rowarr['id']; ?>">Edit</a>
                                </td>



                                <!-- enable/disable teacher banner -->
                                <td class="border-2 border-black/50 text-center px-1 py-1">
                                    <label class="switch">
                                        <input type="checkbox" <?php echo ($rowarr['bannerActivity']==1)?'checked':''; ?> onclick="location.href='updateChanges.php?id=<?php echo $rowarr['id']; ?>&type=banner'">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <!-- delete/upload teacher banner -->
                                <td class="border-2 border-black/50 text-center px-1 py-1">
                                    <?php
                                        if($rowarr['bannerPath'] == NULL)
                                        {
                                    ?>
                                            <label for="banner-upload" class="hover:bg-emerald-500 bg-green-500 px-4 py-1 text-white font-medium rounded-lg cursor-pointer">
                                                <input type="file" id="banner-upload" class="hidden" target="<?php echo $rowarr['id']; ?>">
                                                Add
                                            </label>
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                            <a class="hover:bg-red-500 bg-rose-500 px-2 py-1 text-white font-medium rounded-lg cursor-pointer" onclick="confirmDelete(<?php echo $rowarr['id']; ?>,1)">Delete</a>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                <?php
                    }
                ?>
            </table>
    <?php
        }
    ?>
    <img src=" ./Img/Line 11.png" alt="" class="mt-5 w-full mb-5" style="height: 0.2rem;">
    <?php
        if(mysqli_num_rows($resI)==0)
        {
    ?>
            <div class="text-4xl font-semibold capitalize my-4 text-center">No Institutes Yet</div>
    <?php
        }
        else
        {
    ?>
            <h1 class="text-2xl w-full my-4">Institutes</h1>
            <table class="w-[64rem] lg:w-full">
                <tr class="">
                    <th colspan="7" class="border-2 border-black/50">Details</th>
                    <th colspan="2" class="border-2 border-black/50">Institute</th>
                    <th colspan="2" class="border-2 border-black/50">Banner</th>
                </tr>
                <tr class="">
                    <th class="border-2 border-black/50">Institute Name</th>
                    <th class="border-2 border-black/50">Phone number</th>
                    <th class="border-2 border-black/50">Email</th>
                    <th class="border-2 border-black/50">Experience</th>
                    <th class="border-2 border-black/50">Mode</th>
                    <th class="border-2 border-black/50">Locality</th>
                    <th class="border-2 border-black/50">Address</th>
                    <th class="border-2 border-black/50">Activity</th>
                    <th class="border-2 border-black/50">Action</th>
                    <th class="border-2 border-black/50">Activity</th>
                    <th class="border-2 border-black/50">Action</th>
                </tr>
                <?php 
                    while($rowarr = mysqli_fetch_array($resI))
                    {
                ?>
                        <tbody class="h-8 overflow-hidden">
                            <tr class="h-12 overflow-hidden">
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['firstName']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['phoneNumber']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['email']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['experience']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['mode']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['locality']; ?></td>
                                <td class="border-2 border-black/50 text-center px-4 py-1 w-60">
                                    <div class="h-12"><?php echo $rowarr['address']; ?></div>
                                </td>
                                <!-- enable/disable teacher -->
                                <td class="border-2 border-black/50 text-center px-1 py-1">
                                    <label class="switch">
                                        <input type="checkbox" <?php echo ($rowarr['activity']==1)?'checked':''; ?> onclick="location.href='updateChanges.php?id=<?php echo $rowarr['id']; ?>&type=institute'">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <!-- delete/edit teacher -->
                                <td class="border-2 border-black/50 text-center px-1 py-1">
                                    <a class="hover:bg-red-500 bg-rose-500 px-2 py-1 text-white font-medium rounded-lg cursor-pointer" onclick="confirmDelete(<?php echo $rowarr['id']; ?>,0)">Delete</a>
                                    <a class="bg-[#3461FF] py-1 px-2 text-white font-medium rounded-lg cursor-pointer" href="teacherRegistration.php?id=<?php echo $rowarr['id']; ?>">Edit</a>
                                </td>



                                <!-- enable/disable teacher banner -->
                                <td class="border-2 border-black/50 text-center px-1 py-1">
                                    <label class="switch">
                                        <input type="checkbox" <?php echo ($rowarr['bannerActivity']==1)?'checked':''; ?> onclick="location.href='updateChanges.php?id=<?php echo $rowarr['id']; ?>&type=banner'">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <!-- delete/upload teacher banner -->
                                <td class="border-2 border-black/50 text-center px-1 py-1">
                                    <?php
                                        if($rowarr['bannerPath'] == NULL)
                                        {
                                    ?>
                                            <label for="banner-upload" class="hover:bg-emerald-500 bg-green-500 px-4 py-1 text-white font-medium rounded-lg cursor-pointer">
                                                <input type="file" id="banner-upload" class="hidden" target="<?php echo $rowarr['id']; ?>">
                                                Add
                                            </label>
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                            <a class="hover:bg-red-500 bg-rose-500 px-2 py-1 text-white font-medium rounded-lg cursor-pointer" onclick="confirmDelete(<?php echo $rowarr['id']; ?>,1)">Delete</a>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                <?php
                    }
                ?>
            </table>
    <?php
        }
    ?>
    <img src=" ./Img/Line 11.png" alt="" class="mt-5 w-full mb-5" style="height: 0.2rem;">
    <div>
        <heading for="carousel-count" class="text-lg">No.of Home Screen Banners</heading>&nbsp;
        <input type="number" placeholder="Count" class="border-2 border-black/50 text-center px-1 py-1 rounded-lg" id="carousel-count" style="width: 100px;">&nbsp;
        <button class="bg-[#3461FF] px-2 py-1 text-white font-medium rounded-lg cursor-pointer" onclick="location.href='bannerCount.php?count='+document.getElementById('carousel-count').value">Apply</button>&nbsp;
        Current: <?php echo mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM `carousel-banner-count`"))['count'] ?>
    </div>
    <img src=" ./Img/Line 11.png" alt="" class="mt-5 w-full mb-5" style="height: 0.2rem;">
    <?php
        $query = "SELECT * FROM `class-table`";
        $resClass = mysqli_query($connection, $query);
        $query = "SELECT * FROM `subject-table`";
        $resSubject = mysqli_query($connection, $query);
    ?>
    <h1 class="text-2xl w-full my-4">Classes and Subjects</h1>
    <div class="flex gap-8">
        <div>
            <table>
                <tr class="h-12"><th class="border-2 border-black/50">Class List</th></tr>
                <?php 
                    while($row= mysqli_fetch_array($resClass))
                    {
                ?>
                        <tr class="h-12"><td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $row['className']; ?></td></tr>
                <?php
                    }
                ?>
            </table>
        </div>
        <div>
            <table>
                <tr class="h-12"><th class="border-2 border-black/50">Subject List</th></tr>
                <?php 
                    while($row= mysqli_fetch_array($resSubject))
                    {
                ?>
                        <tr class="h-12"><td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $row['subjectName']; ?></td></tr>
                <?php
                    }
                ?>
            </table>
        </div>
        <div class="flex flex-col gap-4">
            <div>
                <heading for="carousel-count" class="text-lg font-medium">Add Class</heading>&nbsp;
                <input type="text" class="outline-none border-2 border-black/20 px-1 bg-transparent backdrop-blur-md">&nbsp;
                <label for="add-class" class="hover:bg-emerald-500 bg-green-500 px-4 py-1 text-white font-medium rounded-lg cursor-pointer">
                    <input type="button" id="add-class" class="hidden">
                    Add
                </label>
            </div>
            <div>
                <heading for="carousel-count" class="text-lg font-medium">Add Subject</heading>&nbsp;
                <input type="text" class="outline-none border-2 border-black/20 px-1 bg-transparent backdrop-blur-md">&nbsp;
                <label for="add-class" class="hover:bg-emerald-500 bg-green-500 px-4 py-1 text-white font-medium rounded-lg cursor-pointer">
                    <input type="button" id="add-class" class="hidden">
                    Add
                </label>
            </div>
        </div>
    </div>
</main>
<?php include("foot.php"); ?>