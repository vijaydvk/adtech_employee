<?php
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Adtech Solutions LLC</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.legacy.css" rel="stylesheet">
  
  
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
<?php require_once("menu.php");?>
  <div class="content-wrapper">
    <div class="container-fluid">
  <div class="container">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
				  <th>ID</th>
                  <th>Name</th>
                  <th>Department</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tbody>
 			<?php
			if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT ed.emp_id,ed.emp_name,edep.dept_name,edep.salary from emp_details ed,emp_department edep
						where ed.emp_dept=edep.dept_id";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<tr><td>".$row['emp_id']."</td><td>".$row['emp_name']."</td><td>".$row['dept_name']."</td><td>".$row['salary']."</td></tr>";
					}
				} else {
					echo "0 results";
				}
				$conn->close();
			?>
              </tbody>
            </table>
          </div>
  </div>

      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/selectize.js"></script>
	<script>
	$(document).ready(function(){
		var $select = $('#employee_name').selectize({
			delimiter: ',',
			persist: false,
			create: function(input) {
				return {
					value: input,
					text: input
				}
			}
		});
		
		$('#save').click(function(){

			$.ajax({
			  type: "POST",
			  url: "index.php",
			  data: {"action":"add","emp_name":$('#employee_name').val(),"emp_dept":$('#employee_department').val()}
			 }).done(function( msg ) {
				  alert( "Data Saved: " + msg );
					var selectize = $select[0].selectize;
					selectize.clear();
				  $('#employee_department').val('')
			 });
		});
	});
	</script>
	
	
  </div>
</body>

</html>
