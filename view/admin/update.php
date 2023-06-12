<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Update Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
</head>
<style>
html {
    height: 100%;
}

body {
    background-image: linear-gradient(to right top,
            #d16ba5,
            #c777b9,
            #ba83ca,
            #aa8fd8,
            #9a9ae1,
            #8aa7ec,
            #79b3f4,
            #69bff8,
            #52cffe,
            #41dfff,
            #46eefa,
            #5ffbf1);
}

.btn-grad {
    background-image: linear-gradient(to right,
            #ef32d9 0%,
            #89fffd 51%,
            #ef32d9 100%);
    padding: 10px 35px;
    text-transform: uppercase;
    transition: 0.5s;
    background-size: 200% auto;
    color: #fff;
    box-shadow: 0 0 20px #eee;
    border-radius: 10px;
    border: none;
}

.btn-grad:hover {
    background-position: right center;
    /* change the direction of the change here */
    color: #fff;
    text-decoration: none;
}

.buttonDiv {
    text-align: center;
}

.card {
    width: 50%;
}

@media (max-width: 767px) {
    .card {
        width: 100%;
    }
}
</style>

<body>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card mx-auto">
                        <div class="card-body p-4">
                            <h1 class="card-text text-center fw-bold p-4">Update Menu</h1>
                            <h6 class="card-subtitle mb-2 text-muted text-center">
                                <a href="table.php">Kembali ke halaman admin</a>
                            </h6>
                            <div class="form-group mx-5 d-flex flex-column justify-content-center">
                                <form action="#">
                                    <div class="my-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Menu</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="" required />
                                    </div>
                                    <div class="my-3">
                                        <label for="bahan" class="form-label">Bahan:</label>
                                        <textarea id="bahan" name="bahan" class="form-control" required></textarea>
                                    </div>
                                    <div class="my-3">
                                        <label for="deskripsi" class="form-label">Deskripsi:</label>
                                        <textarea id="deskripsi" name="deskripsi" class="form-control"
                                            required></textarea>
                                    </div>
                                    <div class="my-3">
                                        <label for="harga" class="form-label">Harga:</label>
                                        <input class="form-control" type="number" min="1" step="any"
                                            placeholder="Masukan harga" name="harga" id="harga" value="" required />
                                    </div>
                                    <div class="my-3">
                                        <label for="gambar" class="form-label">Gambar:</label>
                                        <img src="" width="200px" />
                                        <br />
                                        <input type="file" id="gambar" name="gambar" class="form-control" />
                                    </div>
                                    <div class="buttonDiv my-3">
                                        <input type="submit" value="simpan" name="simpan" class="btn-grad" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
