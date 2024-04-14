<?php 
include("header.php");
include("connection.php");
session_start();
if(!isset($_SESSION['admin'])){
  @header("location:index.php");
  exit();
}
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
    <main class="mt-16 overflow-auto px-4 w-screen">


        <?php
        // echo $_SESSION['admin']; 
        $query = "SELECT * FROM `temp-teachertable` ORDER BY `id`";
        $res = mysqli_query($connection,$query);
        if(mysqli_num_rows($res)==0){
            ?>
        <div class="text-4xl font-semibold capitalize my-4 text-center">No Data to review</div>
            <?php
        }else{
        ?>
        <h1 class="text-3xl capitalize text-center w-full">Recently Updated</h1>
    <table class="w-[64rem] lg:w-full">
      <tr class="">
        <th class="border-2 border-black/50">First Name</th>
        <th class="border-2 border-black/50">Last Name</th>
        <th class="border-2 border-black/50">Phone number</th>
        <th class="border-2 border-black/50">Email</th>
        <!-- <th class="border-2 border-black/50">gender</th> -->
        <th class="border-2 border-black/50">Age</th>
        <th class="border-2 border-black/50">Experience</th>
        <th class="border-2 border-black/50">Qualification</th>
        <th class="border-2 border-black/50">Locality</th>
        <th class="border-2 border-black/50">Address</th>
        <!-- <th class="border-2 border-black/50">State</th> -->
        <th class="border-2 border-black/50">Action</th>
      </tr>
        <?php 
        while($rowarr = mysqli_fetch_array($res))
        {
        ?>
        <tbody class="h-8 overflow-hidden">
        <tr class="h-12 overflow-hidden">
            <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['firstName']; ?></td>
            <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['lastName']; ?></td>
            <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['phoneNumber']; ?></td>
            <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['email']; ?></td>
            <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['age']; ?></td>
            <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['experience']; ?></td>
            <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['qualification']; ?></td>
            <td class="border-2 border-black/50 text-center px-4 py-1"><?php echo $rowarr['locality']; ?></td>
            <td class="h-12 w-28 border-2 border-black/50 text-center px-4 overflow-x-hidden overflow-y-auto"><div class="overflow-auto h-12"><?php echo $rowarr['address']; ?></div></td>
            <td class="border-2 border-black/50 text-center px-4 py-1"><a class="hover:bg-emerald-500 bg-green-500 px-4 py-1 text-white font-medium rounded-md" href="updateChanges.php?teacherChangeId=<?php echo $rowarr['teacherId']; ?>">Accept</a> | <a class="hover:bg-red-500 bg-rose-500 px-4 py-1 text-white font-medium rounded-md" href="rejectChanges.php?teacherChangeId=<?php echo $rowarr['teacherId']; ?>">Reject</a></td>
        </tr>
        </tbody>
        <?php
         }
        ?>
    </table>
    <?php 
        }
    ?>
    </main>





<?php 
include("footer.php");
?>