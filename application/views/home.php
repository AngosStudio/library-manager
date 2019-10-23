<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LIBB - Library Manager</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/bootstrap.min.css" />
    <script type="text/javascript">
        var BASE_URL = '<?php echo base_url() ?>';
    </script>
</head>
<body>
    <div class="container">
        <h1>LIBB - Library Manager</h1>
        <hr>
        <div class="row">
            <div class="col-md-9">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <!-- <th class="text-center">ID</th> -->
                            <th class="text-center">Name</th>
                            <th class="text-center">Genre</th>
                            <th class="text-center">Description</th>
                            <th class="text-center" width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody id="lib-books"></tbody>
                </table>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Book</h5>
                        <form method="post" action="#" id="lib-form">
                            <input type="hidden" id="id_book" name="id_book">
                            <div class="form-group">
                                <label for="id_genre">Genre</label>
                                <select class="form-control" id="id_genre" name="id_genre" required disabled></select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Book name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="10" required></textarea>
                            </div>
                            <button type="reset" class="btn">RESET</button>
                            <button class="btn btn-success float-right">SAVE BOOK</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url() ?>public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>public/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>public/js/app.js"></script>
</body>
</html>
