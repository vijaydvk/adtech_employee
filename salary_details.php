<?php
require_once("config.php");
if(isset($_POST['action']))
{
	$dept_name = $_POST['dept_name'];
	$salary = $_POST['salary'];
	$sql = "INSERT INTO emp_department (dept_id, dept_name, salary)
	VALUES (null,'$dept_name','$salary')";

	if ($conn->query($sql) === TRUE) {
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
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" style="margin-bottom:30px;">Add Department</button>
<br>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
				  <th>Department ID</th>
                  <th>Department Name</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tbody>
 			<?php
			if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT * from emp_department";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<tr><td>".$row['dept_id']."</td><td>".$row['dept_name']."</td><td>".$row['salary']."</td></tr>";
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Department Name:</label>
            <input type="text" class="form-control" id="dept_name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Salary</label>
            <input type="text" class="form-control" id="salary">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="save" class="btn btn-primary">Save</button>
      </div>
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
	
		$('#save').click(function(){

			$.ajax({
			  type: "POST",
			  url: "salary_details.php",
			  data: {"action":"add","dept_name":$('#dept_name').val(),"salary":$('#salary').val()}
			 }).done(function( msg ) {
				  alert( "Data Saved: " + msg );
				  $('#dept_name').val('');
				  $('#salary').val('');
				  location.href="salary_details.php";
			 });
		});
	});
	</script>
	
	
  </div>
</body>

</html>
