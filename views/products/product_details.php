<?php
require_once "../../models/Product.php";
$id = $_GET['id'];
if (isset($_GET['quantita'])) {
    $quantita = $_GET['quantita'];
}

$product = Product::getProduct($id);
$nome = $product->getNome();
$marca = $product->getMarca();
$prezzo = $product->getPrezzo();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Dettagli Prodotto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-light d-flex align-items-center justify-content-center bg-dark text-light" style="height: 100vh;">
<div class="card w-50 text-center p-4 bg-secondary text-light">
    <div class="card-body">
        <h5 class="card-title display-4"><?php echo $nome; ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?php echo $marca; ?></h6>
        <p class="card-text fs-5">Prezzo: <?php echo $prezzo; ?> €</p>
        <div class="d-flex justify-content-center">
            <?php if (isset($_GET['quantita'])): ?>
                <form action="../../actions/update_cart.php" method="post">
                    <label for="quantita" class="fs-6">Quantità:</label>
                    <input type="number" id="quantita" name="quantita" min="1" value=<?php echo $quantita; ?> required>
                    <br><br>

                    <button type="submit" class="btn btn-success fs-5 me-2">Aggiorna</button>
                    <input type="hidden" name="idProduct" value="<?php echo $id; ?>">
                    <a href="http://localhost:63342/E-COMMERCE/views/cart.php" class="btn btn-danger fs-5">Annulla</a>
                </form>

            <?php else : ?>
                <form action="../../actions/add_to_cart.php" method="post">
                    <label for="quantita" class="fs-6">Quantità:</label>
                    <input type="number" id="quantita" name="quantita" min="1" value="1" required>
                    <br><br>

                    <button type="submit" class="btn btn-success fs-5 me-2">Aggiungi al Carrello</button>
                    <input type="hidden" name="idProduct" value="<?php echo $id; ?>">
                    <a href="index.php" class="btn btn-danger fs-5">Annulla</a>
                </form>
            <?php endif ?>
        </div>
    </div>
</div>

</body>
</html>
