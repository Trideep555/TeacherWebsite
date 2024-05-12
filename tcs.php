<?php
    include("connection.php");
    include("head.php");  //html header
    include("nav.php"); //navigation bar
?>
<main class="bg-[#f1f1f1] w-auto h-28 flex justify-evenly relative">
</main>
<main class="relative my-8 flex flex-col gap-10">
    <!-- heading-->
    <section class="font-semibold text-5xl w-[90%] h-auto mx-auto flex justify-between">
        <heading class="">Terms and Conditions</heading>
    </section>
    <!-- content -->
    <section class="w-[90%] h-auto mx-auto flex justify-between flex-col gap-4">
        <div class="text-lg font-normal">
            •	This website is solely for advertising purposes and does not necessitate any verification.
        </div>
        <div class="text-lg font-normal">
            •	In any financial transaction, it is crucial to handle it responsibly. This is to clarify that we are not accountable for any untoward incident or mishap that may occur during a transaction. We recommend that all parties involved in such dealings familiarize themselves with the terms and requirements necessary for the transaction.
        </div>
        <div class="text-lg font-normal">
            •	We thoroughly verify the information of every teacher before uploading it. We cannot be held responsible for any inaccurate information.
        </div>
        <div class="text-lg font-normal">
            •	It is crucial to understand that there might be cases where a teacher's contract could be terminated without any prior notice. Such a decision is made after careful evaluation of the particular circumstances, and it is not taken lightly. We make this decision after considering the best interests of all parties involved, and the final decision rests with us.
        </div>
    </section>
</main>
<main id="contact-section" class="relative bg-[#f1f1f1] h-auto p-0 lg:p-20 pt-32 w-full flex justify-center items-center overflow-hidden">
    <section class="bg-white h-auto lg:h-[40rem] w-full lg:w-[90%] rounded-2xl p-2 flex flex-col lg:flex-row justify-between gap-2 shadow-lg z-10">
        <!-- left side -->
        <div class="relative bg-black rounded-2xl h-full w-full lg:w-2/5 p-2 lg:pl-8 pt-12 overflow-hidden">
            <heading class="block text-4xl font-semibold text-white text-center w-full lg:text-left">Contact Information</heading>
            <p class="text-white/50 mt-2 block text-center lg:text-left">Say something to start a live chat!</p>
            <section class="mt-20 text-white flex flex-col gap-8">
                <span class="flex-col lg:flex-row text-center lg:text-left mx-auto lg:mx-0 flex gap-4 lg:gap-8 font-poppins text-lg justify-center lg:justify-start lg:items-start items-center "><img class="h-6 w-6" src="./Img/ui-buttons/bxs_phone-call.svg" alt="">+91 1234567890</span>
                <span class="flex-col lg:flex-row text-center lg:text-left mx-auto lg:mx-0 flex gap-4 lg:gap-8 font-poppins text-lg justify-center lg:justify-start lg:items-start items-center "><img class="h-6 w-6" src="./Img/ui-buttons/ic_sharp-email.svg" alt="">demo@email.com</span>
                <span class="flex-col lg:flex-row text-center lg:text-left mx-auto lg:mx-0 flex gap-4 lg:gap-8 font-poppins text-lg justify-center lg:justify-start lg:items-start items-center "><img class="h-6 w-6" src="./Img/ui-buttons/carbon_location-filled.svg" alt="">Demo Address</span>
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