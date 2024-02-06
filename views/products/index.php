<?php
require_once '../../models/Session.php';
require_once '../../models/Product.php';
require_once '../../models/User.php';
require_once '../../partials/navbar.php';

$products = Product::getProducts();
if (isset($_SESSION['current_user'])) {
    $user = $_SESSION['current_user'];
    $admin = $user->isAdmin();
} else {
    $admin = false;
}
?>

<html>
<head>
    <style>
        .fa-size{
            font-size: 16em;
        }
        .custom-button {
            background-color: transparent;
            border: none;
            padding: 0;
        }

    </style>

    <title>Catalogo Prodotti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/1.19.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-dark text-light">
<div class="container mt-4">
    <div class="row justify-content-center">
        <?php foreach ($products
                       as $product) { ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product->getNome() ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>ID prodotto:</strong> #<?php echo $product->getId() ?></li>
                        <li class="list-group-item"><strong>Marca:</strong> <?php echo $product->getMarca() ?></li>
                        <li class="list-group-item">
                            <strong>Prezzo:</strong> <?php echo number_format($product->getPrezzo(), 2) ?>€
                        </li>
                    </ul>
                    <?php if ($admin): ?>
                        <div class="card-body d-flex justify-content-between">
                            <form action="../../actions/select_product.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
                                <button type="submit" class="btn btn-success">Modifica</button>
                            </form>

                            <form action="../../actions/admin/delete_product.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </div>

                    <?php else: ?>
                        <div class="card-body">
                            <form action="../../actions/select_product.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
                                <button type="submit" class="btn btn-success">Visualizza</button>
                            </form>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        <?php } ?>
        <?php if ($admin){?>
        <div class="col-md-4 mb-4">
            <div class="card ">
                <div class="card-body d-flex align-items-center justify-content-center p-0"> <!-- p-0 rimuove il padding -->
                    <form action="../../actions/select_product.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo 0 ?>">
                        <button type="submit" class="custom-button w-100 h-100">
                            <i class="fas fa-plus fa-size"></i>
                        </button>
                    </form>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</body>
</html>