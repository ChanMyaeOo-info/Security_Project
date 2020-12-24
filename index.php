<?php
require_once "core/base.php";
require_once "core/function.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="feather-icons-web/feather.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <div class="row">

        <div class="col-8">

            <div class="card my-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            Contact List
                        </h4>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-hover">

                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach (friends() as $f) { ?>

                            <tr>

                                <td class="text-nowrap">
                                    <div class="d-flex align-items-center">
                                        <img src="upload/<?php echo $f['photo']; ?>" alt="" class="img_profile">
                                        <p class="font-weight-bolder mb-0 ml-3"><?php echo $f['name']; ?></p>
                                    </div>
                                </td>
                                <td class="text-nowrap">
                                    <p class="mb-0">
                                        <?php echo $f['phone']; ?>
                                    </p>
                                </td>
                                <td class="text-nowrap">
                                    <p class="mb-0">
                                        <?php echo $f['email']; ?>
                                    </p>
                                </td>

                            </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>
            </div>

        </div>

        <div class="col-4">

            <div class="card my-4">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="feather-user-plus"></i>
                        Add New Contact
                    </h4>
                </div>
                <div class="card-body">

                    <?php

                    if (isset($_POST['btn_add'])) {
                        add();
                    }

                    ?>

                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"
                                   value="<?php echo old('name'); ?>">

                            <?php if (getError('name')) { ?>
                                <small class="text-danger">
                                    <i class="feather-alert-circle"></i>
                                    <?php echo getError('name'); ?>
                                </small>
                            <?php } ?>

                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control"
                                   value="<?php echo old('email'); ?>">

                            <?php if (getError('email')) { ?>
                                <small class="text-danger">
                                    <i class="feather-alert-circle"></i>
                                    <?php echo getError('email'); ?>
                                </small>
                            <?php } ?>

                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control"
                                   value="<?php echo old('phone'); ?>">

                            <?php if (getError('phone')) { ?>
                                <small class="text-danger">
                                    <i class="feather-alert-circle"></i>
                                    <?php echo getError('phone'); ?>
                                </small>
                            <?php } ?>

                        </div>

                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" id="profile" name="profile" class="form-control">

                            <?php if (getError('profile')) { ?>
                                <small class="text-danger">
                                    <i class="feather-alert-circle"></i>
                                    <?php echo getError('profile'); ?>
                                </small>
                            <?php } ?>

                        </div>
                        <button class="btn btn-info w-100" name="btn_add">Add</button>


                    </form>

                </div>
            </div>

        </div>

    </div>

</div>
<?php clean_error(); ?>
</body>
</html>