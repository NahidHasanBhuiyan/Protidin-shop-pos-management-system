
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="../components/jquery-confirm-master/css/jquery-confirm.css">
	<link rel="stylesheet" href="http://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>
<body>

 <?php
 	include('header.php');

 ?>

<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<form id="frmVendor" action="">
					<div>
						<h3>Vendor</h3>
						<br>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group" align="left">
						           <label>Vendor Name</label>
						           <input class="form-control" type="text" name="vendorname" id="vendorname" placeholder="VendorName" required>
					            </div>
							</div>
							<div class="col-md-4">
								<div class="form-group" align="left">
						           <label>Contact Number</label>
						           <input class="form-control" type="text" name="contactno" id="contactno" placeholder="contact no." >
					            </div>
							</div>
							
							
							
							<div class="col-md-4">
								<div class="form-group" align="left">
						           <label>Email</label>
						           <input class="form-control" type="text" name="email" id="email" placeholder="email" required>
					            </div>
							</div>
							<div class="col-md-4">
								<div class="form-group" align="left">
						           <label>Address</label>
						           <input class="form-control" type="text" name="address" id="address" placeholder="address" required>
					            </div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group" align="left">
						           <label>Status</label>
						           <select id="status" name="status"  class="form-control">
						           	<option value="">select status</option>
						           	<option value="1">Active</option>
						           	<option value="2">DeActive</option>
						           	
						           </select>
					            </div>
							</div>


						</div>
						<div align="right">
						  <button type="button" class="btn btn-info" id="save" onclick="AddVendor()">Add</button>
						  <button type="button" class="btn btn-warning" id="reset" onclick="">Reset</button>
						
					    </div>
					</div>
				</form>
			</div>
		</div>
	

	<div class="row">
		<div class="col-md-12">
				<div class="panel-body">
					<table id="tbl-vendor" class="table table-responsive table-bordered" cellspacing="0" width="100%"> 
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						
						<th></th>
						
						
					</tr>
						
					</table>
				</div>
		</div>
	</div>
</div>

	<script src="../components/jquery/dist/jquery.js"></script>
	<script src="../components/jquery/dist/jquery.min.js"></script>
	<script src="../components/jquery.validate.min.js"></script>
	<script src="../components/bootstrap/dist/js/bootstrap.js"></script>
	<script src="../components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="../components/jquery-confirm-master/js/jquery-confirm.js"></script>
	<script src="http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

	<script>
		
		var Isnew = true;
		
		get_all();
		var id = null;

		

		function AddVendor(){
			if($('#frmVendor').valid()){
				var _url='';
				var _data = '';
				var _method ;

				if(Isnew == true){
					 _url = '../php/vendor/add_vendor.php';
					 _data = $('#frmVendor').serialize();
					 _method = 'POST';
				}
				else{

					_url = '../php/vendor/update.php';
					 _data = $('#frmVendor').serialize() + "& id=" + id;
					 _method = 'POST';


				}

				$.ajax({
					type : _method,
					data : _data,
					url : _url,
					dataType : 'JSON',
					success: function(data){
						get_all();
						
						var msg;

						
							
						


						if(Isnew){
							msg = 'Vendor Created Successfully';
							
						}else{
							msg = 'Vendor Updated Successfully';
						}

						$.alert({
							title : 'Success!',
							content : msg,
							type : 'GREEN',
							boxWidth : '400px',
							theme : 'light',
							useBootstrap : false,
							autoClose : 'ok|2000'
						});
					},
				});

			}
		}

		function get_all(){
			

			
			
    

			
			
			$.ajax({
				url: '../php/vendor/all_vendor.php',
				type: 'GET',
				dataType: 'JSON',

				success: function(data){
					$('#tbl-vendor').dataTable({
						"aaData": data
						,
						"scrollX": true,
						"bDestroy" : true,
						"aoColumns": [
							{"sTitle": "Vendor", "mData": "vname"},
							{"sTitle": "Contact No", "mData": "contactno"},
							{"sTitle": "Email", "mData": "email"},
							{"sTitle": "Address", "mData": "address"},
							
							{
								"sTitle": "Status", "mData": "status", "render" : function(mData, type, row, meta){
									if(mData == 1){
										return '<span class="label label-info">Active</span>';
									}else if(mData == 2){
										return '<span class="label label-warning">DeActive</span>';
									}
								}
							},
							{
								"sTitle": "Edit",
								"mData": "vendor_id",
								"render": function(mData,type,row,meta){
									return '<button class="btn btn-xs  btn-success" onclick="get_vendor_details(' + mData + ')">Edit</button>';
								}
							},
							{
								"sTitle": "Delete",
								"mData": "vendor_id",
								"render": function(mData,type,row,meta){
									return '<button class="btn btn-xs  btn-primary" onclick="RemoveVendor(' + mData + ')">Delete</button>';
								}
							}

						]
					});
				},
			});
		}

		function get_vendor_details(vendor_id){
			$.ajax({
				url: '../php/vendor/edit_returns.php',
				type: 'POST',
				dataType: 'JSON',
				data: {id : vendor_id},

				success: function(data){
					$("html , body").animate({scrollTop: 0}, "slow");
					Isnew = false;
					id = data.vendor_id;

					$('#vendorname').val(data.vname);
					$('#contactno').val(data.contactno);
					$('#email').val(data.email);
					$('#address').val(data.address);
					$('#status').val(data.status);
					

				}
			});
		}

		function RemoveVendor(vendor_id){
			$.confirm({
				theme: 'supervan',
				buttons:
				{
					yes: function()
					{
						$.ajax({
							url: '../php/vendor/remove_vendor.php',
							type: 'POST',
							dataType: 'JSON',
							data: {id: vendor_id},
							success: function(data){
								get_all();
							}
						});
					}
					,
					no: function()
					{

					}
				}
			})
		}


	</script>
	
</body>
</html>