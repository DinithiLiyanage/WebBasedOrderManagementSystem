$(document).ready(function(){
    $("form").submit(function(){
        event.preventDefault();
        item_id = $(".item_id").val();
        user_id = $(".user_id").val();
        item_image = $(".item_image").val();
        item_name = $(".item_name").val();
        quantity = $(".quantity").val();
        size = $(".portion_size").val();
        if($(".chicken_addon").is(":checked")){
            chicken_addon = $(".chicken_addon").val();
        }else{
            chicken_addon = 0;
        };
        if($(".egg_addon").is(":checked")){
            egg_addon = $(".egg_addon").val();
        }else{
            egg_addon = 0;
        };
        remarks = $(".remarks").val();
        
        var url = "../controller/my_menu_controller.php?status=editcart";
        
        $.post(url, {
                    item_id:item_id, 
                    user_id:user_id, 
                    item_image:item_image, 
                    item_name:item_name,
                    quantity:quantity, 
                    size:size, 
                    chicken_addon:chicken_addon, 
                    egg_addon:egg_addon, 
                    remarks:remarks},
                    function(data){
                        $(".alert-message").html(data);
        });
    });
    
    
});
    
        
        
       


