<html>
<head>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
<link type='text/css' href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/dt/jq-2.2.0,dt-1.10.11,cr-1.3.1/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/t/dt/jq-2.2.0,dt-1.10.11,cr-1.3.1/datatables.min.js"></script>

</head>
<body>
<?php

echo '<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">';
//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css
echo '<link href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css" rel="stylesheet">';
echo "<script type='text/javascript'>
      /* All your javascript code goes here*/
        $(document).ready(function() {
        $('#example').DataTable();
        } );
  </script>";


$reputation = file_get_contents('http://test.localfeedbackloop.com/api?apiKey=61067f81f8cf7e4a1f673cd230216112&noOfReviews=10&internal=1&yelp=1&google=1&offset=50&threshold=1');
$jd = json_decode($reputation, true);
echo "<b>Business Name:</b>  ";
echo $jd['business_info']["business_name"];
echo "<br>";
echo "<b>Business Address:</b>  ";
echo $jd['business_info']["business_address"];
echo "<br>";
echo "<b>Total Average Rating:</b> ";
echo $jd['business_info']["total_rating"]["total_avg_rating"];
echo "<br>";
echo "<b>Total Number of Reviews:</b> ";
echo $jd['business_info']["total_rating"]["total_no_of_reviews"];
echo "<br>";
echo "<b>External URL:</b>   ";
echo $jd['business_info']["external_url"];
echo "<br>";
echo "<b>External Page URL:</b>   ";
echo $jd['business_info']["external_page_url"];
echo "<br>";


echo("<table id=\"example\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Data of Submission</th>
                <th>Customer Last Name</th>
                <th>Description</th>
                <th>Rating</th>
                <th>Review From</th>
                <th>Review URL</th>
                <th>Review ID</th>
                <th>Customer URL</th>
                <th>Review Source</th>
            </tr>
        </thead>");
echo "<tbody>";
$reviews = $jd["reviews"];
foreach ($reviews as $r) {
echo "<tr>";
		$tdCounter = 0;
	    foreach($r as $key => $val)
	           {
	                   echo "<td>";
	                   if ($tdCounter==5) {
	                           switch($val) {
	                                   case "0":
	                                           echo "Internal";
	                                           break;
	                                   case "1":
	                                           echo "Yelp";
	                                           break;
	                                   case "2":
	                                           echo "Google";
	                                           break;
									   default:
									   		   echo "None";	
	                           }
	                   }
	                   else
	                           echo $val;
	                   echo "</td>";
	                   $tdCounter++;
	           }
echo "</tr>";
}
echo "</tbody>";
echo "</table>";


?>
</body>
</html>