const confirmDelete = (id, type) =>{
  if(type==0)
  {
    let response ='Deleting tearchers can not be undone!\nDo you want to proceed?';
    if(confirm(response) === true)
    {
      window.location.href = "deleteTeachers.php?id="+id;
    }
    else
    {
      return false;
    }
  }
  else if(type==1)
  {
    let response ='Deleting banner can not be undone!\nDo you want to proceed?';
    if(confirm(response) === true)
    {
      window.location.href = "deleteBannerImage.php?id="+id;
    }
    else
    {
      return false;
    }
  }
}

const checkRegType = (type) => {
  if(type.checked)
  {
    if(type.value === "Teacher")
    {
      $("label[for='firstName']").text("First Name");
      $("#firstName").attr("placeholder","First name");

      $("label[for='lastName']").css("display","block");
      $("#lastName").css("display","block");

      $("#row-3").css("display","flex");
    }
    else if(type.value === "Institute")
    {
      $('label[for="firstName"]').text('Institute Name');
      $("#firstName").attr("placeholder","Institute name");

      $("label[for='lastName']").css("display","none");
      $("#lastName").css("display","none");

      $("#row-3").css("display","none");
    }
  }
}

$("#mode").on("change", () => {
  if($("#mode").val() === "Online")
  {
    $("label[for='locality']").css("display","none");
    $("label[for='address']").css("display","none");
    $("label[for='state']").css("display","none");
  }
  else if($("#mode").val() != "")
  {
    $("label[for='locality']").css("display","block");
    $("label[for='address']").css("display","block");
    $("label[for='state']").css("display","block");
  }
});

let profileImageFnc = 0;

//  0 - Means no chnages
//  1 - Means the image has been changed to a new one
// -1 - Means the image have been cleared and reset to default image

let inititalProfileImage = $("#profileImage").attr("src");

$("#upload-dp").on("change", (e) =>{
  if(e.target.files.length > 0)
  {
    profileImageFile = e.target.files[0];
    $("#profileImage").attr("src", window.URL.createObjectURL(profileImageFile));
    profileImageFnc = 1;
  }
  else
  {
    popUp("File not selected");
  }
});

$("#removeProfile").on("click", () => {
  alert("Are you sure you want to remove profile picture?");
  $("#profileImage").attr("src", "./Img/user.png");
  profileImageFnc = -1;
});

$("#cancelPIChanges").on("click", () => {
  if(profileImageFnc != 0)
  {
    alert("Are you sure you want to cancel profile picture chnages?");
    $("#profileImage").attr("src", inititalProfileImage);
    profileImageFnc = 0;
  }
});

$(document).ready(() => {
  //*ajax call for the teacher registration form (teacherRegistration.php);
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
  $("#teacherRegSubBtn").on("click", (event) => {
    event.preventDefault();

    let Fnameget = $("#firstName").val();
    let Lnameget = $("#lastName").val();
    let phoneNumberGet = $("#phoneNumber").val();
    let emailget = $("#email").val();
    let genderget = $("#gender").val();
    let ageGet = $("#age").val();
    let experienceGet = $("#experience").val();
    let modeGet = $("#mode").val();
    let localityGet = $("#locality").val();
    let mapLinkGet = $("#googleMapLink").val();
    let addressGet = $("#address").val();
    let stateGet = $("#state").val();
    let aboutGet = $("#about").text();
    let roleGet = $("input[name='reg-type']:checked").val();

    if (Fnameget === "" && $("#teacher").is(":checked")) {
      popUp("First name can not empty!");
      return false;
    } else if (Fnameget === "" && $("#institute").is(":checked")){
      popUp("Institute name can not empty!");
      return false;
    } else if (Lnameget === "" && $("#teacher").is(":checked")) {
      popUp("Last name can not empty!");
      return false;
    } else if (phoneNumberGet === "") {
      popUp("Phone Number can not empty!");
      return false;
    } else if (phoneNumberGet.length<10) {
      popUp("Enter valid phone number");
      return false;
    } else if (!(emailget === "") && (!emailget.includes("@") || !emailget.includes("."))) {
      popUp("Please enter a valid email!");
      return false;
    } else if (genderget === "" && $("#teacher").is(":checked")) {
      popUp("Select a gender");
      return false;
    } else if (!ageGet === "" && ageGet < 18 && $("#teacher").is(":checked")) {
      popUp("Age must be greater than 18!");
      return false;
    } else if (!ageGet === "" && ageGet > 80 && $("#teacher").is(":checked")) {
      popUp("Age can not be greater than 80!");
      return false;
    } else if (modeGet === "") {
      popUp("Provide your mode!");
      return false;
    } else if (localityGet === "" && !(modeGet === "Online")) {
      popUp("Please provide locality!");
      return false;
    } else if (addressGet === "" && !(modeGet === "Online")) {
      popUp("Please enter a valid address!");
      return false;
    } else if (stateGet === "" && !(modeGet === "Online")) {
      popUp("Please enter a valid state!");
      return false;
    } else if (experienceGet === "") {
      experienceGet = "";
    } else if (mapLinkGet === "") {
      mapLinkGet = "";
    } else console.log("N/A");

    if(aboutGet.length>2000)
    {
      popUp("'About' should not exceed 2000 characters!");
      return false;
    }
    if($("#institute").is(":checked")) {
      Lnameget="";
      genderget="";
      ageGet="";
      experienceGet="";
    }

    const subjectArray = [];
    const classArray = [];

    $("#subjects[name='subjects']").each((index, element) => {
      subjectArray.push($(element).val());
    });

    $("#classes[name='classes']").each((index, element) => {
      classArray.push($(element).val());
    });

    formData = new FormData();
    formData.append('fName', Fnameget);
    formData.append('lName', Lnameget);
    formData.append('phoneNumber', phoneNumberGet);
    formData.append('email', emailget);
    formData.append('gender', genderget);
    formData.append('age', ageGet);
    formData.append('experience', experienceGet);
    formData.append('mode', modeGet);
    formData.append('locality', localityGet);
    formData.append('mapLink', mapLinkGet);
    formData.append('address', addressGet);
    formData.append('state', stateGet);
    formData.append('about', aboutGet);
    formData.append('role', roleGet);
    formData.append('subjectArray', JSON.stringify(subjectArray));
    formData.append('classArray', JSON.stringify(classArray));

    if(profileImageFnc == 1)
    {
      profileImageFile = $("#upload-dp")[0].files[0];
      formData.append("profileImage", profileImageFile,);
    }

    $.ajax({
      url: "functions/teacherReg.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
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
        $("#mode").val("");
        $("#googleMapLink").val("");
        $("#address").val("");
        $("#state").val("");
        $("#about").val("");
        window.location.href ="adminDashboard.php";
      },
    });
  });

  //*ajax call for the teacher update form (teacherRegistration.php);
  $("#teacherUpdateSubBtn").on("click", async (event) => {
    event.preventDefault();

    let Fnameget = $("#firstName").val();
    let Lnameget = $("#lastName").val();
    let phoneNumberGet = $("#phoneNumber").val();
    let emailget = $("#email").val();
    let genderget = $("#gender").val();
    let ageGet = $("#age").val();
    let experienceGet = $("#experience").val();
    let modeGet = $("#mode").val();
    let localityGet = $("#locality").val();
    let mapLinkGet = $("#googleMapLink").val();
    let addressGet = $("#address").val();
    let stateGet = $("#state").val();
    let aboutGet = $("#about").val();
    let roleGet = $("input[name='reg-type']:checked").val();

    if (Fnameget === "" && $("#teacher").is(":checked")) {
      popUp("First name can not empty!");
      return false;
    } else if (Fnameget === "" && $("#institute").is(":checked")){
      popUp("Institute name can not empty!");
      return false;
    } else if (Lnameget === "" && $("#teacher").is(":checked")) {
      popUp("Last name can not empty!");
      return false;
    } else if (phoneNumberGet === "") {
      popUp("Phone Number can not empty!");
      return false;
    } else if (phoneNumberGet.length<10) {
      popUp("Enter valid phone number");
      return false;
    } else if (!(emailget === "") && (!emailget.includes("@") || !emailget.includes("."))) {
      popUp("Please enter a valid email!");
      return false;
    } else if (genderget === "" && $("#teacher").is(":checked")) {
      popUp("Select a gender");
      return false;
    } else if (!ageGet === "" && ageGet < 18 && $("#teacher").is(":checked")) {
      popUp("Age must be greater than 18!");
      return false;
    } else if (!ageGet === "" && ageGet > 80 && $("#teacher").is(":checked")) {
      popUp("Age can not be greater than 80!");
      return false;
    } else if (modeGet === "") {
      popUp("Provide your mode!");
      return false;
    } else if (addressGet === "" && !modeGet === "Online") {
      popUp("Please enter a valid address!");
      return false;
    } else if (stateGet === "" && !modeGet === "Online") {
      popUp("Please enter a valid state!");
      return false;
    } else if (localityGet === "" && !modeGet === "Online") {
      popUp("Please provide locality!");
      return false;
    } else if (experienceGet === "") {
      experienceGet = "";
    } else if (mapLinkGet === "") {
      mapLinkGet = "";
    } else console.log("N/A");

    if(aboutGet.length>2000)
    {
      popUp("'About' should not exceed 2000 characters!");
      return false;
    }
    if($("#institute").is(":checked")) {
      Lnameget="";
      genderget="";
      ageGet="";
      experienceGet="";
    }

    const subjectArray = [];
    const classArray = [];

    $("#subjects[name='subjects']").each((index, element) => {
      subjectArray.push($(element).val());
    });

    $("#classes[name='classes']").each((index, element) => {
      classArray.push($(element).val());
    });

    formData = new FormData();
    formData.append('fName', Fnameget);
    formData.append('lName', Lnameget);
    formData.append('phoneNumber', phoneNumberGet);
    formData.append('email', emailget);
    formData.append('gender', genderget);
    formData.append('age', ageGet);
    formData.append('experience', experienceGet);
    formData.append('mode', modeGet);
    formData.append('locality', localityGet);
    formData.append('mapLink', mapLinkGet);
    formData.append('address', addressGet);
    formData.append('state', stateGet);
    formData.append('about', aboutGet);
    formData.append('role', roleGet);
    formData.append('subjectArray', JSON.stringify(subjectArray));
    formData.append('classArray', JSON.stringify(classArray));

    if(profileImageFnc == 1)
    {
      profileImageFile = $("#upload-dp")[0].files[0];
      formData.append("profileImage", profileImageFile,);
    }
    else if(profileImageFnc == -1)
    {
      formData.append("removeProfileImage", "");
    }

    $.ajax({
      url: "functions/teacherUpdate.php?id="+$("#targetId").val(),
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: (res) => {  
        $("#firstName").val("");
        $("#lastName").val("");
        $("#phoneNumber").val("");
        $("#email").val("");
        $("#gender").val("");
        $("#age").val("");
        $("#experience").val("");
        $("#mode").val("");
        $("#googleMapLink").val("");
        $("#address").val("");
        $("#state").val("");
        $("#about").val("");
        popUp(res);
        window.location.href ="adminDashboard.php";
      }
    });
  });

  //banner upload
  $('#banner-upload').on("change",(e)=>{
    if(e.target.files.length>0){
      console.log();
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
        let formData2 = new FormData();
        formData2.append('banner-upload',e.target.files[0]);
        $.ajax({
          url:"uploadBannerImage.php?id="+document.getElementById("banner-upload").getAttribute("target"),
          type:"POST",
          data:formData2,
          contentType:false,
          processData:false,
          success:async (res)=>{
            popUp(res);
            await wait(3000);
            window.location.href = "adminDashboard.php";
          }
        });
      }
    }
    else
    {
      popUp("File is not selected");
    }
  });
});
  
const wait = (delay) => new Promise((resolve) => setTimeout(resolve, delay));

const deleteThis = (y) => {
  let childCount = $("#cloningArea").children().length;
  $(y).parent().remove();
};

$("#addRow").on("click", () => {
  $("#cloningElement").clone().appendTo("#cloningArea");
  $("#cloningArea").children().children("img").removeAttr("style");
});
