<div class="row" style="height:15px;">
    <div class="col-md-12" style="text-align: right;">
        <br/>
        <a id="exit" href="../controller/my_logout_controller.php" style="color:#808080 ;">Logout</a>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-8">
        <h1 style="font-family: Papyrus; font-weight: bold; font-size: 35px ">Food Before Me</h1>
    </div>
    <div class="col-md-3" align="center">
        <br/>
        <span class="glyphicon glyphicon-user"></span>&nbsp;
        <span style="font-size:15px;">Welcome <?php echo $_SESSION["user"]["first_name"]; ?>!
        </span>
    </div>
    <div class='col-md-1' align='center'>
        <br/>
        <a href='../view/my_shopping_cart.php'>
            <span class="glyphicon glyphicon-shopping-cart" >
                <?php 
                if(isset($_SESSION["cart"]))
                {
                    echo count($_SESSION["cart"]);
                }
                ?>
            </span>
        </a>&nbsp;
    </div>
</div>
<hr/>