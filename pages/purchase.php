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
			<div class="col-md-8">
				<form action="" class="form-horizontal" id="frmBrand">
					<form action="" class="form-horizontal" id="frmBrand">
					
						<div class="form-group" align="right" id="frmVendor">
							<label class="col-md-3">Vendor</label>
							<div class="col-md-3" align="right">
								<select class="form-control" name="vendor" id="vendor" required="">
									<option value="">Please Select</option>
									
									
								</select>
							</div>
						</div>
					</form>


				<form action=""  id="frmProduct">
					<table class="table table-bordered">
						<caption>Add Product</caption>
						<tr>
							<th>Product Code</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Qty</th>
							<th>Amount</th>
							<th>Option</th>
							
						</tr>
						<tr>
							<td>
								<input class="form-control" type="text" name="procode" id="procode" placeholder="procode" required>
							</td>
							<td>
								<input class="form-control" type="text" name="proname" id="proname" placeholder="proname" disabled>
							</td>
							<td>
								<input class="form-control" type="text" name="price" id="price" placeholder="price" disabled>
							</td>
							<td>
								<input class="form-control" type="number" name="qty" id="qty" placeholder="qty" min="1" value="1" required>
							</td>
							<td>
								<input class="form-control" type="text" name="tot_cost" id="tot_cost" disabled>
							</td>
							<td>
								<button class="btn btn-success" type="button" onclick="addProduct()">Add</button>
							</td>
						</tr>
						
					</table>
				</form>

					<table class="table table-bordered" id="productlist">

						<thead>
							<tr>
								<th>Remove</th>
								<th>Product Code</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Qty</th>
								<th>Amount</th>
							</tr>
						</thead>

						<tbody>
							
						</tbody>
						
					</table>

					
					
				</form>
			</div>
			<div class="col-md-4">
				<div class="panel-body">
					<div class="form-group" align="left">
						<label>Total</label>
						<input class="form-control" type="text" name="total" id="total" placeholder="total" disabled>
					</div>
					<div class="form-group" align="left">
						<label>Pay</label>
						<input class="form-control" type="text" name="pay" id="pay" placeholder="pay" >
					</div>
					<div class="form-group" align="left">
						<label>Due</label>
						<input class="form-control" type="text" name="due" id="due" placeholder="due" disabled>
					</div>
					<div class="form-group" align="left">
						<label>Payment Status</label>
						<select class="form-control" name="pstatus" id="pstatus" required="">
							<option value="">Select Status</option>
							<option value="1">Cash</option>
							<option value="2">Bkash</option>
							<option value="2">Cheak</option>
							
						</select>
					</div>

					<div align="right">
						<button type="button" class="btn btn-info" id="save" onclick="AddInvoice()">Add</button>
						<button type="button" class="btn btn-warning" id="reset" onclick="">Reset</button>
						
					</div>

				</div>
			</div>
		</div>
	</div>

	<script src="../components/jquery/dist/jquery.js"></script>
	<script src="../components/jquery/dist/jquery.min.js"></script>
	<script src="../components/jquery.validate.min.js"></script>
	<script src="../components/bootstrap/dist/js/bootstrap.js"></script>
	<script src="../components/bootstrap/dist/js/bootstrap.min.js"></script>
	
	<script src="http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

	<script src="../components/jquery-confirm-master/js/jquery-confirm.js"></script>

	<script>
		getVendor();
		function getVendor(){
			$.ajax({
				type: 'GET',
				url: '../php/vendor/get_vendor.php',
				dataType: 'JSON',
				success: function(data){
					for(var i=0;i<data.length;i++){
						$("#vendor").append($("<option/>",{
							value: data[i].vendor_id,
							text: data[i].vname,
						}));
					}
				}
			});
		}
		
		var isNew = true;
		 getProductcode();
		function getProductcode(){
			$('#procode').keyup(function(e){
				$.ajax({
					type: 'POST',
					url: '../php/product/get_product.php',
					dataType: 'JSON',
					data: {pro_code: $('#procode').val()},
					success: function(data){

						$('#proname').val(data[0].product_name);
						$('#price').val(data[0].price_retail);
						$('#qty').focus();

					},
					error: function(){

					}
				});
			});
		}


		$(function(){
			$("#price, #qty").on("click keydown keyup focus",qty);

			function qty(){
				var sum = ( Number($('#price').val())* Number($('#qty').val()) );

				$('#tot_cost').val(sum);
			}
		});



		function addProduct(){
			var product = {
				procode : $("#procode").val(),
				proname : $("#proname").val(),
				price : $("#price").val(),
				qty : $("#qty").val(),
				tot_cost : $("#tot_cost").val(),

			};
			addROw(product);
			$("#frmProduct")[0].reset();
			$("#procode").focus();
		}

		var total = 0;

		function addROw(product){

			if($('#procode').val().length == 0){
				$.alert({
					title: 'Error',
					content: 'Please Enter the Product Barcode',
					type: 'red',
					autoClose: 'ok|2000'
				});
			}
			else if(!$('#vendor').val()){
				$.alert({
					title: 'Error',
					content: 'Please Enter the Vendor Name',
					type: 'red',
					autoClose: 'ok|2000'
				});
			}
			else{



			var $tableB = $("#productlist tbody");
			var $row = $(

					"<tr>"+
					"<td>  <button type='button' name='record' class='btn btn-danger btn-xs' onclick='deleteRow(this)'>Delete </td>"+
					"<td>"+  product.procode +"</td>"+
					"<td>"+  product.proname +"</td>"+
					"<td>"+  product.price +"</td>"+
					"<td>"+  product.qty +"</td>"+
					"<td>"+  product.tot_cost +"</td>"+
					"</tr>"


				);

			$row.data("procode", product.procode);
			$row.data("proname", product.proname);
			$row.data("price", product.price);
			$row.data("qty", product.qty);
			$row.data("tot_cost", product.tot_cost);


			$tableB.append($row);

			total += Number(product.tot_cost) ;

			$("#total").val(total);

			

		}
	}


		var product_total_cost;

		function deleteRow(g){

			product_total_cost = parseInt($(g).parent().parent().find('td:last').text(),10);

			total -= product_total_cost;

			$("#total").val(total);


			$(g).parent().parent().remove();
		}

		$(function(){
			$("#total, #pay").on("keydown keyup",total);

			function total(){
				var sum = ( Number($('#total').val()) - Number($('#pay').val()) );

				$('#due').val(sum);
			}
		});

		function AddInvoice(){
			var table_data = [];

			$('#productlist tbody tr').each(function(row,tr){
				var sub = {
					'procode' : $(tr).find('td:eq(1)').text(),
					'pname' : $(tr).find('td:eq(2)').text(),
					'price' : $(tr).find('td:eq(3)').text(),
					'qty' : $(tr).find('td:eq(4)').text(),
					'total_cost' : $(tr).find('td:eq(5)').text()

				};
				
				table_data.push(sub);
			});
		

			$.ajax({
				method: 'POST',
				url: '../php/product/add_purchase.php',
				dataType: 'JSON',
				data: { vendor: $('#vendor').val(), total: $('#total').val(), pay: $('#pay').val(), due: $('#due').val() , pstatus: $('#pstatus').val(), data: table_data   },
				success: function(data){
					$.alert({
					title: 'Success',
					content: 'Successfully purchase added',
					type: 'green',
					autoClose: 'ok|2000'
				});
				}
			});
		};




	</script>
	
</body>
</html>