$(document).ready(function(){
    $("form").submit(function(){
        var username = $("#username").val();
        var password = $("#password").val();
        
        if(username===""){
            $("#alertmsg").addclass("alert alert-danger");
            $("#alertmsg").html("Username cannot be empty!");
            return false;
        }
        if(password===""){
            $("#alertmsg").addclass("alert alert-danger");
            $("#alertmsg").html("Password cannot be empty!");
            return false;
        }
        
    });
});
