<?php
require_once '../../../models/Session.php';
require_once '../../../models/Product.php';
require_once '../../../models/User.php';
session_start();



if (isset($_SESSION['current_user'])) {
    $user = $_SESSION['current_user'];
    if (!$user->isAdmin()) {
        header('Location: http://localhost:63342/E-COMMERCE/views/products/index.php');
    }
}

if (!isset($_SESSION['current_user'])) {
    header("Location: ../../login.php");
    exit();
}

$id = $_GET['id'];
if ($id != 0) {
    $product = Product::getProduct($id);
    $nome = $product->getNome();
    $marca = $product->getMarca();
    $prezzo = $product->getPrezzo();
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Modifica Prodotto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-light d-flex align-items-center justify-content-center bg-dark text-light" style="height: 100vh;">
<div class="card w-50 text-center p-4 bg-secondary text-light">
    <?php if ($id != 0): ?>
        <div class="card-body">
            <h5 class="card-title display-4">Modifica Prodotto</h5>
            <form action="../../../actions/admin/update_product.php" method="post">
                <input type="hidden" id="id" name="id" min="0" value="<?php echo $id; ?>" required>

                <label for="nome" class="fs-6">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" class="form-control" required>
                <br>

                <label for="marca" class="fs-6">Marca:</label>
                <input type="text" id="marca" name="marca" value="<?php echo $marca; ?>" class="form-control" required>
                <br>

                <label for="prezzo" class="fs-6">Prezzo:</label>
                <input type="number" id="prezzo" name="prezzo" min="0" step="0.01" value="<?php echo $prezzo; ?>"
                       class="form-control" required>
                <br>
                <button type="submit" class="btn btn-success fs-5 me-2">Aggiorna Prodotto</button>
                <a href="../index.php" class="btn btn-danger fs-5">Annulla</a>
            </form>
        </div>
    <?php else: ?>
        <div class="card-body">
            <h5 class="card-title display-4">Aggiungi Prodotto</h5>
            <form action="../../../actions/admin/create_product.php" method="post">
                <label for="nome" class="fs-6">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
                <br>

                <label for="marca" class="fs-6">Marca:</label>
                <input type="text" id="marca" name="marca" class="form-control" required>
                <br>

                <label for="prezzo" class="fs-6">Prezzo:</label>
                <input type="number" id="prezzo" name="prezzo" min="0" step="0.01" class="form-control" required>
                <br>

                <button type="submit" class="btn btn-success fs-5 me-2">Crea Prodotto</button>
                <a href="../index.php" class="btn btn-danger fs-5">Annulla</a>
            </form>
        </div>
    <?php endif ?>
</div>
</body>