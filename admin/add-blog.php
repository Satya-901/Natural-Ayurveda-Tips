<?php include ('db_connect.php'); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $productimage1 = $_FILES["productimage1"]["name"];
    $tempname = $_FILES["productimage1"]["tmp_name"];
    $image = "../assets/img/" . $productimage1;
    move_uploaded_file($tempname, $image);

    $sqlproduct = "INSERT INTO `blog`(`title`, `text`, `image`) VALUES ('$name','$description','$productimage1')";

    if ($conn->query($sqlproduct) === TRUE) {
        echo "<script>alert('Blog Added added');window.location='index.php?page=blogs';</script>";
    } else {
        echo "<script>alert('Something went wrong');window.location='index.php?page=add-blog';</script>";
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
                            Add Blog
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id">

                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control" name="name">
                            </div>

                            <div class="form-group">
                                <label for="" class="control-label">Image</label>
                                <input type="file" class="form-control" name="productimage1" id="productimage1">
                                <img id="preview1" src="#" alt="" style="max-width: 100px; max-height: 100px;">
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

</script>
<script src='https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js'></script>
<script>CKEDITOR.replace('description');</script>