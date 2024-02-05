<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Krystian Kosior">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Zadanie zdalne</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="headers.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</head>
<body>
<main>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="container d-flex flex-wrap justify-content-center">
                <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                    <span class="fs-4">Zadanie zdalne </span>
                </a>
            </div>
        </header>
    </div>
    <div class="b-example-divider"></div>
    <div class="row">
        <div class="col-md-3" id="Lewy">
        <?php include('menu.php'); ?>
         
        </div>
        <div class="col-md-9" id="Prawy">
    <h2 class="mb-3">Dane Kontrahenta</h2>
    <form>
        <div class="mb-3">
            <label for="nip" class="form-label">Imię:</label>
            <input type="text" class="form-control" id="nip" name="nip" required>
        </div>

        <div class="mb-3">
            <label for="regon" class="form-label">REGON:</label>
            <input type="number" class="form-control" id="regon" name="regon" required>
        </div>

        <div class="mb-3">
            <label for="nazwa" class="form-label">NAZWA:</label>
            <input type="text" class="form-control" id="nazwa" name="nazwa" required>
        </div>

        <div class="mb-3">
            <label for="dataPowstania" class="form-label">DATA POWSTANIA:</label>
            <input type="date" class="form-control" id="dataPowstania" name="dataPowstania" required>
        </div>

        <div class="mb-3">
            <label for="ulica" class="form-label">ULICA:</label>
            <input type="text" class="form-control" id="ulica" name="ulica" required>
        </div>

        <div class="mb-3">
            <label for="numerDomu" class="form-label">NUMER DOMU:</label>
            <input type="text" class="form-control" id="numerDomu" name="numerDomu" required>
        </div>

        <div class="mb-3">
            <label for="numerMieszkania" class="form-label">NUMER MIESZKANIA:</label>
            <input type="text" class="form-control" id="numerMieszkania" name="numerMieszkania" required>
        </div>

        <div class="mb-3">
            <label for="uwagi" class="form-label">UWAGI:</label>
            <textarea class="form-control" id="uwagi" name="uwagi" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="kolory" class="form-label">Kolory:</label>
            <select class="form-select" id="kolory" name="kolory">
                <option value="zielony">Zielony</option>
                <option value="niebieski">Niebieski</option>
                <option value="szary">Szary</option>
                <option value="turkusowy">Turkusowy</option>
                <option value="granatowy">Granatowy</option>
                <option value="czerwony">Czerwony</option>
                <option value="biały">Biały</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="vat" class="form-label">VAT:</label>
            <select class="form-select" id="vat" name="vat">
                <option value="ZW">ZW</option>
                <option value="NP">NP</option>
                <option value="0%">0%</option>
                <option value="3%">3%</option>
                <option value="8%">8%</option>
                <option value="23%">23%</option>
            </select>
        </div>

        <div class="mb-3">
            <h3 class="mb-3">Lista uporządkowana numerowana:</h3>
            <ol>
                <li>Element</li>
                <li>Element</li>
                <li>Element</li>
            </ol>
        </div>
        <button type="submit" class="btn btn-primary">Zapisz</button>
    </form>
</div>
    </div>
</main>

<div class="fixed-bottom bg-body-tertiary">
    <div class="b-example-divider"></div>
    <div class="container">
        <footer class="mt-auto">
            <p class="text-center text-muted">&copy; Krystian Kosior</p>
        </footer>
    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</body>
</html>
<script>
        
        $(document).ready(function () {
            $('#dataPowstania').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                language: 'pl'
            });
        });
    </script>

