<?php
require_once "../models/User.php";
require_once "../models/Cart.php";
require_once "../models/Product.php";

session_start();
$user = $_SESSION['current_user'];
$idUser = $user->getId();
$products = Cart::getProducts($idUser);
$totale = 0;
?>

<html>
<head>
    <title>Carrello</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body class="d-flex align-items-center justify-content-center bg-dark text-light">
<div class="card w-50 text-center p-2 bg-dark text-light mb-5 me-5">
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Prodotto</th>
            <th scope="col">Quantità</th>
            <th scope="col">Prezzo per unità</th>
            <th scope="col">Prezzo totale</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($products

        as $productC) {
        $product = Product::getProduct($productC['product_id']) ?>
        <tr>
            <td>#<?php echo $productC['product_id'] ?></td>
            <td><?php echo $product->getNome() ?></td>
            <td><?php echo $productC['quantita'] ?></td>
            <td><?php echo number_format($product->getPrezzo(), 2) ?>€</td>
            <?php $prezzo = $product->getPrezzo() * (float)$productC['quantita'] ?>
            <td><?php echo number_format($prezzo, 2) ?>€</td>
            <?php $totale = $totale + $prezzo ?>
            <td>
                <i class="fas fa-trash-alt"></i>
            </td>
            <td>
                <i class="fas fa-edit"></i>
            </td>
            <?php } ?>
        </tr>
        </tbody>
    </table>
</div>

<div class="card w-20 text-center p-2 bg-dark text-light mb-5 ms-5">
    <div class="card-body">
        <h5 class="card-title text-center">Riepilogo Ordine</h5>

        <p class="card-text">Prezzo Totale: <?php echo number_format($totale, 2) ?></p>

        <div class="d-flex justify-content-center">
            <a href="../actions/process_purchase.php" class="btn btn-success me-2">Acquista</a>
            <a href="products/index.php" class="btn btn-danger">Annulla</a>
        </div>
    </div>

</div>


</body>
