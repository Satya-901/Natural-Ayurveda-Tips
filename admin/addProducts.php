<?php include ('db_connect.php'); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $price = floatval($_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $specifications = mysqli_real_escape_string($conn, $_POST['specifications']);
    $benefits = mysqli_real_escape_string($conn, $_POST['benefits']);

    $productimage1 = $_FILES["productimage1"]["name"];
    $tempname = $_FILES["productimage1"]["tmp_name"];
    $image = "../assets/img/" . $productimage1;
    move_uploaded_file($tempname, $image);

    $productimage2 = $_FILES["productimage2"]["name"];
    $tempname = $_FILES["productimage2"]["tmp_name"];
    $image = "../assets/img/" . $productimage2;
    move_uploaded_file($tempname, $image);

    $productimage3 = $_FILES["productimage3"]["name"];
    $tempname = $_FILES["productimage3"]["tmp_name"];
    $image = "../assets/img/" . $productimage3;
    move_uploaded_file($tempname, $image);

    $sqlproduct = "INSERT INTO `product_list`(`category_id`, `name`, `specification`,`benefits`, `description`, `price`, `img_path`, `productimage2`, `productimage3`, `status`) VALUES ('$category_id','$name','$specifications','$benefits','$description','$price','$productimage1','$productimage2','$productimage3','1')";

    if ($conn->query($sqlproduct) === TRUE) {
        echo "<script>alert('Product Added added');window.location='index.php?page=addproducts';</script>";
    } else {
        echo "<script>alert('Something went wrong');window.location='index.php?page=addproducts';</script>";
    }

}
?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            Add Product
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label class="control-label">product Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Category </label>
                                <select name="category_id" id="" class="custom-select browser-default">
                                    <?php
                                    $cat = $conn->query("SELECT * FROM category_list order by name asc ");
                                    while ($row = $cat->fetch_assoc()):
                                        ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Price</label>
                                <input type="number" class="form-control text-right" name="price" step="any">
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="control-label">Image</label>
                                        <input type="file" class="form-control" name="productimage1" id="productimage1">
                                        <img id="preview1" src="#" alt="" style="max-width: 100px; max-height: 100px;">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="control-label">Image</label>
                                        <input type="file" class="form-control" name="productimage2" id="productimage2">
                                        <img id="preview2" src="#" alt="" style="max-width: 100px; max-height: 100px;">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="control-label">Image</label>
                                        <input type="file" class="form-control" name="productimage3" id="productimage3">
                                        <img id="preview3" src="#" alt="" style="max-width: 100px; max-height: 100px;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Benefits</label>
                                <textarea cols="30" rows="3" class="form-control" name="benefits"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Specifications</label>
                                <textarea cols="30" rows="3" class="form-control" name="specifications"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea cols="30" rows="3" class="form-control" name="description"></textarea>
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" name="submit" value="Save">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->
        </div>
    </div>
</div>
<script>
    <script>
        function previewImage(input, imgElement) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            imgElement.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // Convert image to base64 string
    }
}

        // Example: Assuming your file inputs have ids productimage1, productimage2, productimage3
        $(document).ready(function() {
            $('#productimage1').change(function () {
                previewImage(this, $('#preview1'));
            });

        $('#productimage2').change(function() {
            previewImage(this, $('#preview2'));
    });

        $('#productimage3').change(function() {
            previewImage(this, $('#preview3'));
    });
});
</script>

</script>
<script src='https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js'></script>
<script>CKEDITOR.replace('description');</script>