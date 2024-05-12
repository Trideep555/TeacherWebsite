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

const tCarousel = document.getElementsByClassName("carousel-cu")[0];

let isDragging = false;

const tDragging = (e) => {
  if(!isDragging) return;
  tCarousel.scrollLeft -= e.movementX;
}

try
{
  tCarousel.addEventListener("mouseup", () => {
    tCarousel.classList.add("scroll-smooth");
    isDragging  = false;
  });
  tCarousel.addEventListener("mousedown", () => {
    tCarousel.classList.remove("scroll-smooth");
    isDragging  = true;
  });
  tCarousel.addEventListener("mousemove", tDragging);
}
catch(error)
{
  console.log(error);
}

$(".tArrow").on("click", function() {
  console.log(this.id)
  tCarousel.scrollLeft -= (this.id === "left") ? 400 : -400;
});

const iCarousel = document.getElementsByClassName("carousel-cu")[1];

const iDragging = (e) => {
  if(!isDragging) return;
  iCarousel.scrollLeft -= e.movementX;
}

try
{
  iCarousel.addEventListener("mouseup", () => {
    iCarousel.classList.add("scroll-smooth");
    isDragging  = false;
  });
  iCarousel.addEventListener("mousedown", () => {
    iCarousel.classList.remove("scroll-smooth");
    isDragging  = true;
  });
  iCarousel.addEventListener("mousemove", iDragging);
}
catch(error)
{
  console.log(error);
}

$(".iArrow").on("click", function() {
  console.log(this.id)
  iCarousel.scrollLeft -= (this.id === "left") ? 400 : -400;
});

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

//contact us form validation
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
        $("#textBox").val("");
      },
    });
  });

  //faq submit button
  $("#faq-submit-button").on("click", (event) => {
    let emailget = $("#faq-mail").val().trim();
    if (emailget === "") {
      popUp("Please provide email address!");
      return false;
    }
    $("#faq-mail").val("");
    $("#email").val(emailget);
  });
});


//teacher-profile show classes and subjects
$('#showTable').on("click",()=>{
  $('#tableArea').show();
});
$(document).on("click",(event)=>{
  if(event.target.id!=='tableSection' && event.target.id!=='showTable')
  {
    $('#tableArea').hide();
  }
})