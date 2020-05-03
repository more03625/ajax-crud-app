<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <style type="text/css">
         #successmessage{
         background: #DEF1D8;
         color: green;
         padding:10px; 
         margin:10px;
         display: none;
         position: absolute;
         right: 15px;
         top: 15px;
         }
         #errormessage{
         background: #EFDCDD;
         color: red;
         padding:10px; 
         margin:10px;
         display: none;
         position: absolute;
         right: 15px;
         top: 15px;
         }
      </style>
   </head>
   <body>
      <div class="container">
      	<div class="row">
      		<div class="col-md-12">
		         <h2 class="mb-4 mt-2">Ajax Form</h2>
		         <div id="#successmessage"></div>
		         <div id="#errormessage"></div>
		         <form class="form-inline" id="formhere">
		            <label for="email" class="mr-2">First Name:</label>
		            <input type="text" class="form-control mr-2" id="fname" placeholder="Enter fname" name="fname">
		            <label for="pwd" class="mr-2">Last Name:</label>
		            <input type="text" class="form-control" id="lname" placeholder="Enter last name" name="lname">
		            <button type="submit" class="ml-2 btn btn-primary" id="save-button">Submit</button>
		         </form>
		         <div id="#successmessage"></div>
		         <div id="#errormessage"></div>
		         <!-- Model here -->
		         <div class="modal fade" id="myModal">
		            <div class="modal-dialog modal-dialog-centered">
		               <div class="modal-content">
		                  <!-- Modal Header -->
		                  <div class="modal-header">
		                     <h4 class="modal-title">Modal Heading</h4>
		                     <button type="button" class="close" data-dismiss="modal" id="closeModel">&times;</button>
		                  </div>
		                  <div id="modal">
		                     <div id="modal-form">
		                        <!-- Modal footer -->
		                        <div class="modal-footer">
		                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		                        </div>
		                     </div>
		                  </div>
		               </div>
		            </div>
		         </div>
		         <!-- Model Ends here -->
		         <!-- table -->
		         <div id="tablehere" class="mt-4"></div>
      		</div>
      	</div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

      <script type="text/javascript">
        $(document).ready(function(){
 //load record from database
         		function loadTable(){
         			$.ajax({
         				url :"db-load-more.php",
         				type : "POST",
         				success : function(data){
         					$('#tablehere').html(data);
         				}
         			})
         		}
         		loadTable();
         
//Insert New record
         		$("#save-button").on("click", function(e){
         			e.preventDefault();
         			var fname = $("#fname").val();
         			var lname = $("#lname").val();
         			if (fname == "" || lname == "") {
         				 alert("All feilds are required");
         			}else{
         				$.ajax({
         					url :"db-ajax-insert.php",
         					type : "POST",
// data is in `KEY & VALUE paire, use KEY in php file`
         					data : {first_name: fname, last_name: lname},
         					success : function(data){
         						if (data == 1) {
         							loadTable();
         								$("#formhere").trigger("reset");
         						}else{
         								alert("can't save record");
         						}
         					}
         				});
         			}
         		})
         
// Delete Old record
         		$(document).on("click", ".delete-button", function(){
         			if (confirm("Do you really wants to delete this record")) {
         
         				var studentId = $(this).data('id');
         				var deleterow = this;
         
         				$.ajax({
         					url:"ajax-delete.php",
         					type:"POST",
// data is in `KEY & VALUE paire, use KEY in php file`
         					data : {delete_id : studentId},
         					success : function(data){
         						if (data == 1) {
         							$(deleterow).closest("tr").fadeOut();
         						}else{
         							alert("unable to delete this record");
         						}
         					}
         				});
         			}
         		});
         
// This is left
         		$(document).on("click", ".edit-button", function(e){
         			e.preventDefault();
         			$("#modal").show();
         			var studentId = $(this).data("eid");
         			
         			$.ajax({
         				url: "ajax-update.php",
         				type: "POST",
         				data: {id : studentId},
         				success : function(data){
         					$("#modal-form").html(data);
         				}
         			});
         		});
// update record
				$(document).on("click", "#edit-submit", function(){
					var edit_id = $("#edit-id").val();
					var edit_first_name = $("#edit-first-name").val();
					var edit_last_name = $("#edit-last-name").val();

					$.ajax({
						url: "ajax-update-form.php",
						type: "post",
// KEY & VALUE form of data. use KEY in php file
						data: {edit_id_KEY : edit_id, edit_first_name_KEY : edit_first_name, edit_last_name_KEY: edit_last_name},
						success : function(updateData){
							if (updateData == 1) {
								$("#closeModel").click();
								loadTable();
							}
						}

					});
				});
        });
      </script>
   </body>
</html>