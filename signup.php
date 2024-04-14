<?php
include("connection.php");
include("header.php");
include("nav.php");

$urlteacherId = $_REQUEST['teacherid'];
$urlEmail = $_REQUEST['email'];

if (isset($_REQUEST['mode'])) {
    $email = $_REQUEST['email'];
    $teacherId = $_REQUEST['mode'];
    $password = md5($_REQUEST['password']);
    // $confpassword = $_REQUEST['confpassword'];
    $query = "SELECT * FROM `user` WHERE `username`='$email'";
    $res = mysqli_query($connection, $query);

    if (mysqli_num_rows($res) > 0) {
        echo "<script>popUp('Email id already registered!')</script>";
    } else {

        $query = "INSERT INTO `user` SET `teacherId` = '$teacherId',
                                         `username`='$email',
                                         `password` = '$password'";
        $res = mysqli_query($connection, $query);
        session_start();
        $_SESSION['teacherId'] = $teacherId;
        header("location:teacherProfile.php?teachSuperId=" . $teacherId);
    }
}


?>
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
        </div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
            <div class="max-w-md mx-auto">
                <div>
                    <h1 class="w-96 text-2xl font-semibold">Just A Few Steps!</h1>
                </div>
                <div class="divide-y divide-gray-200">
                    <form onsubmit="return passwordCheck()">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="relative">
                                <input type="hidden" name="mode" value="<?php echo $urlteacherId; ?>">
                                <input type="hidden" name="email" value="<?php echo $urlEmail; ?>">
                                <input autocomplete="off" id="email" name="" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Email address" disabled value="<?php echo $urlEmail; ?>" />
                                <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
                            </div>
                            <div class="relative">
                                <input autocomplete="off" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                                <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
                            </div>
                            <div class="relative">
                                <input autocomplete="off" id="confpassword" name="confpassword" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                                <label for="confpassword" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Confirm password</label>
                            </div>
                            <div class="relative">
                                <input type="submit" class="bg-blue-500 text-white rounded-md px-4 py-1 mt-4" value="Submit" id="hehe">
                                <!-- <button class="bg-blue-500 text-white rounded-md px-4 py-1 mt-4">Submit</button> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php");
?>