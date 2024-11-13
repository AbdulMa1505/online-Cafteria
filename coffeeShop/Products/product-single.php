<?php
require '../includes/header.php';
require '../includes/connect.php';

// add to cart
if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$image=$_POST['image'];
	$price=$_POST['price'];
	$description=$_POST['description'];
	$user_id=$_SESSION['user_id'];
	$insert=$conn->prepare("INSERT INTO cart(name,image,price,description,quantity,user_id) VALUES(:name,:image,:price,:description,:quantity,:user_id)");
	$insert->execute([
		":name"=>$name,
		":image"=>$image,
		":price"=>$price,
		":description"=>$description,
		":quantity"=>$quantity,
		":user_id"=>$user_id
	]);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
	// echo "Product ID from URL: " . htmlspecialchars($id);
    // single product
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $singleProduct = $stmt->fetch(PDO::FETCH_OBJ);
    
    if ($singleProduct) {
      
        $type = $singleProduct->type;
        $product_id = $singleProduct->product_id;
        
        // Fetch related products
        $relatedProduct = $conn->prepare("SELECT * FROM products WHERE type = :type AND product_id != :id");
        $relatedProduct->bindParam(':type', $type, PDO::PARAM_STR);
        $relatedProduct->bindParam(':id', $product_id, PDO::PARAM_INT);
        $relatedProduct->execute();
        $relatedProducts = $relatedProduct->fetchAll(PDO::FETCH_OBJ);
        
    } else {
        
        echo "<script>alert('Product not found.'); window.location.href = '" . APPURL . "/index.php';</script>";
        exit();
    }
		
} else {
    
    echo "<script>alert('No product specified.'); window.location.href = '" . APPURL . "/index.php';</script>";
    exit();


}

?>
 

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Product Detail</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Product Detail</span></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="<?php echo APPURL; ?>images/menu-2.jpg" class="image-popup"><img src="<?php echo APPURL; ?>/images/<?php echo $singleProduct->image;?>" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3><?php echo $singleProduct->name;?></h3>
    				<p class="price"><span>$<?php echo $singleProduct->price;?></span></p>
    				<p><?php echo $singleProduct->description;?></p>
						<div class="row mt-4">
							<div class="col-md-6">
								<div class="form-group d-flex">
		              <div class="select-wrap">
	                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                  <select name="" id="" class="form-control">
	                  	<option value="">Small</option>
	                    <option value="">Medium</option>
	                    <option value="">Large</option>
	                    <option value="">Extra Large</option>
	                  </select>
	                </div>
		            </div>
							</div>
							<div class="w-100"></div>
							<div class="input-group col-md-6 d-flex mb-3">
	             			<span class="input-group-btn mr-2">
								<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
								<i class="icon-minus"></i>
								</button>
	            		</span>
						<form action="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $singleProduct->id;?>" method="post">
									<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
									<span class="input-group-btn ml-2">
										<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
										<i class="icon-plus"></i>
										</button>
									</span>
								</div>
							</div>
			
							<input type="text" name="name" value="<?php echo $singleProduct->name;?>" >
							<input type="text" name="image" value="<?php echo $singleProduct->image;?>" >
							<input type="text" name="price" value="<?php echo $singleProduct->price;?>" >
							<input type="text" name="description" value="<?php echo $singleProduct->description;?>" >
							<p><button name="submit" type="submit"  class="btn btn-primary py-3 px-5">Add to Cart</button></p>
						</form>
          	
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
          	<span class="subheading">Discover</span>
            <h2 class="mb-4">Related products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
        <div class="row">
			<?php foreach($relatedProducts as $type):?>
        	<div class="col-md-3">
        		<div class="menu-entry">
    					<a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $type->product_id;?>" class="img" style="background-image: url(<?php echo APPURL; ?>/images/<?php echo $type->image;?>);"></a>
    					<div class="text text-center pt-4">
    						<h3><a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $type->product_id;?>"><?php echo $type->name;?></a></h3>
    						<p><?php echo $type->description;?></p>
    						<p class="price"><span>$<?php echo $type->price;?></span></p>
    						<p><a target="_blank" href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $type->product_id;?>" class="btn btn-primary btn-outline-primary">show</a></p>
    					</div>
    				</div>
        	</div>
        	<?php endforeach;?>
        </div>
    	</div>
    </section>

	<?php require '../includes/footer.php'; ?>
