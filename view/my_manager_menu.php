<?php
    include '../commons/my_session.php';
    include '../model/my_menu_model.php';
    $menuObj = new my_menu_model();
    $menuResult = $menuObj-> getAllCat();
    
   
?>    
    

<html>
    <head>
        <?php
        include '../includes/my_css_includes.php';
        ?>
        <style>
                /* Style the tab */
        .tab {
          overflow: hidden;
          border: 1px solid #ccc;
          background-color: #C0C0C0;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
          background-color: inherit;
          float: left;
          border: none;
          outline: none;
          cursor: pointer;
          padding: 14px 16px;
          transition: 0.3s;
          color: #FFFFFF;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
          background-color: #F5F5F5;
          color: black;
        }

        /* Create an active/current tablink class */
        .tab button.active {
          background-color: #808080;
          color: white;
        }

        /* Style the tab content */
        .tabcontent {
          display: none;
          padding: 6px 12px;
          border: 1px solid #ccc;
          border-top: none;
          height: 100%;
        }
        
        </style>
        
    </head>
    <body style="background-color:#F5F5F5 ;color: #808080; ">
        <div class="container-fluid">
            <?php
                if($_SESSION["user"]["role_id"]== 1){
                    include '../includes/my_customer_heading.php';
                }
                else{
                    include '../includes/my_staff_heading.php';
                }
            ?>
            
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group">
                        <a class="list-group-item" href="../view/my_add_item.php">
                            <span class="glyphicon glyphicon-plus"></span>&nbsp; Add new item
                        </a>
                        <a class="list-group-item" href="../view/my_add_promo.php">
                            <span class="glyphicon glyphicon-plus"></span>&nbsp; Add new promotional offer
                        </a>
                    </ul>
                </div>
                
            
            
                <div class="col-md-9">
                <!-- Tab links -->
                    <div class="tab">
                        <?php
                            while($menu_row = $menuResult->fetch_assoc())
                            {
                        ?>
                        <button class="tablinks" onclick="openItem(event, '<?php echo $menu_row["cat_name"]; ?>')"><?php echo $menu_row["cat_name"]; ?></button>
                        <?php
                            }
                        ?>       

                        &nbsp;
                        <button class="tablinks" onclick="openItem(event, 'Promos')" id="defaultOpen">PROMOS</button>
                    </div>

                    <!-- Tab content -->
                    <div id="RICE" class="tabcontent">

                                <?php
                                    $itemResult1 = $menuObj ->getAllItems(1);
                                    while($item_row1 = $itemResult1->fetch_assoc())
                                    {
                                ?>
                                    <a href="../view/my_menu_item_description.php?msg=<?php echo $item_row1["item_id"]; ?>">
                                        <div class= "col-md-offset-1 col-md-3 panel" style="border: 1px solid silver; padding: 5px; height: 210px; color: #808080;">

                                            <img src="../images/menu/<?php echo $item_row1["item_image"]; ?>" width="200px" height="120px" style="margin-left: 15px;"/>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div> 
                                            <h4 class="h4" style="font-weight: bold;"><?php echo $item_row1["item_name"]; ?></h4>
                                            <p>Rs.<?php echo $item_row1["regular_price"]; ?></p>
                                        </div>
                                    </a>
                                <?php
                                    }

                                ?>    
                                &nbsp;

                    </div>

                    <div id="NOODLES" class="tabcontent">
                                <?php
                                    $itemResult2 = $menuObj ->getAllItems(2);
                                    while($item_row2 = $itemResult2->fetch_assoc())
                                    {
                                ?>
                                    <a href="../view/my_menu_item_description.php?msg=<?php echo $item_row2["item_id"]; ?>">
                                        <div class= "col-md-offset-1 col-md-3 panel" style="border: 1px solid silver; padding: 5px; height: 240px; color: #808080;">

                                            <img src="../images/menu/<?php echo $item_row2["item_image"]; ?>" width="200px" height="120px" style="margin-left: 15px;"/>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div> 
                                            <h4 class="h4" style="font-weight: bold;"><?php echo $item_row2["item_name"]; ?></h4>
                                            <p>Rs.<?php echo $item_row2["regular_price"]; ?></p>
                                        </div>
                                    </a>
                                <?php
                                  }
                                ?>    
                                &nbsp;
                    </div>

                    <div id="PASTA" class="tabcontent">
                                <?php
                                    $itemResult3 = $menuObj ->getAllItems(3);
                                    while($item_row3 = $itemResult3->fetch_assoc())
                                    {
                                ?>
                                    <a href="../view/my_menu_item_description.php?msg=<?php echo $item_row3["item_id"]; ?>">
                                        <div class= "col-md-offset-1 col-md-3 panel" style="border: 1px solid silver; padding: 5px; height: 210px; color: #808080;">

                                            <img src="../images/menu/<?php echo $item_row3["item_image"]; ?>" width="200px" height="120px" style="margin-left: 15px;"/>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div> 
                                            <h4 class="h4" style="font-weight: bold;"><?php echo $item_row3["item_name"]; ?></h4>
                                            <p>Rs.<?php echo $item_row3["regular_price"]; ?></p>
                                        </div>
                                    </a>
                                <?php
                                  }
                                ?>    
                                &nbsp;
                    </div>

                    <div id="BURGERS AND PIZZA" class="tabcontent">
                                <?php
                                    $itemResult4 = $menuObj ->getAllItems(4);
                                    while($item_row4 = $itemResult4->fetch_assoc())
                                    {
                                ?>
                                    <a href="../view/my_menu_item_description.php?msg=<?php echo $item_row4["item_id"]; ?>">
                                        <div class= "col-md-offset-1 col-md-3 panel" style="border: 1px solid silver; padding: 5px; height: 210px; color: #808080;">

                                            <img src="../images/menu/<?php echo $item_row4["item_image"]; ?>" width="200px" height="120px" style="margin-left: 15px;"/>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div> 
                                            <h4 class="h4" style="font-weight: bold;"><?php echo $item_row4["item_name"]; ?></h4>
                                            <p>Rs.<?php echo $item_row4["regular_price"]; ?></p>
                                        </div>
                                    </a>
                                <?php
                                  }
                                ?>    
                                &nbsp;
                    </div>

                    <div id="BEVERAGES" class="tabcontent">
                                <?php
                                    $itemResult5 = $menuObj ->getAllItems(5);
                                    while($item_row5 = $itemResult5->fetch_assoc())
                                    {
                                ?>
                                    <a href="../view/my_menu_item_description.php?msg=<?php echo $item_row5["item_id"]; ?>">
                                        <div class= "col-md-offset-1 col-md-3 panel" style="border: 1px solid silver; padding: 5px; height: 210px; color: #808080;">

                                            <img src="../images/menu/<?php echo $item_row5["item_image"]; ?>" width="200px" height="120px" style="margin-left: 15px;"/>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div> 
                                            <h4 class="h4" style="font-weight: bold;"><?php echo $item_row5["item_name"]; ?></h4>
                                            <p>Rs.<?php echo $item_row5["regular_price"]; ?></p>
                                        </div>
                                    </a>
                                <?php
                                  }
                                ?>    
                                &nbsp;
                    </div>

                    <div id="Promos" class="tabcontent">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                <?php
                                $promoResult = $menuObj ->getAllPromos();
                                while($promoRow = $promoResult -> fetch_assoc())
                                {
                                ?>
                                <div class="panel panel-default">
                                    <div class="panel-body" style="margin-right: 20px">
                                        <div class="row">
                                            <img src="../images/promo/<?php echo $promoRow["promo_image"]; ?>" align="left" width="200px" height="120px" style="margin-left: 20px; padding-right: 20px;"/>
                                            <h3 class="h3" style="font-weight: bold; "><?php echo $promoRow["promo_heading"]; ?></h3>
                                            <p><?php echo $promoRow["promo_descript"]; ?></p>
                                            <p><small class="text-muted">*Terms and conditions apply</small></p>
                                            <a href="../controller/my_menu_controller.php?remove=<?php echo $promoRow["promo_id"];?>" class="removeItem" >
                                                <button type="button"  class="btn btn-default btn-sm" style="float: right" >
                                                    <span class="glyphicon glyphicon-trash" ></span>
                                                </button>
                                            </a>
                                        </div> 
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                         
        </div>                            
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_customer_menu_validation.js" type="text/javascript"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
    
</html>                                  
                                
                            
                        
                        
                    
            
        
        
            
     





