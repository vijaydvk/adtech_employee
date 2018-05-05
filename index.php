<?php
require_once("config.php");
if(isset($_POST['action']))
{
	$emp_dept = $_POST['emp_dept'];
	$name = $_POST['emp_name'];
	$sp_name = explode(',', $name);
	$sql = "INSERT INTO emp_details (emp_id, emp_name, emp_dept)
	VALUES ";
	foreach ($sp_name as $db_name) {
		$sql.= "(null,'$db_name','$emp_dept'),";
	}
	$sql= rtrim($sql,',');
	if ($conn->multi_query($sql) === TRUE) {
		echo "New records created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	echo "Success";
	return true;
}
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
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Create Employee</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Employee Name</label>
            <input class="form-control" id="employee_name" name="employee_name[]" type="email" aria-describedby="emailHelp" placeholder="Enter name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Employee Department</label>
            <select class="form-control" id="employee_department" name="employee_department">
			<option value="">--Please Select One --</option>
			<?php
			if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT dept_id, dept_name FROM emp_department";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<option value=".$row['dept_id'].">".$row['dept_name']."</option>";
					}
				} else {
					echo "0 results";
				}
				$conn->close();
			?>
			</select>
          </div>
          <button type="button" id="save" class="btn btn-primary btn-block">Save</button>
        </form>
      </div>
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
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
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
