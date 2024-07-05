<?php include_once ('includes/head.php'); ?>
<?php include_once ('includes/header.php'); ?>

<!-- breadcrumb start -->
<div class="pa-breadcrumb"
    style="background: linear-gradient(45deg, rgba(0, 0, 0, 0.56), rgba(0, 0, 0, 0.56)), url(assets/img/contact-us-banner.png);">
    <div class="container-fluid">
        <div class="pa-breadcrumb-box">
            <h1>Consultation Form</h1>
            <ul>
                <li><a href="./">Home</a></li>
                <li>Consult A Doctor</li>
            </ul>
        </div>
    </div>
</div>

<div class="pa-about spacer-top spacer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="pa-contact-form">
                    <form action="https://api.web3forms.com/submit" method="POST">
                        <input type="hidden" name="access_key" value="ee043311-4fab-47cd-b3d4-5011e3bdfc6b">
                        <div class="">
                            <input type="text" class="" name="name" placeholder="Name *" required>
                        </div>
                        <div class="">
                            <input type="email" class="" name="email" placeholder="Email">
                        </div>
                        <div class="">
                            <input type="text" class="" name="phone" placeholder="Phone *" required>
                        </div>
                        <div class="">
                            <textarea class="" name="message" rows="4" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="pa-btn submitForm">submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="newsletter-box mb-3">
                    <h5>Email</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="newsletter-box mb-3">
                    <h5>Phone</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="newsletter-box">
                    <h5>Address</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="map-box mb-4">
            <iframe class="map"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2436.6379067451917!2d-0.12085068461804136!3d51.50329767963533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761b505ab25a45%3A0x0!2sLondon%20Eye!5e0!3m2!1sen!2suk!4v1604352766503!5m2!1sen!2suk"
                width="100%" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe>
        </div>
    </div>
</div>

<?php include_once ('includes/footer.php'); ?>