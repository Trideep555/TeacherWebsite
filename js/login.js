$('#signin-button').on("click",(e)=>{
    e.preventDefault();
    let userNameget = $('#email').val(); 
    let passwordget = $('#password').val();
    $.ajax({
        url:"loginCheck.php",
        type:"POST",
        data:{
        userName:userNameget,
        password:passwordget,
        },
        success:(result)=>{
            if(result === "0")
            {
                window.location.href = "adminDashboard.php";
            }
            else if(result === "-1")
            {
                popUp("User name is not registered!");
            }
            else if(result === "-2")
            {
                popUp("Incorrect password!");
            }
        }
    })
});