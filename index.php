
<?php
session_start();
?>

<script type="text/javascript">
    <?php if (isset($_SESSION['message'])): ?>
        alert("<?php echo $_SESSION['message']; ?>");
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
</script>


<?php require_once "./menu.php"; ?>

<div class="carousel slide" data-bs-ride="carousel" id="carousel-1" style="height: 600px;">
        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100"><img class="w-100 d-block position-absolute h-100 fit-cover" src="assets/img/2.jpg" alt="Slide Image" style="z-index: -1;">
                <div class="container d-flex flex-column justify-content-center h-100">
                    <div class="row">
                        <div class="col-md-6 col-xl-4 offset-md-2" style="backdrop-filter: blur(3px);-webkit-backdrop-filter: blur(3px);">
                            <div style="max-width: 350px;">
                                <h1 class="text-uppercase fw-bold"><span style="color: rgb(255, 255, 255);">One Stop IT</span></h1>
                                <p class="my-3"><span style="color: rgb(255, 255, 255);">Your comprehensive solution for all IT needs. Access top-notch applications and services right now!</span></p><a class="btn btn-primary btn-lg me-2" role="button" href="#" style="border-radius: 10px;">Sign UP</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item h-100"><img class="w-100 d-block position-absolute h-100 fit-cover" src="assets/img/3.jpg" alt="Slide Image" style="z-index: -1;">
                <div class="container d-flex flex-column justify-content-center h-100">
                    <div class="row">
                        <div class="col-md-6 col-xl-4 offset-md-2" style="backdrop-filter: blur(3px);-webkit-backdrop-filter: blur(3px);">
                            <div style="max-width: 350px;">
                                <h1 class="text-uppercase fw-bold"><span style="color: rgb(255, 255, 255);">One Stop IT</span></h1>
                                <p class="my-3"><span style="color: rgb(255, 255, 255);">Your comprehensive solution for all IT needs. Access top-notch applications and services right now!</span></p><a class="btn btn-primary btn-lg me-2" role="button" href="#" style="border-radius: 10px;">Sign UP</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item h-100"><img class="w-100 d-block position-absolute h-100 fit-cover" src="assets/img/4.jpg" alt="Slide Image" style="z-index: -1;">
                <div class="container d-flex flex-column justify-content-center h-100">
                    <div class="row">
                        <div class="col-md-6 col-xl-4 offset-md-2" style="backdrop-filter: blur(3px);-webkit-backdrop-filter: blur(3px);">
                            <div style="max-width: 350px;">
                                <h1 class="text-uppercase fw-bold"><span style="color: rgb(255, 255, 255);">One Stop IT</span></h1>
                                <p class="my-3"><span style="color: rgb(255, 255, 255);">Your comprehensive solution for all IT needs. Access top-notch applications and services right now!</span></p><a class="btn btn-primary btn-lg me-2" role="button" href="#" style="border-radius: 10px;">Sign UP</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
        <ol class="carousel-indicators">
            <li data-bs-target="#carousel-1" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
            <li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
        </ol>
    </div>
    <div class="container py-4 py-xl-5">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Your universal assistant in the digital world</h2>
                <p>Whether you're looking for simple applications for everyday life or advanced IT solutions, OneStopIT is here for you</p>
            </div>
        </div>
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
            <div class="col">
                <div class="p-4"><span class="badge rounded-pill bg-primary mb-2"></span>
                    <div class="line-with-icon-divider"><span id="line-span" class="line-span"><i class="fa fa-code" aria-hidden="true" style="font-size: 28px;color: #7e9192;"></i></span></div>
                    <h4>Development</h4>
                    <p><strong>Web Application &amp; Backend Development:</strong> We provide high-quality and efficient web application and backend development to meet your digital needs and propel your business forward.</p>
                    <div class="d-flex"></div>
                </div>
            </div>
            <div class="col">
                <div class="p-4"><span class="badge rounded-pill bg-primary mb-2"></span>
                    <div class="line-with-icon-divider"><span id="line-span-1" class="line-span"><i class="material-icons" aria-hidden="true" style="font-size: 28px;color: #7e9192;">room_service</i></span></div>
                    <h4>Services</h4>
                    <p><strong>Online Tools for Every Day:</strong> We offer fast and simple online tools such as calculators, YouTube downloaders, image converters, and many more, all under one roof.</p>
                    <div class="d-flex">
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="p-4"><span class="badge rounded-pill bg-primary mb-2"></span>
                    <div class="line-with-icon-divider"><span id="line-span-2" class="line-span"><i class="icon ion-help-buoy" aria-hidden="true" style="font-size: 28px;color: #7e9192;padding-bottom: 0px;"></i></span></div>
                    <h4>IT Outsourcing</h4>
                    <p><strong>Reliable IT Support: </strong>Our qualified team is ready to remotely take care of your IT needs, keeping your systems running and addressing any issues.</p>
                    <div class="d-flex">
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="width: 100%;margin: 0px;padding: 0px;">
        <div style="height: 250px;width: 100%;background: url(&quot;assets/img/6.jpg&quot;) center / cover no-repeat;border-style: none;opacity: 0.63;filter: blur(2px) brightness(100%) grayscale(28%);"></div>
    </div>
    <div class="container py-4 py-xl-5">
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="text-start p-4"><span class="badge rounded-pill bg-primary mb-2">Beta</span>
                    <h4>TimeTrackr: Your Reliable Tool for Time Tracking and Invoicing</h4>
                    <p>TimeTrackr is an intuitive online time-tracking tool that simplifies reporting your work time for invoicing. With TimeTrackr, you can accurately track the time spent on various tasks and projects, allowing you to create precise and detailed invoices for your clients. It's easily accessible from anywhere and is designed to easily adapt to your needs. Simplify your invoicing process today - try TimeTrackr for free!</p>
                    <div class="d-flex justify-content-end" style="margin-right: 25px;"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="50" height="50" src="assets/img/jiri_maly.jpg">
                        <div>
                            <p class="fw-bold mb-0">Jiří Malý</p>
                            <p class="text-muted mb-0">Owner</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4 py-xl-5">
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="text-start p-4"><span class="badge rounded-pill bg-primary mb-2">Beta</span>
                    <h4>LensGrid: Your Universal Partner for Photos and Videos</h4>
                    <p>LensGrid is an intuitive online platform that lets you share and manage your photos and videos with ease. This unique app allows you to create your own portfolio and share your visual projects with the world.
                        Create your own unique photo and video portfolio and share it with the world. Follow the work of other talented photographers, comment on their work, and gain inspiration for your next projects.
                        LensGrid is designed to adapt to your needs. It's easily accessible from anywhere and allows you to keep track of your photos and videos in one place.
                        Dive into the world of photography and video - try LensGrid for free today!</p>
                    <div class="d-flex justify-content-end" style="margin-right: 25px;"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="50" height="50" src="assets/img/jiri_maly.jpg">
                        <div>
                            <p class="fw-bold mb-0">Jiří Malý</p>
                            <p class="text-muted mb-0">Owner</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="text-white bg-dark border rounded border-0 border-light d-flex flex-column justify-content-between align-items-center flex-lg-row p-4 p-lg-5">
                <div class="text-center text-lg-start py-3 py-lg-1">
                    <h2 class="fw-bold mb-2"><strong>Subscribe to our newsletter</strong></h2>
                    <p class="mb-0">Imperdiet consectetur dolor.</p>
                </div>
                <form class="d-flex justify-content-center flex-wrap my-2" method="post">
                    <div class="my-2"><input class="form-control" type="email" name="email" placeholder="Your Email"></div>
                    <div class="my-2" style="border-radius: 10px;"><button class="btn btn-primary ms-sm-2" type="submit" style="border-radius: 10px;">Subscribe </button></div>
                </form>
            </div>
        </div>
    </section>
    <section class="getintouch">
    <div class="container modern-form">
        <div class="text-center">
            <h4 style="color: #212529;font-size: 45px;">Get in touch</h4>
        </div>
        <hr class="modern-form__hr">
        <div class="modern-form__form-container">
            <form action="send_email.php" method="post">
                <div class="row">
                    <div class="col col-contact">
                        <div class="modern-form__form-group--padding-r form-group mb-3">
                            <input class="form-control input input-tr" type="text" name="name" placeholder="First Name">
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-contact">
                        <div class="modern-form__form-group--padding-l form-group mb-3">
                            <input class="form-control input input-tr" type="email" name="email" placeholder="Email">
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="modern-form__form-group--padding-t form-group mb-3">
                            <textarea class="form-control input modern-form__form-control--textarea" name="message" placeholder="Message"></textarea>
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center"><button class="btn btn-primary submit-now" type="submit" style="background: var(--bs-primary);border-radius: 10px;">Submit Now</button></div>
                </div>
            </form>
        </div>
    </div>
</section>

    <footer class="text-center bg-dark">
        <div class="container text-white py-4 py-lg-5">
            <ul class="list-inline">
                <li class="list-inline-item me-4"><a class="link-light" href="#">Development</a></li>
                <li class="list-inline-item me-4"><a class="link-light" href="#">Services</a></li>
                <li class="list-inline-item"><a class="link-light" href="#">IT Outsourcing</a></li>
            </ul>
            <ul class="list-inline">
                <li class="list-inline-item me-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-facebook text-light">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                    </svg></li>
                <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-instagram text-light">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                    </svg></li>
            </ul>
            <p class="text-muted mb-0">Copyright © 2023 OneStopIT</p>
        </div>
    </footer>
    <!-- <script src="/assets/bootstrap/js/bootstrap.min.js"></script>  -->
</body>

</html>

