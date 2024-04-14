<?php 
include("header.php");
include("nav.php");
include("connection.php");
if(!isset($_REQUEST['page'])){
    $page = 1;
}
else{
    $page= $_REQUEST['page'];
}
$limit = 6;
$offset = ($page-1) * $limit;
if(isset($_REQUEST['searchQuery'])){
    $searchQuery = $_REQUEST['searchQuery'];
    $teachers = "SELECT * FROM `teacher-table` WHERE `firstName` LIKE '%$searchQuery%' OR `lastName` LIKE '%$searchQuery%' LIMIT {$offset},{$limit}";
}
else if(isset($_REQUEST['filtering'])){
    $teachers = "SELECT `teacher-cls-subj`.* ,`teacher-table`.* FROM `teacher-cls-subj` INNER JOIN `teacher-table` ON `teacher-cls-subj`.`teacherId` = `teacher-table`.`id` WHERE ";
    if(isset($_REQUEST['class'])){  
            $classFILTER = $_REQUEST['class'];
            $teachers = $teachers." "."`classId`='$classFILTER'";   
    }
    if(isset($_REQUEST['locality'])){
        $localityFILTER = $_REQUEST['locality'];
        if(isset($_REQUEST['class'])){
            $teachers = $teachers." AND ";
        }
        $teachers = $teachers." "."`locality`='$localityFILTER'";
    }
    if(isset($_REQUEST['subject'])){
        $subjectFILTER = $_REQUEST['subject'];
        if(isset($_REQUEST['class'])||isset($_REQUEST['locality'])){
            $teachers = $teachers." AND ";
        }
        $teachers = $teachers." "."`subjectId`='$subjectFILTER'";
    }

    if(isset($_REQUEST['locality'])&&!isset($_REQUEST['subject'])&&!isset($_REQUEST['class'])){
        $localityFILTER = $_REQUEST['locality'];
        $teachers = "SELECT * FROM `teacher-table` WHERE `locality` = '$localityFILTER'";
    }
    // $localityFILTER = $_REQUEST['locality'];
    // $subjectFILTER = $_REQUEST['subject'];
    $teachers = $teachers." LIMIT {$offset},{$limit}";
}
else{
    $teachers = "SELECT * FROM `teacher-table` LIMIT {$offset},{$limit}";
}

if(isset($_REQUEST['search'])){
    $search = $_REQUEST['searching'];
    @header("location:hero.php?searchQuery=".$search);
}

if(isset($_REQUEST['filter'])){
    $class = $_REQUEST['list-class'];
    $locality = $_REQUEST['list-locality'];
    $subject = $_REQUEST['list-subject'];
    $location = "hero.php?filtering=1&";
    if(!empty($subject)){
        $location = $location."subject=".$subject."&";
    }
    if(!empty($locality)){
        $location = $location."locality=". $locality."&";
    }
    if(!empty($class)){
        $location = $location."class=". $class;
    }
    @header("location:".$location);
}
// echo $teachers;

?>
<!-- filter section -->
<header class="bg-[#f1f1f1] mt-16" >
        <button id="openFilter" class="bg-white shadow-md shadow-gray-600 fixed top-20 flex items-center border-t-0 mx-auto sm:mx-0 sm:ml-16 justify-between h-8 w-32 px-4 rounded-md border-2 border-[#f1f1f1] text-lg z-[1]" >Filter 
            <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 16.88C11.04 17.18 10.94 17.5 10.71 17.71C10.32 18.1 9.68998 18.1 9.29998 17.71L5.28998 13.7C5.05998 13.47 4.95998 13.16 4.99998 12.87V7.75L0.20998 1.62C-0.13002 1.19 -0.0500202 0.56 0.37998 0.22C0.56998 0.08 0.77998 0 0.99998 0H15C15.22 0 15.43 0.08 15.62 0.22C16.05 0.56 16.13 1.19 15.79 1.62L11 7.75V16.88ZM3.03998 2L6.99998 7.06V12.58L8.99998 14.58V7.05L12.96 2H3.03998Z" fill="black"/>
            </svg></button>
        <aside id="filterArea" class="bg-white fixed -left-96 top-16 border-r-2 z-10 duration-500 shadow-md h-[calc(100vh-4rem)] w-64 px-4 " >
            <section class=" flex justify-between items-center my-8 text-center text-2xl font-medium" >
                Filter
                <i id="closeFilter" class="fa-solid fa-xmark cursor-pointer"></i>
            </section>
            <section>
                <form>
                    <h1  class="text-xl" >Search Teacher:</h1>
                    <input type="search" class="border-2 rounded-full border-[#f1f1f1] w-full h-8 px-2 outline-none focus:border-blue-400" name="searching" id=""> 
                    <input type="hidden" name="search">
                    <input  type="submit" value="Search" class="mt-4 h-8 w-24 bg-blue-500 text-white rounded-md cursor-pointer" >
                </form>  
            </section>
            <!-- class drop down -->
                <form onsubmit="return filterValidate()">
                    <section class="relative mt-16 select-none">
                        <h1 id="classToggler" class="z-0 cursor-pointer border-2 flex justify-between py-1 px-2 border-[#f1f1f1] items-center" >Class <i id="classArrow" class="fa-solid fa-chevron-down"></i></h1>
                        <ul id="classDropdown" class=" z-10 hidden w-full absolute top-10  text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg h-40 overflow-auto">
                        <?php 
                        $classSql = "SELECT * from `class-table` ORDER BY `id`";
                        $res = mysqli_query($connection,$classSql);
                        $counter = 1;
                        while($classArr = mysqli_fetch_array($res)){
                            
                        ?>
                            <li class="w-full border-b border-gray-200 rounded-t-lg ">
                                <div class="flex items-center pl-3">
                                    <input id="list-radio-class<?php echo $counter;?>" type="radio" value="<?php echo $classArr['id'];?>" name="list-class" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                                    <label for="list-radio-class<?php echo $counter;?>" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 "><?php echo $classArr['className'];?></label>
                                </div>
                            </li>
                        <?php 
                        $counter++;
                        }
                        ?>
                        </ul>
                    </section>
                    <!-- locality dropdown -->
                    <section class="relative mt-10 select-none">
                        <h1 id="localityToggler" class=" z-0 cursor-pointer border-2 py-1 flex justify-between px-2 border-[#f1f1f1] items-center" >Locality <i id="localityArrow" class="fa-solid fa-chevron-down"></i></h1>
                        <ul id="localityDropdown" class=" z-10 hidden w-full absolute top-10  text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg h-40 overflow-auto">
                            <?php 
                            $localitySql = "SELECT DISTINCT `locality` FROM `teacher-table`";
                            $res = mysqli_query($connection,$localitySql);
                            $counter = 1;
                            while($localityArr = mysqli_fetch_array($res)){
                            ?>
                            <li class="w-full border-b border-gray-200 rounded-t-lg ">
                                <div class="flex items-center pl-3">
                                    <input id="list-radio-locality<?php echo $counter;?>" type="radio" value="<?php echo $localityArr['locality'];?>" name="list-locality" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                                    <label for="list-radio-locality<?php echo $counter;?>" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 "><?php echo $localityArr['locality'];?></label>
                                </div>
                            </li>
                            <?php 
                            $counter++;
                            }
                            ?>           
                        </ul>
                    </section>
                    <!-- subject dropdown -->
                    <section class="relative mt-10 select-none ">
                        <h1 id="subjectToggler" class="flex justify-between items-center z-0 cursor-pointer border-2 py-1 px-2 border-[#f1f1f1]" >Subject <i id="subjectArrow" class="fa-solid fa-chevron-down"></i></h1>
                        
                        <ul id="subjectDropdown" class=" z-10 hidden w-full absolute top-10  text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg h-28 overflow-auto">
                            <?php 
                        $subjectSql = "SELECT * FROM `subject-table` ORDER BY `id`";
                        $res = mysqli_query($connection,$subjectSql);
                        $counter = 1;
                        while($subjectArr = mysqli_fetch_array($res)){
                        ?>        
                        <li class="w-full border-b border-gray-200 rounded-t-lg ">
                                <div class="flex items-center pl-3">
                                    <input id="list-radio-subject<?php echo $counter;?>" type="radio" value="<?php echo $subjectArr['id'];?>" name="list-subject" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                                    <label for="list-radio-subject<?php echo $counter;?>" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 "><?php echo $subjectArr['subjectName'];?></label>
                                </div>
                        </li>
                        <?php 
                        $counter++;
                        }
                        ?>  
                        </ul>
                    </section>
                    <input type="hidden" name="filter" value="1">
                    <input type="submit" value="Sort" class="mt-8 h-8 w-24 bg-blue-500 text-white rounded-md cursor-pointer" >
                </form>
        </aside>
</header>
    <!-- card holding container main body  -->
<section class="bg-[#f1f1f1] h-screen" >  
<main class="bg-[#f1f1f1] pt-10 p-0 sm:px-8 justify-center items-center w-full grid gap-8  xl:grid-cols-3 lg:grid-cols-2 grid-cols-1 " >
    <?php
        $resTeachers = mysqli_query($connection,$teachers); 
        $totalRows = mysqli_num_rows($resTeachers);
        while($rowarr = mysqli_fetch_array($resTeachers)){
        $randTeacherId = $rowarr['id'];
        if(isset($_REQUEST['class'])){
            $class = "SELECT * FROM `teacher-cls-subj`
                    INNER JOIN `class-table` ON `class-table`.`id` = `teacher-cls-subj`.`classId`
                    INNER JOIN `subject-table` ON `subject-table`.`id`=`teacher-cls-subj`.`subjectId`
                    WHERE `teacherId` = '$randTeacherId' AND `classId` = '$classFILTER' LIMIT 1";
        }else{
            $class = "SELECT * FROM `teacher-cls-subj`
                    INNER JOIN `class-table` ON `class-table`.`id` = `teacher-cls-subj`.`classId`
                    INNER JOIN `subject-table` ON `subject-table`.`id`=`teacher-cls-subj`.`subjectId`
                    WHERE `teacherId` = '$randTeacherId'
                    ORDER BY rand()  LIMIT 1";
        }
            
            $classRes = mysqli_query($connection,$class);
            $classarr = mysqli_fetch_array($classRes);
            $profilequery = "SELECT * FROM `teacher-profileimage-table` WHERE `teacherId` = '$randTeacherId'";
            $profileRes = mysqli_query($connection,$profilequery);
    ?>

    <!-- cards -->
    <section class="bg-white relative w-96  rounded-2xl shadow-lg border-t-2 border-black/20 py-8 mx-auto flex flex-col gap-4">

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
        <tag class="border-black/70 border-2 px-2 rounded-full font-medium text-sm text-black/70"><?php echo $rowarr['experience'];?> years</tag>
        <!-- tag 2 is for class -->
        <?php 
        }
        ?>
        <tag class="border-black/70 border-2 px-2 rounded-full font-medium text-sm text-black/70"><?php echo $classarr['className'] ?></tag>
        <!-- tag 3 is for degree -->
        <tag class="border-black/70 border-2 px-2 rounded-full font-medium text-sm text-black/70"><?php echo $rowarr['qualification'];?></tag>

      </div>
      <!---------------------- connect button --------------------->
      <a href="teacherProfile.php?teachSuperId=<?php echo $randTeacherId;?>" class=""><button class="mx-[5%] w-[90%] bg-[#3461FF] h-12  rounded-full text-white text-lg ">Connect</button></a>
    </section>
    <?php 
    }

    ?> 
        
</main>
<section class="bg-[#f1f1f1] w-full relative py-8">
      <ul  class="sticky flex gap-6 justify-center" >
        <?php 
        $totalRows = "SELECT * FROM `teacher-table`";
        $totalRes = mysqli_query($connection,$totalRows);
        $totalRows = mysqli_num_rows($totalRes);
        $pageNumber = ceil($totalRows/$limit);
        // echo $totalRows;
        for ($i=1; $i <= $pageNumber; $i++) { 
        ?>
        <a class="h-8 w-8" href="hero.php?page=<?php echo $i;?>"><li class="h-full w-full bg-blue-500 text-white text-center leading-[2rem] rounded-md" ><?php echo $i;?></li></a>
        <?php 
        }
        ?>  
      </ul>
    </section>
    </section> 
    
<?php
// echo $_SERVER['HTTP_HOST']; 
// echo $_SERVER['SCRIPT_NAME']; 
include("footer.php");
?>