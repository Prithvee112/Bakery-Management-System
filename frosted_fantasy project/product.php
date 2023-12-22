<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>
<?=template_header('Product')?>

<div class="product content-wrapper">
    <img src="imgs/<?=$product['img']?>" width="500" height="500" alt="<?=$product['name']?>">
    <div>
        <h1 class="name"><?=$product['name']?></h1>
        <span class="price">
            &dollar;<?=$product['price']?>
            <?php if ($product['rrp'] > 0): ?>
            <span class="rrp">&dollar;<?=$product['rrp']?></span>
            <?php endif; ?>
        </span>
        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
        <h6>Product Details:</h6>
                <ul>
                    
                    <li>Version-Eggless</li>
                    <li>Type of Cake-Cream Cake</li>
                    <li>Weight-Half Kg</li>
                    <li>Shape-Round</li>
                    <li>Serves- 4-6 People</li>
                    <li>Size- 6 Inches in Diameter</li>
                </ul> 
                <h3>Description</h3>
                <h6>Please Note:</h6>
                <ul>
                    <li>The cake stand, cutlery & accessories used in the image are only for   representation purposes. They are not delivered with the cake.</li>
                    <li>This cake is hand delivered in a good quality cardboard box.</li>
                    <li>Country of Origin: India</li>
                </ul>
                <h3>Delivery Information</h3>
                <ul>
                    <li>Every cake we offer is handcrafted and since each chef has his/her own way of baking and designing a cake, there might be slight variation in the product in terms of design and shape.</li>
                    <li>The chosen delivery time is an estimate and depends on the availability of the product and the destination to which you want the product to be delivered.</li>
                    <li>Since cakes are perishable in nature, we attempt delivery of your order only once. The delivery cannot be redirected to any other address.</li>
                    <li>This product is hand delivered and will not be delivered along with courier products.</li>
                    <li>Occasionally, substitutions of flavours/designs is necessary due to temporary and/or regional unavailability issues.</li>
                </ul>
               <h3>Care Instructions</h3>
               <ul>
                <li>Store cream cakes in a refrigerator. Fondant cakes should be stored in an air conditioned environment.</li>
                <li>Slice and serve the cake at room temperature and make sure it is not exposed to heat.</li>
                <li>Use a serrated knife to cut a fondant cake.</li>
                <li>Sculptural elements and figurines may contain wire supports or toothpicks or wooden skewers for support.</li>
                <li>Please check the placement of these items before serving to small children.</li>
                <li>The cake should be consumed within 24 hours.</li>
                <li>Enjoy your cake!</li>
               </ul>
        </div>
    </div>
</div>

<?=template_footer()?>