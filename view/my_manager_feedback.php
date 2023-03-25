<?php
    include '../commons/my_session.php';
    include '../model/my_feedback_model.php';
    $feedbackObj = new my_feedback_model();
    
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {packages: ['corechart', 'bar']});
                google.charts.setOnLoadCallback(drawBasic);

                function drawBasic() {
                    var data = google.visualization.arrayToDataTable([
                    ['Levels','Very Poor', 'Poor', 'Fair', 'Good', 'Very Good',{ role: 'annotation' },],
                    ['Satisfaction about the service', 
                        <?php echo $feedbackObj ->getSatisfaction(1) ->fetch_assoc()["SatisCount"]; ?>,
                        <?php echo $feedbackObj ->getSatisfaction(2) ->fetch_assoc()["SatisCount"]; ?>,
                        <?php echo $feedbackObj ->getSatisfaction(3) ->fetch_assoc()["SatisCount"]; ?>, 
                        <?php echo $feedbackObj ->getSatisfaction(4) ->fetch_assoc()["SatisCount"]; ?>, 
                        <?php echo $feedbackObj ->getSatisfaction(5) ->fetch_assoc()["SatisCount"]; ?>,''],
                    ['Prices', 
                        <?php echo $feedbackObj ->getPrices(1) ->fetch_assoc()["PriceCount"]; ?>, 
                        <?php echo $feedbackObj ->getPrices(2) ->fetch_assoc()["PriceCount"]; ?>, 
                        <?php echo $feedbackObj ->getPrices(3) ->fetch_assoc()["PriceCount"]; ?>, 
                        <?php echo $feedbackObj ->getPrices(4) ->fetch_assoc()["PriceCount"]; ?>,
                        <?php echo $feedbackObj ->getPrices(5) ->fetch_assoc()["PriceCount"]; ?>, ''],
                    ['Timeliness',
                        <?php echo $feedbackObj ->getTimeliness(1) ->fetch_assoc()["TimeCount"]; ?>, 
                        <?php echo $feedbackObj ->getTimeliness(2) ->fetch_assoc()["TimeCount"]; ?>, 
                        <?php echo $feedbackObj ->getTimeliness(3) ->fetch_assoc()["TimeCount"]; ?>, 
                        <?php echo $feedbackObj ->getTimeliness(4) ->fetch_assoc()["TimeCount"]; ?>,
                        <?php echo $feedbackObj ->getTimeliness(5) ->fetch_assoc()["TimeCount"]; ?>, ''],
                    ['Staff Supportiveness', 
                        <?php echo $feedbackObj ->getSupport(1) ->fetch_assoc()["SupportCount"]; ?>, 
                        <?php echo $feedbackObj ->getSupport(2) ->fetch_assoc()["SupportCount"]; ?>, 
                        <?php echo $feedbackObj ->getSupport(3) ->fetch_assoc()["SupportCount"]; ?>, 
                        <?php echo $feedbackObj ->getSupport(4) ->fetch_assoc()["SupportCount"]; ?>,
                        <?php echo $feedbackObj ->getSupport(5) ->fetch_assoc()["SupportCount"]; ?>, ''],
                    ['Wiilingness to recommend',
                        <?php echo $feedbackObj ->getRecommend(1) ->fetch_assoc()["RecommendCount"]; ?>, 
                        <?php echo $feedbackObj ->getRecommend(2) ->fetch_assoc()["RecommendCount"]; ?>, 
                        <?php echo $feedbackObj ->getRecommend(3) ->fetch_assoc()["RecommendCount"]; ?>, 
                        <?php echo $feedbackObj ->getRecommend(4) ->fetch_assoc()["RecommendCount"]; ?>,
                        <?php echo $feedbackObj ->getRecommend(5) ->fetch_assoc()["RecommendCount"]; ?>, '']
                    ]);

                var options = {
                  width: 1000,
                  height: 400,
                  colors: ['#557069', '#6A8C83', '#7FA89D', '#95C4B7', '#AAE0D1'],
                  legend: { position: 'top', maxLines: 3 },
                  bar: { groupWidth: '60%' },
                  isStacked: true
                };
                var chart = new google.visualization.BarChart(document.getElementById('criteriachartdiv'));
                chart.draw(data, options);


                }
            </script>
            <script type="text/javascript">
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                  var data = google.visualization.arrayToDataTable([
                    ['Overall Rating', 'Rating'],
                    ['Very Poor', <?php echo $feedbackObj ->getRate(1) ->fetch_assoc()["RateCount"]; ?>],
                    ['Poor',      <?php echo $feedbackObj ->getRate(2) ->fetch_assoc()["RateCount"]; ?>],
                    ['Fair',      <?php echo $feedbackObj ->getRate(3) ->fetch_assoc()["RateCount"]; ?>],
                    ['Good',      <?php echo $feedbackObj ->getRate(4) ->fetch_assoc()["RateCount"]; ?> ],
                    ['Very Good', <?php echo $feedbackObj ->getRate(5) ->fetch_assoc()["RateCount"]; ?>]
                  ]);

                  var options = {
                    title: 'Overall Customer Feedback',
                    colors: ['#FF0000', '#FFA500', '#98FB98', '#3CB371', '#4682B4'],
                    pieHole: 0.4,
                  };

                  var chart = new google.visualization.PieChart(document.getElementById('ratingchartdiv'));
                  chart.draw(data, options);
                }
            </script>
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
            
            <div class="row">
                <div class="col-md-12">
                    <h3 class="h3">Feedback Summary</h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <h4 class="h4">Overall Ratings</h4>
                    <div class="col-md-10 col-md-offset-1" id="ratingchartdiv" style="height:300px;"></div>
                </div>
                <div class="col-md-12">
                    <h4 class="h4">Rating Criteria</h4>
                    <div class="col-md-10 col-md-offset-1" id="criteriachartdiv" style="height:300px;"></div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
                        
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
                        
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <h4 class="h4">Customer Suggestions</h4>
                    <?php 
                        $feedbackResult = $feedbackObj ->getSuggestions();
                        while($feedbackRow = $feedbackResult -> fetch_assoc()){
                            if($feedbackRow["suggestions"] != ""){
                    ?>
                    <div class="col-md-12 col-md-offset-0">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p><?php echo $feedbackRow["suggestions"] ?></p>               
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
</html>


