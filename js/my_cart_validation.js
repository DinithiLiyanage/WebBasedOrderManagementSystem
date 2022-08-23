$(document).ready(function(){
    //If user wants to end session
    $("#clearAll").click(function(){
        var clear = confirm("Are you sure to clear the cart?");
        if(clear==false){return false;}     
    });
    $(".removeItem").click(function(){
        var remove = confirm("Are you sure to remove this item?");
        if(remove==false){return false;}     
    });
    
});




