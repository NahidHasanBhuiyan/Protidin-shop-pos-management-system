
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
			<div class="col-sm-12">
				<form id="frmProduct" action="">
					<div>
						<h3>Product</h3>
						<br>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group" align="left">
						           <label>Product Name</label>
						           <input class="form-control" type="text" name="productName" id="productName" placeholder="ProductName" required>
					            </div>
							</div>
							<div class="col-md-3">
								<div class="form-group" align="left">
						           <label>Product Description</label>
						           <input class="form-control" type="text" name="productDescription" id="productDescription" placeholder="Description" >
					            </div>
							</div>
							<div class="col-md-3">
								<div class="form-group" align="left">
						           <label>Category Name</label>
						           <select id="category" name="category"  class="form-control">
						           	<option value="">select category</option>
						           	
						           </select>
					            </div>
							</div>
							<div class="col-md-3">
								<div class="form-group" align="left" >
						           <label>Brand Name</label>
						           <select id="brand" name="brand" class="form-control">
						           	<option value="" >select brand</option>
						           	
						           </select>
					            </div>
							</div>
							
							
							<div class="col-md-3">
								<div class="form-group" align="left">
						           <label>Warrenty</label>
						           <input class="form-control" type="text" name="warrenty" id="warrenty" placeholder="warrrenty" required>
					            </div>
							</div>
							<div class="col-md-3">
								<div class="form-group" align="left">
						           <label>Cost Price</label>
						           <input class="form-control" type="text" name="costPrice" id="costPrice" placeholder="cost price" required>
					            </div>
							</div>
							<div class="col-md-3">
								<div class="form-group" align="left">
						           <label>Retail Price</label>
						           <input class="form-control" type="text" name="retailPrice" id="retailPrice" placeholder="retail price" required>
					            </div>
							</div>
							<div class="col-md-3">
								<div class="form-group" align="left">
						           <label>Barcode</label>
						           <input class="form-control" type="text" name="barcode" id="barcode" placeholder="barcode" readonly="" value="">
					            </div>
							</div>
							<div class="col-md-3">
								<div class="form-group" align="left">
						           <label>Reorder Level</label>
						           <input class="form-control" type="text" name="reorderLevel" id="reorderLevel" placeholder="reorder level" required>
					            </div>
							</div>
							<div class="col-md-3">
								<div class="form-group" align="left">
						           <label>Product Date</label>
						           <input class="form-control" type="date" name="productDate" id="productDate" placeholder="Date" required>
					            </div>
							</div>
							<div class="col-md-3">
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
						  <button type="button" class="btn btn-info" id="save" onclick="AddProduct()">Add</button>
						  <button type="button" class="btn btn-warning" id="reset" onclick="">Reset</button>
						
					    </div>
					</div>
				</form>
			</div>
		</div>
	

	<div class="row">
		<div class="col-md-12">
				<div class="panel-body">
					<table id="tbl-product" class="table table-responsive table-bordered" cellspacing="0" width="100%"> 
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
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
		getCategory();
		getBrand();
		
		function getCategory(){
			$.ajax({
				type: 'GET',
				url: '../php/category/getcategory.php',
				dataType: 'JSON',
				success: function(data){

					for(var i =0;i<data.length;i++){
						$('#category').append($("<option/>",{
							value: data[i].id,
							text : data[i].catname,
						}));
					}
				}
			});
		}

		function getBrand(){
			$.ajax({
				type: 'GET',
				url: '../php/brand/getbrand.php',
				dataType: 'JSON',
				success: function(data){
					for(var i=0;i<data.length;i++){
						$('#brand').append($("<option/>",{
							value: data[i].id,
							text: data[i].brandname,
						}))
					}
				}
			});
		}
		
		
		
		var Isnew = true;
		
		get_all();
		var id = null;

		

		function AddProduct(){
			if($('#frmProduct').valid()){
				var _url='';
				var _data = '';
				var _method ;

				if(Isnew == true){
					 _url = '../php/product/add_product.php';
					 _data = $('#frmProduct').serialize();
					 _method = 'POST';
				}
				else{

					_url = '../php/product/update.php';
					 _data = $('#frmProduct').serialize() + "& id=" + id;
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
							msg = 'Product Created Successfully';
							
						}else{
							msg = 'Product Updated Successfully';
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
				url: '../php/product/all_product.php',
				type: 'GET',
				dataType: 'JSON',

				success: function(data){
					$('#tbl-product').dataTable({
						"aaData": data
						,
						"scrollX": true,
						"bDestroy" : true,
						"aoColumns": [
							{"sTitle": "Product", "mData": "product_name"},
							{"sTitle": "Description", "mData": "description"},
							{"sTitle": "Barcode", "mData": "barcode"},
							{"sTitle": "Category", "mData": "category_id"},
							{"sTitle": "Brand", "mData": "brand_id"},
							{"sTitle": "Warrenty", "mData": "warrenty"},
							{"sTitle": "Retail Price", "mData": "price_retail"},
							{"sTitle": "Cost Price", "mData": "price_cost"},
							{"sTitle": "Reorder Level", "mData": "reorderlevel"},
							{"sTitle": "Qty", "mData": "qty"},
							{"sTitle": "Date", "mData": "date"},
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
								"mData": "product_id",
								"render": function(mData,type,row,meta){
									return '<button class="btn btn-xs  btn-success" onclick="get_product_details(' + mData + ')">Edit</button>';
								}
							},
							{
								"sTitle": "Delete",
								"mData": "product_id",
								"render": function(mData,type,row,meta){
									return '<button class="btn btn-xs  btn-primary" onclick="RemoveProduct(' + mData + ')">Delete</button>';
								}
							}

						]
					});
				},
			});
		}

		function get_product_details(product_id){
			$.ajax({
				url: '../php/product/edit_returns.php',
				type: 'POST',
				dataType: 'JSON',
				data: {id : product_id},

				success: function(data){
					$("html , body").animate({scrollTop: 0}, "slow");
					Isnew = false;
					id = data.product_id;

					$('#productName').val(data.product_name);
					$('#productDescription').val(data.description);
					$('#category').val(data.category_id);
					$('#brand').val(data.brand_id);
					$('#warrenty').val(data.warrenty);
					$('#costPrice').val(data.price_cost);
					$('#retailPrice').val(data.price_retail);
					$('#barcode').val(data.barcode);
					$('#reorderLevel').val(data.reorderlevel);
					$('#productDate').val(data.date);
					$('#status').val(data.status);

				}
			});
		}

		function RemoveProduct(product_id){
			$.confirm({
				theme: 'supervan',
				buttons:
				{
					yes: function()
					{
						$.ajax({
							url: '../php/product/remove_product.php',
							type: 'POST',
							dataType: 'JSON',
							data: {id: product_id},
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