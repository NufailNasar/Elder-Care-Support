<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
include('connection.php'); 
?>

<body>
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Contact Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
            <!-- Get in Touch Section -->
<div class="container-xxl py-5">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Contact Us</div>
            <h1 class="display-6 mb-4">Get in Touch</h1>
        <div class="row g-5 align-items-center">
            <!-- Contact Info -->
            <div class="col-lg-6">
                <h5 class="mb-2"><strong>Visit Us</strong></h5>
                <p>475, Union Place, Colombo 02, Sri Lanka.</p>

                <h5 class="mt-4 mb-2"><strong>Hotline</strong></h5>
                <p>Mon - Fri 9am to 6pm.</p>

                <h5 class="mt-4 mb-2"><strong>Contact</strong></h5>
                <p>081 425 8975</p>

                <h5 class="mt-4 mb-2"><strong>Email Us</strong></h5>
                <p>support@goldenheart.lk</p>
            </div>

            <!-- Contact Illustration Image -->
            <div class="col-lg-6 text-center">
                <img src="img/C1.png" alt="Contact Illustration" class="img-fluid rounded shadow">
            </div>
        </div>
</div>


                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="display-6 mb-5">Have an idea! Let’s discuss.</h1>
                    <p class="mb-4">Have a question, suggestion, or need assistance? We’d love to hear from you. Whether you’re a donor, an elder home representative, or someone looking to support our mission, our team is here to help. Please fill out the form below or reach out using the contact details provided we’ll respond as soon as possible.</a>.</p>
                    <form id="contactForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" required>
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="message" class="form-control" placeholder="Leave a message here" id="message" style="height: 100px" required></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary py-2 px-3 me-3">
                                    Send Message
                                    <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                </button>
                            </div>
                            <div id="responseMessage" class="mt-3"></div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 450px;">
                    <div class="position-relative rounded overflow-hidden h-100">
                        <iframe class="position-relative w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63344.116347102394!2d79.83791463182365!3d6.927078013998944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25973f6a27adf%3A0x3a3ea385b6b4a3bb!2s475%20Union%20Pl%2C%20Colombo%20002%2C%20Sri%20Lanka!5e0!3m2!1sen!2slk!4v1716128759509!5m2!1sen!2slk"
                        frameborder="0" style="min-height: 450px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('contact_ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Expecting JSON now
    .then(result => {
        if (result.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Message Sent!',
                text: result.message,
                confirmButtonColor: '#3085d6'
            });
            document.getElementById('contactForm').reset();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: result.message,
                confirmButtonColor: '#d33'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An unexpected error occurred. Please try again later.',
            confirmButtonColor: '#d33'
        });
    });
});
</script>


</body>

</html>

<?php
include('footer.php');
?>