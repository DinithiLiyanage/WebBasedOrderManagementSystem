<?php
include '../commons/my_session.php';
include '../model/my_insight_model.php';
$insightObj = new my_insight_model();

                                
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <style>
        * {box-sizing: border-box}
        body {font-family: "Lato", sans-serif;}

        /* Style the tab */
        .tab {
          float: left;
          border: 1px solid #ccc;
          background-color: #f1f1f1;
          width: 30%;
          height: 300px;
        }

        /* Style the buttons inside the tab */
        .tab button {
          display: block;
          background-color: inherit;
          color: black;
          padding: 22px 16px;
          width: 100%;
          border: none;
          outline: none;
          text-align: left;
          cursor: pointer;
          transition: 0.3s;
          font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
          background-color: #ddd;
        }

        /* Create an active/current "tab button" class */
        .tab button.active {
          background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
          float: left;
          padding: 0px 12px;
          border: 1px solid #ccc;
          width: 70%;
          border-left: none;
          height: 500px;
        }
        </style>
    </head>
    <body style="background-color: #F5F5F5; color: #808080;">
        <div class="container-fluid">
            <?php
                if($_SESSION["user"]["role_id"]== 1){
                    include '../includes/my_customer_heading.php';
                }
                else{
                    include '../includes/my_staff_heading.php';
                }
            ?>

            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'revenue')" id="defaultOpen">Monthly Revenue</button>
                <button class="tablinks" onclick="openCity(event, 'orders')">Number of Orders</button>
                <button class="tablinks" onclick="openCity(event, 'customers')">Number of Customers</button>
                <button class="tablinks" onclick="openCity(event, 'deliveries')">Number of Delivery Orders</button>
                <button class="tablinks" onclick="openCity(event, 'visits')">Number of Customer Visits</button>
                <button class="tablinks" onclick="openCity(event, 'favItems')">Number of Favorite Menu Items </button>
            </div>

            <div id="revenue" class="tabcontent">
              <h3>Monthly Revenue</h3>
                <br/>
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                      var data = google.visualization.arrayToDataTable([
                        ['Year', 'Sales'],
                        <?php 
                        $revResult = $insightObj ->getRevenue();
                        while($revRow = $revResult -> fetch_assoc()){
                        ?>
                        ['<?php echo $revRow["payment_date"];?>', <?php echo $revRow["Income"];?>],
                        <?php 
                        }
                        ?>
                       ]);

                      var options = {
                        title: 'Company Revenue',
                        curveType: 'function',
                        legend: { position: 'bottom' }
                      };

                      
                      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                      chart.draw(data, options);
                    }
                </script>
                <div class="col-md-10 col-md-offset-1" id="curve_chart" style="height:300px;"></div>
                
            </div>

            <div id="orders" class="tabcontent">
                <h3>Number Of Orders Placed</h3>
                <br/>
                <script type="text/javascript">
                    google.charts.load('current', {packages: ['corechart', 'line']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                    var data = new google.visualization.DataTable();
                        data.addColumn('date', 'Month');
                        data.addColumn('number', 'No. of Orders');
                        
                    
                        data.addRows([
                            <?php 
                            $ordResult = $insightObj ->getOrderCount();
                            while($ordRow = $ordResult -> fetch_assoc()){
                            ?>
                            [new Date(2022, <?php echo $ordRow["month"];?>), <?php echo $ordRow["count"];?>],
                            <?php 
                            }
                            ?>
                        ]);

                    var options = {
                        hAxis: {
                          title: 'Time'
                        },
                        vAxis: {
                          title: 'No. of orders'
                        }
                    };
                    var chart = new google.visualization.LineChart(document.getElementById('order_chart'));
                    chart.draw(data, options);
                    
                  }
                </script>
                <div class="col-md-10 col-md-offset-1" id="order_chart" style="height:300px;"></div>
                
            </div>

            <div id="favItems" class="tabcontent">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Top Selling Menu Items</h3>
                        <br/>
                        <table class="table " id="ordertable">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>% orders</th>
                                    <th>Total Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $itemResult = $insightObj ->getItemCount();
                                while($itemRow = $itemResult -> fetch_assoc())
                                {
                                ?>
                                    <tr>
                                        <td><?php echo $itemRow["item_name"];?></td>
                                        <td><?php echo $itemRow["count"];?></td>
                                        <?php 
                                        $cartResult = $insightObj ->getCartCount($itemRow["item_id"]);
                                        $cartRow = $cartResult -> fetch_assoc();
                                        $Totorders = $insightObj ->getTotOrders()-> fetch_assoc();
                                        $ord = $cartRow["count"] / $Totorders["count"] * 100;
                                        ?>
                                        <td><?php echo intval($ord);?>%</td>
                                        <?php $sumResult = $insightObj ->getTotIncome($itemRow["item_id"]) -> fetch_assoc(); ?>
                                        <td><?php echo number_format($sumResult["count"]);?></td>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        

        <script>
        function openCity(evt, cityName) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(cityName).style.display = "block";
          evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
        </script>
   
</body>
</html> 


