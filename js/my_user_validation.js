$(document).ready(function(){
 // ready function is used to ensure that everything works fine//    
    
    
    $("form").submit(function(){
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var email = $("#email").val();
        var dob = $("#dob").val();
        var nic = $("#nic").val();
        var cno1 = $("#cno1").val();
        var cno2 = $("#cno2").val();
        var role_id = $("#role_id").val();
        
        
        if (fname =="")
        {
            $("#alertmsg").addClass("alert alert-danger");
            $("#alertmsg").html("First Name cannot be Empty!");
            return false;
        }
        if (lname =="")
        {
            $("#alertmsg").addClass("alert alert-danger");
            $("#alertmsg").html("Last Name cannot be Empty!");
            return false;
        }
        if (email =="")
        {
            $("#alertmsg").addClass("alert alert-danger");
            $("#alertmsg").html("Email cannot be Empty!");
            return false;
        }
        if (dob =="")
        {
            $("#alertmsg").addClass("alert alert-danger");
            $("#alertmsg").html("Date of Birth cannot be Empty!");
            return false;
        }
        if (nic =="")
        {
            $("#alertmsg").addClass("alert alert-danger");
            $("#alertmsg").html("NIC cannot be Empty!");
            return false;
        }
        
        var patnic = /^[0-9]{9}[vVxX]$/;
        var patcno = /^\+94[0-9]{9}$/;
        var patemail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6}+$/;
        
        if(!nic.match(patnic))
        {
            $("#alertmsg").addClass("alert alert-danger");
            $("#alertmsg").html("NIC is invalid");
            return false;
            
        }
        if(!email.match(patemail))
        {
            $("#alertmsg").addClass("alert alert-danger");
            $("#alertmsg").html("Email is invalid");
            return false;
            
        }
        if (!cno1.match(patcno))
        {
            $("#alertmsg").addClass("alert alert-danger");
            $("#alertmsg").html("Contanct Number is not valid");
            return false;
        }
        if (!cno2.match(patcno))
        {
            $("#alertmsg").addClass("alert alert-danger");
            $("#alertmsg").html("Contanct Number is not valid");
            return false;
        }
        return true;
    });
    
    
});
        
    
        

