<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=template_header('Home')?>

<div class="featured">
    <!-- <h2></h2>
    <p></p> -->
    <div class="d-flex flex-row mb-3" id="background">
      <div class="p-2" id="image"><img src="cake13.png" alt="" ></div>
      <div class="p-2" id="wallpaper">
        <h1>Baked with Love</h1>
        <h3>Delicious Cakes</h3>
        <a href="index.php?page=products"><button style="background-color: red; border:red"><h3>See Now</h3></button></a>
      </div>
    </div>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
            <span class="price">
                &dollar;<?=$product['price']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&dollar;<?=$product['rrp']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>