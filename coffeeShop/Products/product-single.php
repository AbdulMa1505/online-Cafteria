<?php
require '../includes/header.php';
require '../includes/connect.php';
 $rowcount =0;
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $name = $_POST['name'] ?? null;
    $image = $_POST['image'] ?? null;
    $price = $_POST['price'] ?? null;
    $product_id = $_POST['product_id'] ?? null;
    $description = $_POST['description'] ?? null;
    $quantity = $_POST['quantity'] ?? 1; 
    $user_id = $_SESSION['user_id'] ?? null;
// validation of cart
if(isset($_SESSION['user_id'])){
	$cartValidate=$conn->prepare("SELECT * FROM cart WHERE product_id=:product_id AND user_id=:user_id");
	$cartValidate->execute([
		"product_id"=>$product_id,
		"user_id"=>$_SESSION['user_id']
	]);
	$rowcount=$cartValidate->rowCount();
}
    // Ensuring all required fields are present
    if ($name && $image && $price && $description && $user_id) {
        try {
            // Prepare and execute the insert query
            $insert = $conn->prepare("INSERT INTO cart(name, image, price,product_id, description, quantity, user_id) VALUES(:name, :image, :price,:product_id, :description, :quantity, :user_id)");
            $insert->execute([
                ":name" => $name,
                ":image" => $image,
                ":price" => $price,
                ":product_id" => $product_id,
                ":description" => $description,
                ":quantity" => $quantity,
                ":user_id" => $user_id
            ]);

            // echo "Data inserted successfully!";
        } 
		catch (PDOException $e) {
            echo "Error inserting data: " . $e->getMessage();
        }
    } 
	else {
        echo "Please ensure all fields are filled out.";
    }
	
	
}

// Fetch product details if an ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Fetch single product
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
    } catch (PDOException $e) {
        echo "Error fetching product: " . $e->getMessage();
    }
	
} 
else {
    echo "<script>alert('No product specified.'); window.location.href = '" . APPURL . "/index.php';</script>";
    exit();
}
?>

<!-- HTML and Form for Product Details -->
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
                <a href="<?php echo APPURL; ?>/images/menu-2.jpg" class="image-popup"><img src="<?php echo APPURL; ?>/images/<?php echo $singleProduct->image;?>" class="img-fluid" alt="Colorlib Template"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3><?php echo $singleProduct->name;?></h3>
                <p class="price"><span>$<?php echo $singleProduct->price;?></span></p>
                <p><?php echo $singleProduct->description;?></p>
                <!-- form section for order submission -->
                <form action="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $singleProduct->product_id;?>" method="post">
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                    </div>
                    <input type="hidden" name="name" value="<?php echo $singleProduct->name;?>" >
                    <input type="hidden" name="image" value="<?php echo $singleProduct->image;?>" >
                    <input type="hidden" name="price" value="<?php echo $singleProduct->price;?>" >
                    <input type="hidden" name="product_id" value="<?php echo $singleProduct->product_id;?>" >
                    <input type="hidden" name="description" value="<?php echo $singleProduct->description;?>" >
					<?php if($rowcount > 0):?>
                    <button name="submit" type="submit"  class="btn btn-primary py-3 px-5" disabled>Added to Cart</button>
					<?php else: ?>
                    <button name="submit" type="submit"  class="btn btn-primary py-3 px-5">Add to Cart</button>
					<?php endif; ?>
				</form>
            </div>
        </div>
    </div>
</section>

<!-- Related Products Section -->
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Related products</h2>
                <p>Explore similar products based on category.</p>
            </div>
        </div>
        <div class="row">
            <?php foreach($relatedProducts as $type): ?>
            <div class="col-md-3">
                <div class="menu-entry">
                    <a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $type->product_id;?>" class="img" style="background-image: url(<?php echo APPURL; ?>/images/<?php echo $type->image;?>);"></a>
                    <div class="text text-center pt-4">
                        <h3><a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $type->product_id;?>"><?php echo $type->name;?></a></h3>
                        <p><?php echo $type->description;?></p>
                        <p class="price"><span>$<?php echo $type->price;?></span></p>
                        <p><a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $type->product_id;?>" class="btn btn-primary btn-outline-primary">Show</a></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require '../includes/footer.php'; ?>
