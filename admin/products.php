<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Products</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">List of Products
                <a href="products-create.php" class="btn btn-primary float-end">Add Product</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Product Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $products = getAll('product');
                        if (mysqli_num_rows($products) > 0) {
                            $count = 0;
                            foreach ($products as $item) :
                                $count++;
                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $item['ProductID'] ?></td>
                                    <td><?= $item['ProductName'] ?></td>
                                    <td><?= $item['Price'] ?></td>
                                    <td><?= $item['Quantity'] ?></td>
                                    <td>
                                        <img src="../<?= $item['ProductImage'] ?>" alt="Product Image" style="width:50px; height: 50px;">
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="products-edit.php?id=<?= $item['CategoryID'] ?>" class="btn btn-sm btn-success">Edit</a>
                                        <a href="products-delete.php?id=<?= $item['CategoryID'] ?>" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                        } else {
                            ?>
                            <tr>
                                <td></td>
                                <td colspan="7">No existing record.</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>