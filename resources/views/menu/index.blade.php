<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand">Navbar</a>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" id="inputSearch" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-info" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <div class="row mt-4">
            <div class="col-3">
                <div class="p-3 bg-primary">
                    <p class="font-weight-bold text-white float-left">Nama Barang :</p>
                    <p class="font-weight-bold text-white float-right">Caraka</p>
                    <div style="clear:both"></div>
                    <p class="font-weight-bold text-white float-left">Nomor Barang :</p>
                    <p class="font-weight-bold text-white float-right">112548</p>
                    <div style="clear:both"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    $('#inputSearch').on('keyup', function(){
        alert('berhasil')
    })
</script>