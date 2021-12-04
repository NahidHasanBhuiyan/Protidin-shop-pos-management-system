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
			<div class="col-md-4">
				<form action="" class="form-horizontal" id="frmCategory">
					<div class="form-group" align="left">
						<label>Category</label>
						<input class="form-control" type="text" name="catname" id="catname" placeholder="Category Name" required>
					</div>
					<div class="form-group" align="left">
						<label>Status</label>
						<select class="form-control" name="status" id="status" required="">
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="2">DeActive</option>
							
						</select>
					</div>

					<div align="right">
						<button type="button" class="btn btn-info" id="save" onclick="AddCategory()">Add</button>
						<button type="button" class="btn btn-warning" id="reset" onclick="">Reset</button>
						
					</div>
					
				</form>
			</div>
			<div class="col-md-8">
				<div class="panel-body">
					<table id="tbl-category" class="table table-responsive table-bordered" cellspacing="0" width="100%"> 
					<tr>
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
		var category_id = null;

		$('.frmCategory').on('click',function(){
			this.form.reset();
		});

		

		function AddCategory(){
			if($('#frmCategory').valid()){
				var _url='';
				var _data = '';
				var _method ;

				if(Isnew == true){
					 _url = '../php/category/add_category.php';
					 _data = $('#frmCategory').serialize();
					 _method = 'POST';
				}
				else{

					_url = '../php/category/update.php';
					 _data = $('#frmCategory').serialize() + "& category_id=" + category_id;
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
							msg = 'Category Created';
							
						}else{
							msg = 'Update Successfully';
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
				url: '../php/category/all_category.php',
				type: 'GET',
				dataType: 'JSON',

				success: function(data){
					$('#tbl-category').dataTable({
						"aaData": data
						,
						"scrollX": true,
						"bDestroy" : true,
						"aoColumns": [
							{"sTitle": "Category", "mData": "catname"},
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
								"mData": "id",
								"render": function(mData,type,row,meta){
									return '<button class="btn btn-xs  btn-success" onclick="get_Category_details(' + mData + ')">Edit</button>';
								}
							},
							{
								"sTitle": "Delete",
								"mData": "id",
								"render": function(mData,type,row,meta){
									return '<button class="btn btn-xs  btn-primary" onclick="RemoveCategory(' + mData + ')">Delete</button>';
								}
							}

						]
					});
				},
			});
		}

		function get_Category_details(id){
			$.ajax({
				url: '../php/category/edit_returns.php',
				type: 'POST',
				dataType: 'JSON',
				data: {category_id : id},

				success: function(data){
					$("html , body").animate({scrollTop: 0}, "slow");
					Isnew = false;
					category_id = data.id;

					$('#catname').val(data.catname);
					$('#status').val(data.status);

				}
			});
		}

		function RemoveCategory(id){
			$.confirm({
				theme: 'supervan',
				buttons:
				{
					yes: function()
					{
						$.ajax({
							url: '../php/category/remove_category.php',
							type: 'POST',
							dataType: 'JSON',
							data: {category_id: id},
							success: function(data){
								get_all()
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