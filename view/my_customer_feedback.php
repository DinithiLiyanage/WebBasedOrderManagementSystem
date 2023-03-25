<?php
    include '../commons/my_session.php';
?>



<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
    <style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
      }
      h1 {
      font-weight: 400;
      }
      h4 {
      margin: 15px 0 4px;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 3px;
      }
      form {
      width: 100%;
      padding: 20px;
      background: #fff;
      box-shadow: 0 2px 5px #ccc; 
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 3px;
      vertical-align: middle;
      }
      input:hover, textarea:hover {
      outline: none;
      border: 1px solid #095484;
      }
      th, td {
      width: 15%;
      padding: 15px 0;
      border-bottom: 1px solid #ccc;
      text-align: center;
      vertical-align: unset;
      line-height: 18px;
      font-weight: 400;
      word-break: break-all;
      }
      .first-col {
      width: 16%;
      text-align: left;
      }
      table {
      width: 100%;
      }
      textarea {
      width: calc(100% - 6px);
      }
      .btn-block {
      margin-top: 20px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      -webkit-border-radius: 5px; 
      -moz-border-radius: 5px; 
      border-radius: 5px; 
      background-color: #095484;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background-color: #0666a3;
      }
      @media (min-width: 568px) {
      th, td {
      word-break: keep-all;
      }
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
                    <div class="row">
                        <div class="col-md-12">
                            <div id="alertmsg"></div>
                            <?php
                                    if(isset($_GET["msg"]))
                                    {
                                    ?>
                            <div class="alert alert-danger">
                                    <?php echo base64_decode($_REQUEST["msg"])?>

                            </div>    
                                    <?php    
                                    }
                                    ?>
                        </div>
                    </div>
            <div class="testbox">
              <form action="../controller/my_feedback_controller.php?status=addFeedback" method="post">
                <h3>Customer Feedback Form</h3>
                <p>Please take a few minutes to give us feedback about our service by filling in this short Customer Feedback Form. We are conducting this research in order to measure your level of satisfaction with the quality of our service. We thank you for your participation.</p>
                <hr />
                <h4>Overall experience with our service</h4>
                <br/>
                <table>
                  <tr>
                    <th class="first-col"></th>
                    <th>Very Good</th>
                    <th>Good</th>
                    <th>Fair</th>
                    <th>Poor</th>
                    <th>Very Poor</th>
                  </tr>
                  <tr>
                      <td class="first-col"><small style="color: red;">*</small>How would you rate your overall experience with our service?</td>
                    <td><input type="radio" value="5" name="rate" /></td>
                    <td><input type="radio" value="4" name="rate" /></td>
                    <td><input type="radio" value="3" name="rate" /></td>
                    <td><input type="radio" value="2" name="rate" /></td>
                    <td><input type="radio" value="1" name="rate" /></td>
                  </tr>
                  <tr>
                    <td class="first-col"><small style="color: red;">*</small>How satisfied are you with the comprehensiveness of our offer?</td>
                    <td><input type="radio" value="5" name="satisfied" /></td>
                    <td><input type="radio" value="4" name="satisfied" /></td>
                    <td><input type="radio" value="3" name="satisfied" /></td>
                    <td><input type="radio" value="2" name="satisfied" /></td>
                    <td><input type="radio" value="1" name="satisfied" /></td>
                  </tr>
                  <tr>
                    <td class="first-col"><small style="color: red;">*</small>How would you rate our prices?</td>
                    <td><input type="radio" value="5" name="prices" /></td>
                    <td><input type="radio" value="4" name="prices" /></td>
                    <td><input type="radio" value="3" name="prices" /></td>
                    <td><input type="radio" value="2" name="prices" /></td>
                    <td><input type="radio" value="1" name="prices" /></td>
                  </tr>
                  <tr>
                    <td class="first-col"><small style="color: red;">*</small>How satisfied are you with the timeliness of order delivery?</td>
                    <td><input type="radio" value="5" name="timeliness" /></td>
                    <td><input type="radio" value="4" name="timeliness" /></td>
                    <td><input type="radio" value="3" name="timeliness" /></td>
                    <td><input type="radio" value="2" name="timeliness" /></td>
                    <td><input type="radio" value="1" name="timeliness" /></td>
                  </tr>
                  <tr>
                    <td class="first-col"><small style="color: red;">*</small>How satisfied are you with the customer support?</td>
                    <td><input type="radio" value="5" name="support" /></td>
                    <td><input type="radio" value="4" name="support" /></td>
                    <td><input type="radio" value="3" name="support" /></td>
                    <td><input type="radio" value="2" name="support" /></td>
                    <td><input type="radio" value="1" name="support" /></td>
                  </tr>
                  <tr>
                    <td class="first-col"><small style="color: red;">*</small>Would you recommend our product / service to other people?</td>
                    <td><input type="radio" value="5" name="recommend" /></td>
                    <td><input type="radio" value="4" name="recommend" /></td>
                    <td><input type="radio" value="3" name="recommend" /></td>
                    <td><input type="radio" value="2" name="recommend" /></td>
                    <td><input type="radio" value="1" name="recommend" /></td>
                  </tr>
                </table>
                <br/>
                <h4>What should we change in order to live up to your expectations?</h4>
                <textarea rows="3" name="suggestions"></textarea>
                <div class="btn-block">
                  <button type="submit">Send Feedback</button>
                </div>
              </form>
            </div>
        </div>    
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
</html>
