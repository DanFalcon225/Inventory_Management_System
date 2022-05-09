<?php require_once 'includes/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="dashboard.php">Home</a></li>
            <li class="active">Product</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading"><i class="glyphicon glyphicon-edit"></i> Manage Product</div>
                <div class="panel-body">
                    <div class="remove-messages"></div>

                    <div class="div-action pull pull-right" style="padding-bottom: 20px;">
                        <button class="btn btn-default" data-toggle="modal" data-target="#addProductModal" id="addProductModalBtn"> <i class="glyphicon glyphicon-plus-sign"></i> Add Product </button>
                    </div>

                    <table class="table" id="manageProductTable">
                        <thead>
                            <tr>
                                <th style="width:10%;">Photo</th>
                                <th>Product Name</th>
                                <th>Rate</th>
                                <th>Quantity</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th style="width:15%;">Options</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
    </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="addProductModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> <i class="fa fa-plus"></i> Add Product </h4>
      </div>

      <form class="form-horizontal" id="submitProductForm" action="php_action/createProduct.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body" style="max-height:450px;overflow:auto;">

                    <div id="add-product-messages"></div>

                    <div class="form-group">
                        <label for="productImage" class="col-sm-3 control-label">Product Image : </label>
                        <div class="col-sm-9">

                        <!-- the avatar markup -->
                        <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none;"></div>							
                          <div class="kv-avatar center-block">					        
                              <input type="file" class="form-control" id="productImage" name="productImage" class="file-loading" style="width:auto;"/>
                          </div>


                        </div>
                    </div>
                    <div class="form-group">
                        <label for="productName" class="col-sm-3 control-label">Product Name : </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="productName" name="productName" placeholder="Product Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="quantity" class="col-sm-3 control-label">Quantity : </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="rate" class="col-sm-3 control-label">Rate : </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="rate" name="rate" placeholder="Rate">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Brand Name : </label>
                        <div class="col-sm-9">
                            <select class="form-control" name="brandName" id="brandName">
                                <option value="">~~SELECT~~</option>
                                <?php 
                                $sql = "SELECT brand_id, brand_name FROM brands WHERE brand_status = 1 AND brand_active = 1";
                                $result = $connect->query($sql);
                                while($row = $result->fetch_array()){
                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                }
                                ?>
                            
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="categoryName" class="col-sm-3 control-label">Category Name : </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="categoryName" name="categoryName">
                              <option value="">~~SELECT~~</option>
                              <?php 
                              $sql = "SELECT categories_id, categories_name FROM category WHERE categories_active = 1 AND categories_status = 1";
                              $result = $connect->query($sql);
                              while($row = $result->fetch_array()){
                                echo "<option value='".$row[0]."'>".$row[1]."</option>";
                              }
                              ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="supplierName" class="col-sm-3 control-label">Supplier Name : </label>
                        <div class="col-sm-9">
                          <select class="form-control" id="supplierName" name="supplierName">
                            <option value="">~~SELECT~~</option>
                                  <?php 
                                  $sql = "SELECT supplier_id, supplier_name FROM suppliers WHERE supplier_active = 1 AND supplier_status = 1";
                                  $result = $connect->query($sql);
                                  while($row = $result->fetch_array()){
                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                  }
                                  ?>

                          </select>
                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="productStatus" class="col-sm-3 control-label">Status : </label>
                        <div class="col-sm-9">
                          <select class="form-control" id="productStatus" name="productStatus">
                            <option value="">~~SELECT~~</option>
                            <option value="1">Available</option>
                            <option value="2">Not Available</option>
                          </select>
                        </div>
                    </div>

                    
                
            </div>
        

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <button type="submit" class="btn btn-primary" id="createProductBtn" ata-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
            </div>

      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i>  Edit Product</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div class="div-result">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
				    <li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab">Product Info</a></li>    
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">

				  	
				<div role="tabpanel" class="tab-pane active" id="photo">
				<form action="php_action/editProductImage.php" method="POST" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">

				    	<br />
				    	<div id="edit-productPhoto-messages"></div>

				    	<div class="form-group">
			        	<label for="editProductImage" class="col-sm-3 control-label">Product Image: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">							    				   
						      <img src="" id="getProductImage" class="thumbnail" style="width:250px; height:250px;" />
						    </div>
			        </div> <!-- /form-group-->	     	           	       
				    	
			      	<div class="form-group">
			        	<label for="editProductImage" class="col-sm-3 control-label">Select Photo: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
							    <!-- the avatar markup -->
									<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
							    <div class="kv-avatar center-block">					        
							        <input type="file" class="form-control" id="editProductImage" placeholder="Product Name" name="editProductImage" class="file-loading" style="width:auto;"/>
							    </div>
						      
						    </div>
			        </div> <!-- /form-group-->	     	           	       

			        <div class="modal-footer editProductPhotoFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				        
				      </div>
				      <!-- /modal-footer -->
				      </form>
				      <!-- /form -->
				    </div>
				    <!-- product image -->
				    <div role="tabpanel" class="tab-pane" id="productInfo">
				    	<form class="form-horizontal" id="editProductForm" action="php_action/editProduct.php" method="POST">				    
				    	<br />

				    	<div id="edit-product-messages"></div>

				    	<div class="form-group">
			        	<label for="editProductName" class="col-sm-3 control-label">Product Name: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editProductName" placeholder="Product Name" name="editProductName" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	    

			        <div class="form-group">
			        	<label for="editQuantity" class="col-sm-3 control-label">Quantity: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editQuantity" placeholder="Quantity" name="editQuantity" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	        	 

			        <div class="form-group">
			        	<label for="editRate" class="col-sm-3 control-label">Rate: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editRate" placeholder="Rate" name="editRate" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	     	        

			        <div class="form-group">
			        	<label for="editBrandName" class="col-sm-3 control-label">Brand Name: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="editBrandName" name="editBrandName">
						      	<option value="">~~SELECT~~</option>
						      	<?php 
						      	$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} // while
										
						      	?>
						      </select>
						    </div>
			        </div> <!-- /form-group-->	

			        <div class="form-group">
			        	<label for="editCategoryName" class="col-sm-3 control-label">Category Name: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select type="text" class="form-control" id="editCategoryName" name="editCategoryName" >
						      	<option value="">~~SELECT~~</option>
						      	<?php 
						      	$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM category WHERE categories_status = 1 AND categories_active = 1";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} // while
										
						      	?>
						      </select>
						    </div>
			        </div> <!-- /form-group-->
              
              <div class="form-group">
                        <label for="editSupplierName" class="col-sm-3 control-label">Supplier Name : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                          <select type="text" class="form-control" id="editSupplierName" name="editSupplierName">
                            <option value="">~~SELECT~~</option>
                                  <?php 
                                  $sql = "SELECT supplier_id, supplier_name, supplier_active, supplier_status FROM suppliers WHERE supplier_active = 1 AND supplier_status = 1";
                                  $result = $connect->query($sql);
                                  while($row = $result->fetch_array()){
                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                  }
                                  ?>

                          </select>
                        
                        </div>
                    </div>

			        <div class="form-group">
			        	<label for="editProductStatus" class="col-sm-3 control-label">Status: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="editProductStatus" name="editProductStatus">
						      	<option value="">~~SELECT~~</option>
						      	<option value="1">Available</option>
						      	<option value="2">Not Available</option>
						      </select>
						    </div>
			        </div> <!-- /form-group-->	         	        

			        	<div class="modal-footer editProductFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				        <button type="submit" class="btn btn-primary" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				      </div> <!-- /modal-footer -->				     
				</form> <!-- /.form -->				     	
				    </div>    
				    <!-- /product info -->
				  </div>

				</div>
	      	
	      </div> <!-- /modal-body -->
	      	      
     	
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Product</h4>
      </div>
      <div class="modal-body">
        <div class="removeProductMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="custom/js/product.js"></script>

<?php require_once 'includes/footer.php'; ?>