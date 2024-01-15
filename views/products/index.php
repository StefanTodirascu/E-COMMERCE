<?php
include '../../models/Session.php';
include '../../models/Product.php';
include 'navbar.php';

session_start();

$products = Product::getProducts();
?>

<html>
<head>
    <title>Catalogo Prodotti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</head>
<body class="bg-dark text-light">
<div class="container mt-4">
    <div class="row justify-content-center">
        <?php foreach ($products
                       as $product) { ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product->getNome() ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>ID prodotto:</strong> #<?php echo $product->getId() ?></li>
                        <li class="list-group-item"><strong>Marca:</strong> <?php echo $product->getMarca() ?></li>
                        <li class="list-group-item"><strong>Prezzo:</strong> <?php echo $product->getPrezzo() ?></li>
                    </ul>

                    <div class="card-body">
                        <?php
                        // Aggiungi l'ID del prodotto alla query string del link
                        $product_id = $product->getId();
                        echo '<a href="buy_product.php?id=' . $product_id . '" class="btn btn-success" type="button">Acquista</a>';
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>