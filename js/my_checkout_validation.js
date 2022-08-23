$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var method = $(this).val();
        $("div.method").hide();
        $("#show"+method).show();
        
    });
    
    $("form").submit(function(){
        event.preventDefault();
        
        user_id = $("#user_id").val();
        notes = $("#notes").val();
        fname = $("#fname").val();
        lname = $("#lname").val();
        cno1 = $("#cno1").val();
        deliverymethod = document.querySelector('input[name="deliverymethod"]:checked').value;
        if(deliverymethod === "delivery"){
            d_fname = $("#d_fname").val();
            d_lname = $("#d_lname").val();
            d_address = $("#d_address").val();
            d_city = $("#d_city").val();
            d_cno1 = $("#d_cno1").val();
            
            
        }else{
            d_fname = 0;
            d_lname = 0;
            d_address = 0;
            d_city = 0;
            d_cno1 = 0;
        };
        if(deliverymethod === "pickup"){
            p_fname = $("#p_fname").val();
            p_lname = $("#p_lname").val();
            p_time = $("#p_time").val();
        }else{
            p_fname = 0;
            p_lname = 0;
            p_time = 0;
        };
        
        
        var url = "../controller/my_checkout_controller.php?status=checkout";
        
        
        $.post(url, {
                    user_id:user_id, 
                    notes:notes, 
                    fname:fname,
                    lname:lname,
                    cno1:cno1, 
                    deliverymethod:deliverymethod, 
                    d_fname:d_fname, 
                    d_lname:d_lname, 
                    d_address:d_address,
                    d_city:d_city,
                    d_cno1:d_cno1,
                    p_fname:p_fname,
                    p_lname:p_lname,
                    p_time:p_time
                    },
                    function(data){
                        $("#grand_total").html(data);
                        $("#paymentButton").show();
                        window.scrollTo(0,0);
                        if(deliverymethod === "delivery"){
                            document.getElementById('deliverycharges').innerHTML = "Rs.150";
                        }
                        
        });
    });
});


