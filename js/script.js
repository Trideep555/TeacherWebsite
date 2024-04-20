
const navTabs = document.querySelector("#navTabs");
function menuToggleBtn(e) {
  if (e.classList.contains("fa-bars")) {
    e.classList.remove("fa-bars");
    e.classList.add("fa-xmark");
    navTabs.classList.remove("left-[-100vw]");
    navTabs.classList.add("left-0");
  } else {
    e.classList.add("fa-bars");
    e.classList.remove("fa-xmark");
    navTabs.classList.remove("left-0");
    navTabs.classList.add("left-[-100vw]");
  }
}

const carousel = document.querySelector(".carousel-cu");
const leftArrowBtn = document.querySelector(".leftSwipeArrow");
const rightArrowBtn = document.querySelector(".rightSwipeArrow");

let isDragging = false,startX,startScrollLeft;

const dragStart = (e) => {
  isDragging = true;
  startX = e.pageX;
  startScrollLeft = carousel.scrollLeft;
  carousel.classList.add("select-none");
  carousel.classList.add("cursor-grab");
  carouselTes.classList.add("select-none");
  carouselTes.classList.add("cursor-grab");
};
const dragStop = () => {
  isDragging = false;
  carousel.classList.remove("select-none");
  carousel.classList.remove("cursor-grab");
  carouselTes.classList.remove("select-none");
  carouselTes.classList.remove("cursor-grab");
};

const dragging = (e) => {
  if (!isDragging) return;
  carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
  carouselTes.scrollLeft = startScrollLeft - (e.pageX - startX);
  // console.log(carousel.scrollLeft);
};

//left click will reduce the scroll position of the scroll causing the slider to swipe left.
//*putting this inside try catch block because in all pages other than index.js this part is showing error causing js code after this try catch block not loading.
try {
  leftArrowBtn.addEventListener("click", () => {
    carousel.scrollLeft -= 400;
  });

  //right click will increase the scroll position of the scroll causing the slider to swipe right.
  rightArrowBtn.addEventListener("click", () => {
    carousel.scrollLeft += 400;
  });
  carousel.addEventListener("mousedown", dragStart);
  carousel.addEventListener("mousemove", dragging);
  document.addEventListener("mouseup", dragStop);
} catch (error) {
  console.log(error.message);
  console.log("If you are not on landing page! Ignore this error");
}

const carouselTes = document.querySelector(".carousel-tes");
const leftArrowBtnTes = document.querySelector(".leftSwipeArrowTes");
const rightArrowBtnTes = document.querySelector(".rightSwipeArrowTes");

let isDraggingTes = false,startXTes,startScrollLeftTes;

const dragStartTes = (eT) => {
  isDraggingTes = true;
  startXTes = eT.pageX;
  startScrollLeftTes = carouselTes.scrollLeft;
  carouselTes.classList.add("select-none");
  carouselTes.classList.add("cursor-grab");
};
const dragStopTes = () => {
  isDraggingTes = false;
  carouselTes.classList.remove("select-none");
  carouselTes.classList.remove("cursor-grab");
};

const draggingTes = (eT) => {
  if (!isDraggingTes) return;
  carouselTes.scrollLeft = startScrollLeftTes - (eT.pageX - startXTes);
  // console.log(carousel.scrollLeft);
};

try {
  leftArrowBtnTes.addEventListener("click", () => {
    carouselTes.scrollLeft -= 400;
  });

  //right click will increase the scroll position of the scroll causing the slider to swipe right.
  rightArrowBtnTes.addEventListener("click", () => {
    carouselTes.scrollLeft += 400;
  });
  carouselTes.addEventListener("mousedown", dragStart);
  carouselTes.addEventListener("mousemove", dragging);
  document.addEventListener("mouseup", dragStop);
} catch (error) {
  console.log(error.message);
  console.log("If you are not on landing page! Ignore this error");
}

//todo toast pop up function
const popUp = (messageToast) => {
  console.log(messageToast);
  const x = document.querySelector("#snackbar");
  x.innerHTML = messageToast;
  x.classList.add("show");
  x.classList.remove("hidden");
  setTimeout(() => {
    x.classList.remove("show");
    x.classList.add("hidden");
  }, 3000);
};

//todo form validation
const validateContact = () => {
  let Fnameget = $("#FName").val().trim();
  let Lnameget = $("#LName").val().trim();
  let emailget = $("#email").val().trim();
  let Pnumberget = $("#Pnumber").val().trim();
  let subjectget = $("input[name='subjectContact']:checked").val();
  let messageget = $("#textBox").val().trim();

  if (Fnameget === "") {
    popUp("First name can not be empty");
    return false;
  } else if (Lnameget === "") {
    popUp("Last name can not be empty");
    return false;
  } else if (!emailget.includes("@") && !emailget.includes(".")) {
    popUp("Please enter valid email id");
    return false;
  } else if (Pnumberget === "") {
    popUp("Phone number can't be blank");
    return false;
  } else return true;
};

const deleteThis = (y) => {
  let childCount = $("#cloningArea").children().length;
  console.log(childCount);
  if (childCount - 1 < 4) $("#addRow").show();
  $(y).parent().remove();
};



const passwordCheck = () => {
  let password = $("#password").val();
  let confpassword = $("#confpassword").val();
  if (password !== confpassword) {
    popUp("password does not match.");
    return false;
  }
  $("#email").removeAttr("disabled");
  return true;
};

const confirmDelete = (value) =>{
  let response ='Deleting tearchers can not be undone!\nDo you want to proceed?';
  if(confirm(response)===true){
    window.location.href = "deleteTeachers.php?teacherDeleteId="+value;
  }
  else{
    return false;
  }
}

let localityToggler = document.querySelector("#localityToggler");
try{
  localityToggler.addEventListener("click",()=>{
    let localitySelector = document.querySelector('#localityDropdown');
    let localityArrow = document.querySelector('#localityArrow');
  
    if(localitySelector.classList.contains("hidden")){
      localitySelector.classList.remove("hidden");
      localityArrow.classList.remove('fa-chevron-down');
      localityArrow.classList.add('fa-chevron-up');
    }else{
      localitySelector.classList.add("hidden");
      localityArrow.classList.add('fa-chevron-down');
      localityArrow.classList.remove('fa-chevron-up');
    }
  });
}
catch(error){
  console.log("Can not find locality button!(hero.php)");
}

let classToggler = document.querySelector("#classToggler");
try{
  classToggler.addEventListener("click",()=>{
    let classSelector = document.querySelector('#classDropdown');
    let classArrow = document.querySelector('#classArrow');
  
    if(classSelector.classList.contains("hidden")){
      classSelector.classList.remove("hidden");
      classArrow.classList.remove('fa-chevron-down');
      classArrow.classList.add('fa-chevron-up');
    }else{
      classSelector.classList.add("hidden");
      classArrow.classList.add('fa-chevron-down');
      classArrow.classList.remove('fa-chevron-up');
    }
  });
}catch(error){
  console.log("Can not find class button!(hero.php)");
}
let subjectToggler = document.querySelector("#subjectToggler");
try{
  subjectToggler.addEventListener("click",()=>{
    let subjectSelector = document.querySelector('#subjectDropdown');
    let subjectArrow = document.querySelector('#subjectArrow');
    if(subjectSelector.classList.contains("hidden")){
      subjectSelector.classList.remove("hidden");
      subjectArrow.classList.remove('fa-chevron-down');
      subjectArrow.classList.add('fa-chevron-up');
    }else{
      subjectSelector.classList.add("hidden");
      subjectArrow.classList.add('fa-chevron-down');
      subjectArrow.classList.remove('fa-chevron-up');
    }
  });
}catch(error){
  console.log("Can not find subject button(hero.php)");
}

let openFilter = document.querySelector("#openFilter");
let closeFilter = document.querySelector("#closeFilter");
let filterArea = document.querySelector('#filterArea');
try{
  openFilter.addEventListener("click",()=>{
    filterArea.classList.replace("-left-96","left-0");
  })
  closeFilter.addEventListener("click",()=>{
    filterArea.classList.replace("left-0","-left-96");
  })
}
catch(error){
  console.log("Error handled!");
}

const filterValidate = () =>{
  let classRadio = document.querySelector('input[name="list-class"]:checked');
  let localityRadio = document.querySelector('input[name="list-locality"]:checked');
  let subjectRadio = document.querySelector('input[name="list-subject"]:checked');
  if(classRadio!=null||localityRadio!=null||subjectRadio!=null){
    return true;
  }
  else{
    popUp("Please select atleast one field");
    return false;
  }

}


//ajax php calling
$(document).ready(() => {

  $('.deleteBanner').on("click",(event)=>{

    let confirmRes = "The banner will be deleted permanently\n Do you want to proceed?";
    if(confirm(confirmRes)===false){
      return false;
    }

    let a = event.target.closest("[data-bannerid]");
    let bannerIdget = a.dataset.bannerid;
    let bannerPathGet = a.dataset.path;
    console.log("Deleting banner with id"+bannerIdget);

    // console.log(bannerIdget);
    // console.log(bannerPathGet);
    $.ajax({
      url:"deleteBannerImage.php",
      type:"POST",
      data:{
        bannerId:bannerIdget,
        path:bannerPathGet
      },
      success:(res)=>{
        popUp(res);
      }
    })
  })

  //contact us form
  $(".contact-form-submit-btn").on("click", (e) => {
    e.preventDefault();
    let Fnameget = $("#FName").val();
    let Lnameget = $("#LName").val();
    let emailget = $("#email").val();
    let Pnumberget = $("#Pnumber").val();
    let subjectget = $("input[name='subjectContact']:checked").val();
    let messageget = $("#textBox").val();
    if (!validateContact()) return false;

    $.ajax({
      url: "functions/contactSubmission.php",
      type: "POST",
      data: {
        FName: Fnameget,
        LName: Lnameget,
        email: emailget,
        phoneNumber: Pnumberget,
        subject: subjectget,
        message: messageget,
      },
      success: (res) => {
        popUp(res);
        $("#FName").val("");
        $("#LName").val("");
        $("#email").val("");
        $("#Pnumber").val("");
        // $("input[name='subjectContact']:checked").val();
        $("#textBox").val("");
      },
    });
  });

  //faq submit button
  $("#faq-submit-button").on("click", (event) => {
    // event.preventDefault();

    let emailget = $("#faq-mail").val().trim();
    if (emailget === "") {
      popUp("Please provide email address!");
      return false;
    }
    $("#faq-mail").val("");
    $("#email").val(emailget);
  });

  //? add new row with class and subject(teacherRegistration.php);
  $("#addRow").on("click", () => {
    $("#cloningElement").clone().appendTo("#cloningArea");
    let childCount = $("#cloningArea").children().length;
    console.log(childCount);
    if (childCount >= 4) $("#addRow").hide();
    let x = $("#cloningArea").children().children("img");
    // console.log(x);
    x.removeClass("hidden");
  });

  //*ajax call for the teacher registration form (teacherRegistration.php);
  $("#teacherRegSubBtn").on("click", (event) => {
    event.preventDefault();

    let Fnameget = $("#firstName").val();
    let Lnameget = $("#lastName").val();
    let phoneNumberGet = $("#phoneNumber").val();
    let emailget = $("#email").val();
    let genderget = $("#gender").val();
    let ageGet = $("#age").val();
    let experienceGet = $("#experience").val();
    let qualificationGet = $("#qualification").val();
    let localityGet = $("#locality").val();
    localityGet = localityGet.toString().toLowerCase();
    console.log(localityGet)
    let mapLinkGet = $("#googleMapLink").val();
    let addressGet = $("#address").val();
    let stateGet = $("#state").val();

    if (Fnameget === "") {
      popUp("First name can not empty!");
      return false;
    } else if (Lnameget === "") {
      popUp("Last name can not empty!");
      return false;
    } else if (phoneNumberGet === "") {
      popUp("Phone Number can not empty!");
      return false;
    } else if (phoneNumberGet.length<10) {
      popUp("Enter valid phone number");
      return false;
    } else if (
      emailget === "" ||
      !emailget.includes("@") ||
      !emailget.includes(".")
    ) {
      popUp("Please enter a valid email!");
      return false;
    } else if (genderget === "") {
      popUp("Select a gender");
      return false;
    } else if (genderget === "") {
      popUp("Select a gender");
      return false;
    } else if (ageGet < 18) {
      popUp("Age must be greater than 18!");
      return false;
    } else if (ageGet > 80) {
      popUp("Age can not be greater than 80!");
      return false;
    } else if (qualificationGet === "") {
      popUp("Provide your qualification!");
      return false;
    } else if (addressGet === "") {
      popUp("Please enter a valid address!");
      return false;
    } else if (stateGet === "") {
      popUp("Please enter a valid state!");
      return false;
    } else if (localityGet === "") {
      popUp("Please provide locality!");
      return false;
    } else if (experienceGet === "") {
      experienceGet = "Not Yet";
    } else if (mapLinkGet === "") {
      mapLinkGet = "Not Provided";
    } else console.log("hehe");

    //? arrays to store the subjects and classes
    const subjarr = [];
    const classarr = [];

    //? this for each loop pushes ids of selected subject into subjarr array
    $("#subjects[name='subjects']").each((index, element) => {
      // console.log($(element).val());
      subjarr.push($(element).val());
    });

    //? this for each loop pushes ids of selected classes into class array
    $("#classes[name='classes']").each((index, element) => {
      classarr.push($(element).val());
    });

    // console.log(subjectArray);
    $.ajax({
      url: "functions/teacherReg.php",
      type: "POST",
      data: {
        fName: Fnameget,
        lName: Lnameget,
        phoneNumber: phoneNumberGet,
        email: emailget,
        gender: genderget,
        age: ageGet,
        experience: experienceGet,
        qualification: qualificationGet,
        locality:localityGet,
        mapLink:mapLinkGet, 
        address: addressGet,
        state: stateGet,
        subjectArray: JSON.stringify(subjarr),
        classArray: JSON.stringify(classarr),
      },
      success: (res) => {
        console.log(res);

        if (res === "email") {
          popUp("Email id is already registered!");
          return false;
        } else if (res === "phoneNumber") {
          popUp("Phone number is already registered!");
          return false;
        }

        $("#firstName").val("");
        $("#lastName").val("");
        $("#phoneNumber").val("");
        $("#email").val("");
        $("#gender").val("");
        $("#age").val("");
        $("#experience").val("");
        $("#qualification").val("");
        $("#googleMapLink").val("");
        $("#address").val("");
        $("#state").val("");
        window.location.href =
          "signup.php?teacherid=" +
          res +
          "&servilence=lambda&email=" +
          emailget;
      },
    });
    // console.log(subjarr);
  });

  $("#teacherUpdateSubBtn").on("click", (event) => {
    event.preventDefault();

    let Fnameget = $("#firstName").val();
    let Lnameget = $("#lastName").val();
    let phoneNumberGet = $("#phoneNumber").val();
    let emailget = $("#email").val();
    let genderget = $("#gender").val();
    let ageGet = $("#age").val();
    let experienceGet = $("#experience").val();
    let qualificationGet = $("#qualification").val();
    let localityGet = $("#locality").val();
    localityGet = localityGet.toString().toLowerCase();
    console.log(localityGet)
    let mapLinkGet = $("#googleMapLink").val();
    let addressGet = $("#address").val();
    let stateGet = $("#state").val();

    if (Fnameget === "") {
      popUp("First name can not empty!");
      return false;
    } else if (Lnameget === "") {
      popUp("Last name can not empty!");
      return false;
    } else if (phoneNumberGet === "") {
      popUp("Phone Number can not empty!");
      return false;
    } else if (phoneNumberGet.length<10) {
      popUp("Enter valid phone number");
      return false;
    } else if (
      emailget === "" ||
      !emailget.includes("@") ||
      !emailget.includes(".")
    ) {
      popUp("Please enter a valid email!");
      return false;
    } else if (genderget === "") {
      popUp("Select a gender");
      return false;
    } else if (genderget === "") {
      popUp("Select a gender");
      return false;
    } else if (ageGet < 18) {
      popUp("Age must be greater than 18!");
      return false;
    } else if (ageGet > 80) {
      popUp("Age can not be greater than 80!");
      return false;
    } else if (qualificationGet === "") {
      popUp("Provide your qualification!");
      return false;
    } else if (addressGet === "") {
      popUp("Please enter a valid address!");
      return false;
    } else if (stateGet === "") {
      popUp("Please enter a valid state!");
      return false;
    } else if (localityGet === "") {
      popUp("Please provide locality!");
      return false;
    } else if (experienceGet === "") {
      experienceGet = "Not Yet";
    } else if (mapLinkGet === "") {
      mapLinkGet = "Not Provided";
    } else console.log("hehe");

    //? arrays to store the subjects and classes
    const subjarr = [];
    const classarr = [];

    //? this for each loop pushes ids of selected subject into subjarr array
    $("#subjects[name='subjects']").each((index, element) => {
      // console.log($(element).val());
      subjarr.push($(element).val());
    });

    //? this for each loop pushes ids of selected classes into class array
    $("#classes[name='classes']").each((index, element) => {
      classarr.push($(element).val());
    });

    // console.log(subjectArray);
    $.ajax({
      url: "functions/teacherUpdate.php",
      type: "POST",
      data: {
        fName: Fnameget,
        lName: Lnameget,
        phoneNumber: phoneNumberGet,
        email: emailget,
        gender: genderget,
        age: ageGet,
        experience: experienceGet,
        qualification: qualificationGet,
        locality:localityGet,
        mapLink:mapLinkGet, 
        address: addressGet,
        state: stateGet,
        subjectArray: JSON.stringify(subjarr),
        classArray: JSON.stringify(classarr),
      },
      success: (res) => {
        console.log(res);

        if (res === "email") {
          popUp("Email id is already registered!");
          return false;
        } else if (res === "phoneNumber") {
          popUp("Phone number is already registered!");
          return false;
        }

        $("#firstName").val("");
        $("#lastName").val("");
        $("#phoneNumber").val("");
        $("#email").val("");
        $("#gender").val("");
        $("#age").val("");
        $("#experience").val("");
        $("#qualification").val("");
        $("#googleMapLink").val("");
        $("#address").val("");
        $("#state").val("");
        window.location.href =
          "";
      },
    });
    // console.log(subjarr);
  });

  $('#showTable').on("click",()=>{
    $('#tableArea').show();
  });
  $(document).on("click",(event)=>{
    // console.log(event)
    if(event.target.id!=='tableSection'&& event.target.id!=='showTable'){
      $('#tableArea').hide();
    }
    
  })

  $('#Signin-btn').on("click",(e)=>{
    e.preventDefault();
    let userNameget = $('#email').val(); 
    let passwordget = $('#password').val();
    $.ajax({
      url:"loginfunction.php",
      type:"POST",
      data:{
        userName:userNameget,
        password:passwordget,
      },
      success:(result)=>{
        if(result==="0"){
          window.location.href = "dashboard.php";
        }
        else if(result==="-1"){
          popUp("Email is not registered!");
        }
        else if(result==="-2"){
          popUp("Incorrect Password!");
        }
        else{
          window.location.href = "teacherProfile.php?teachSuperId="+result;
        }
      }
    })

  });


  $('#upload-dp').on("change",(e)=>{
    if(e.target.files.length>0){
      let formData = new FormData();
      formData.append('upload-dp',e.target.files[0]);
      $.ajax({
        url:"uploadedProfileImage.php",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:(res)=>{
          popUp(res);
          
        }
      })
      // console.log(formData);
    }
    else{
      console.log("file is not selected");
    }
  });

  
  //banner upload
  $('#banner-upload').on("change",(e)=>{
    if(e.target.files.length>0){
      if(e.target.files[0].size>500000)
      {
        popUp("Banner size must be less than or equal to 500KB");
        return;
      }
      var img=new Image();
      img.src=URL.createObjectURL(e.target.files[0]);
      img.onload = () =>
      {
        if(img.width%32!=0 || img.height%9!=0)
        {
          popUp("Banner must be 32:9 aspect ratio");
          return;
        }
      }
      let formData2 = new FormData();
      formData2.append('banner-upload',e.target.files[0]);
      $.ajax({
        url:"uploadBannerImage.php",
        type:"POST",
        data:formData2,
        contentType:false,
        processData:false,
        success:(res)=>{
          popUp(res);
          
        }
      })
      // console.log(formData);
    }
    else{
      console.log("file is not selected");
    }
  });
  


});
