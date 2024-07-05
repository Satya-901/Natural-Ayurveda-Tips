<!-- footer start -->
<div class="pa-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="pa-foot-box">
                    <h2 class="pa-foot-title">Important Links</h2>
                    <ul>
                        <li>
                            <a href="./">Home</a>
                        </li>
                        <li>
                            <a href="about-us.php">About</a>
                        </li>
                        <li>
                            <a href="diseases.php">Diseases</a>
                        </li>
                        <li>
                            <a href="products.php">Products</a>
                        </li>
                        <li>
                            <a href="blog.php">Blog</a>
                        </li>
                        <li>
                            <a href="contact-us.php">Consult A Doctor</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="pa-foot-box">
                    <h2 class="pa-foot-title">Legal Information</h2>
                    <ul>
                        <li>
                            <a href="about-us.php">About Us</a>
                        </li>
                        <li>
                            <a href="privacy-policy.php">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="terms-conditions.php">Terms & Conditions</a>
                        </li>
                        <li>
                            <a href="shipping-policy.php">shipping policy</a>
                        </li>
                        <li>
                            <a href="return-policy.php">Return & Refund Policy</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="pa-foot-box">
                    <h2 class="pa-foot-title">Contact Information</h2>
                    <ul style="color: #ffffff;">
                        <li>
                            <b>Phone:</b> 971883 2501
                        </li>
                        <li>
                            <b>Email:</b> support@naturalayurvedatips.com
                        </li>
                        <li>
                            <b>Address:</b> G.B Nagar Uttar Pradesh 201301
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="pa-foot-box pa-foot-subscribe">
                    <img style="height: 100px;" src="assets/img/logo.png" alt="image" class="img-fluid" />
                    <div class="pa-newsletter">
                        <form>
                            <input type="text" placeholder="Subscribe newsletter">
                            <button class="pa-btn">Subscribe now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer end -->


<!-- copyright start -->
<div class="pa-copyright">
    <div class="container">
        <p>Copyright &copy; 2020-2023. All right reserved. <a href="./">Natural Ayurveda Tips</a></p>
    </div>
</div>
<!-- copyright end -->


<!-- login start -->
<div class="pa-login-model">
    <div class="modal fade" id="loginModel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="pa-login-close close" data-bs-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                    <h1 class="pa-login-title">Login</h1>
                    <form id="login-frm">
                        <div class="pa-login-form">
                            <input type="email" name="email" required="" placeholder="email">
                            <input type="password" name="password" required="" placeholder="Password">
                            <div class="pa-remember">
                                <label>Remember Me
                                    <input type="checkbox">
                                    <span class="s_checkbox"></span>
                                </label>
                                <a href="javascript:;" class="pa-forgot-password" data-bs-toggle="modal"
                                    data-bs-target="#forgotModal">Forgot Password ?</a>
                            </div>
                            <div class="pa-login-btn">
                                <button class="pa-btn">Login</button>
                                <p>Don't have an account? <a href="javascript:;" data-bs-toggle="modal"
                                        data-bs-target="#signupModal">Sign up</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#new_account').click(function () {
        uni_modal("Create an Account", 'signup.php?redirect=index.php?page=checkout')
    })
    $('#login-frm').submit(function (e) {
        e.preventDefault()
        $('#login-frm button[type="submit"]').attr('disabled', true).html('Logging in...');
        if ($(this).find('.alert-danger').length > 0)
            $(this).find('.alert-danger').remove();
        $.ajax({
            url: 'admin/ajax.php?action=login2',
            method: 'POST',
            data: $(this).serialize(),
            error: err => {
                console.log(err)
                $('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');

            },
            success: function (resp) {
                if (resp == 1) {
                    location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>';
                } else {
                    $('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
                    $('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
                }
            }
        })
    })
</script>
<!-- login end -->


<!-- signup start -->
<div class="pa-login-model pa-signup-modal">
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="pa-login-close close" data-bs-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                    <h1 class="pa-login-title">Signup</h1>
                    <form action="" id="signup-frm">
                        <div class="form-group">
                            <label for="" class="control-label">Firstname</label>
                            <input type="text" name="first_name" required="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Lastname</label>
                            <input type="text" name="last_name" required="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Contact</label>
                            <input type="text" name="mobile" required="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Address</label>
                            <textarea cols="30" rows="3" name="address" required="" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Email</label>
                            <input type="email" name="email" required="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Password</label>
                            <input type="password" name="password" required="" class="form-control">
                        </div>
                        <!-- <button class="button btn btn-info btn-sm">Create</button> -->
                        <div class="pa-login-btn mt-4">
                            <button class="pa-btn">Sign up</button>
                            <p>Already have an account?
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#loginModel">Login</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#signup-frm').submit(function (e) {
        e.preventDefault()
        $('#signup-frm button[type="submit"]').attr('disabled', true).html('Saving...');
        if ($(this).find('.alert-danger').length > 0)
            $(this).find('.alert-danger').remove();
        $.ajax({
            url: 'admin/ajax.php?action=signup',
            method: 'POST',
            data: $(this).serialize(),
            error: err => {
                console.log(err)
                $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');

            },
            success: function (resp) {
                if (resp == 1) {
                    location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'cart.php' ?>';
                } else {
                    $('#signup-frm').prepend('<div class="alert alert-danger">Email already exist.</div>')
                    $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
                }
            }
        })
    })
</script>

<!-- signup end -->


<!-- forgot start -->
<div class="pa-login-model pa-forgot-modal">
    <div class="modal fade" id="forgotModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="pa-login-close close" data-bs-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                    <h1 class="pa-login-title">Forgot Password</h1>
                    <form>
                        <div class="pa-login-form">
                            <input type="text" placeholder="Email">
                            <div class="pa-login-btn">
                                <button class="pa-btn">Forgot</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- forgot end -->


</div>


<a href="https://api.whatsapp.com/send?phone=9718832501" class="float" target="_blank">
    <svg class="my-float " xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
        <path
            d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
    </svg>
</a>



<script>
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd"
    })
    window.start_load = function () {
        $('body').prepend('<di id="preloader2"></di>')
    }
    window.end_load = function () {
        $('#preloader2').fadeOut('fast', function () {
            $(this).remove();
        })
    }

    window.uni_modal = function ($title = '', $url = '') {
        start_load()
        $.ajax({
            url: $url,
            error: err => {
                console.log()
                alert("An error occured")
            },
            success: function (resp) {
                if (resp) {
                    $('#uni_modal .modal-title').html($title)
                    $('#uni_modal .modal-body').html(resp)
                    $('#uni_modal').modal('show')
                    end_load()
                }
            }
        })
    }
    window.uni_modal_right = function ($title = '', $url = '') {
        start_load()
        $.ajax({
            url: $url,
            error: err => {
                console.log()
                alert("An error occured")
            },
            success: function (resp) {
                if (resp) {
                    $('#uni_modal_right .modal-title').html($title)
                    $('#uni_modal_right .modal-body').html(resp)
                    $('#uni_modal_right').modal('show')
                    end_load()
                }
            }
        })
    }
    window.alert_toast = function ($msg = 'TEST', $bg = 'success') {
        $('#alert_toast').removeClass('bg-success')
        $('#alert_toast').removeClass('bg-danger')
        $('#alert_toast').removeClass('bg-info')
        $('#alert_toast').removeClass('bg-warning')

        if ($bg == 'success')
            $('#alert_toast').addClass('bg-success')
        if ($bg == 'danger')
            $('#alert_toast').addClass('bg-danger')
        if ($bg == 'info')
            $('#alert_toast').addClass('bg-info')
        if ($bg == 'warning')
            $('#alert_toast').addClass('bg-warning')
        $('#alert_toast .toast-body').html($msg)
        $('#alert_toast').toast({ delay: 3000 }).toast('show');
    }
    window.load_cart = function () {
        $.ajax({
            url: 'admin/ajax.php?action=get_cart_count',
            success: function (resp) {
                if (resp > -1) {
                    resp = resp > 0 ? resp : 0;
                    $('.item_count').html(resp)
                }
            }
        })
    }
    $('#login_now').click(function () {
        uni_modal("LOGIN", 'login.php')
    })
    $(document).ready(function () {
        load_cart()
    })
</script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/SmoothScroll.min.js"></script>
<script src="assets/js/swiper.min.js"></script>
<script src="assets/js/custom.js"></script>


<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js'></script>
<script src="assets\js\alertjs.js"></script>

</body>

</html>