<?php 
session_start();
require '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("location: ../index/login.php ");
    exit();  // หยุดการทำงานหากไม่มี session
}

$userData = null;  // กำหนดค่าเริ่มต้นให้กับ $userData

// ตรวจสอบว่า user_id ใน session มีค่า
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    try {
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);

        
        $userData = $stmt->fetch();

        // ถ้าไม่พบข้อมูลจากฐานข้อมูล
        if (!$userData) {
            echo "ไม่พบข้อมูลผู้ใช้";
            exit();  // หยุดการทำงานหากไม่พบข้อมูล
        }
    } catch (PDOException $e) {
        echo "Error " . $e->getMessage();
        exit();  // หยุดการทำงานหากเกิดข้อผิดพลาด
    }
} else {
    echo "ไม่พบข้อมูล session";
    exit();  // หยุดการทำงานหากไม่มี session
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxify</title>

    <!-- remix icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css"
        integrity="sha512-6p+GTq7fjTHD/sdFPWHaFoALKeWOU9f9MPBoPnvJEWBkGS4PKVVbCpMps6IXnTiXghFbxlgDE8QRHc3MU91lJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" type="x-icon" sizes="24x24" href="img/Taxify_Logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="../css/Userhome.css">
    

</head>

<body>
    <?php 
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            try {

                $stmt = $pdo->prepare("SELECT * FROm users WHERE id = ? ");
                $stmt->execute([$user_id]);
                $userData = $stmt->fetch();

            } catch (PDOException $e) {
                echo "Error " . $e->getMessage();
                exit();
            }
        }
        ?>

    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg px-3 fixed-top">
        <div class="container-fluid">
            <a style=" display: flex; justify-content: flex-end; align-items: start; text-decoration: none; font-size: 2rem;"  href="./User-home.php">
                <!-- ชื่อแบลน -->
                <img src="../img/New logo.png"
                    style="width: 40px; margin-right: 12px;" alt="">
                <span class="brand-name ms-2 text-success fs-2">Taxify</span>
            </a>

            <!-- navbar item -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../account/User-home.php#home-section">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../account/User-home.php#services-section">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../account/User-home.php#about-section">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../account/User-home.php#contact-section">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./User-document.php">Docs</a>
                    </li>
                </ul>
            </div>

            <!-- side bar -->
            <div class=" side-bar">
                <a class="username navbar-toggler-icon text-white"
                    style=" width: auto; height: 30px; text-decoration: none;">Hello, <?php echo $userData['username'] ?>
                    <img src="../img/user image.svg"
                        style="width: 30px; height: 30px; border-radius: 100%; border: 2px solid; background: white; object-fit: cover;">
                </a>
                <a href="../index/home-page.php" class="btn btn-doc btn-primary">Logout</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><img style="width: 35px;" src="../img/align-justify.svg"
                            alt=""></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark d-lg-none" tabindex="-1" id="offcanvasDarkNavbar"
                    aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <img src="../img/Taxify_Logo-removebg-preview.png" style="width: 100px;" alt="">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">TAXIFY THAILAND</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-center flex-grow-1 ">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../account/User-home.php#home-section"><i
                                        class="ri-home-2-line"></i>Home</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" aria-current="page" href="../account/User-home.php#services-section"><i
                                        class="ri-apps-2-ai-fill"></i>Services</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="../account/User-home.php#about-section"><i class="ri-team-fill"></i>About</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="./User-document.php"><i class="ri-file-copy-2-line"></i>Docs</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="../account/User-home.php#contact-section"><i
                                        class="ri-customer-service-2-fill"></i>Contact Us</a>
                            </li>
                        </ul>

                        <ul class="navbar-nav justify-content-center flex-grow-1">
                            <li class="bav-item pt-4 pb-4">
                                <a class="nav-link" href="../index/home-page.php"><i class="ri-logout-box-line"></i>logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- End Navbar -->








    <!-- Start Sliedshow -->
    <header class="header" id="home-section">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <!-- ปุ่มนำทางแสดงให้เห็นว่าอยู่ในรูปภาพไหน -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <!-- ภาพใน sliedshow  -->
            <div class="carousel-inner">
                <!-- ภาพที่1 -->
                <div class="carousel-item active" data-bs-interval="3000">
                    <img src="../img/sliedshow1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h1 style="animation: fade-bot-top 4s ease ;">Hello! <?php echo $userData['username'] ?></h1>
                        <h6 style="animation: fade-bot-top 4s ease ;">"Welcome to the easy tax calculation website. Get
                            advice, tax deductions and online
                            calculation tools from experts. For confidence in filing your taxes!"</p>
                            <a href="./User-calculate.php" class="btn btn-primary mt-3">Let's strat</a>
                    </div>
                </div>
                <!-- ภาพที่2 -->
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="../img/sliedshow2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h1 style="animation: fade-bot-top 4s ease ;">Hello! <?php echo $userData['username'] ?></h1>
                        <h6 style="animation: fade-bot-top 4s ease ;">"Welcome to the easy tax calculation website. Get
                            advice, tax deductions and online
                            calculation tools from experts. For confidence in filing your taxes!"</p>
                            <a href="./User-calculate.php" class="btn btn-primary mt-3">Let's strat</a>
                    </div>
                </div>
                <!-- ภาพที่3 -->
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="../img/slideshow3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h1 style="animation: fade-bot-top 4s ease ;">Hello! <?php echo $userData['username'] ?></h1>
                        <h6 style="animation: fade-bot-top 4s ease ;">"Welcome to the easy tax calculation website. Get
                            advice, tax deductions and online
                            calculation tools from experts. For confidence in filing your taxes!"</p>
                            <a href="./User-calculate.php" class="btn btn-primary mt-3">Let's strat</a>
                    </div>
                </div>
            </div>

            <!-- ปุ่มกดไปรูปภาพก่อนหน้านี้ -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <!-- ปุ่มกดไปรูปถาพถัดไป -->
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>
    <!-- End Sliedshow -->

    <!-- Services bar -->
    <div class="container-fluid" id="services-section" style="animation: slide-fade-left 1s ease ;">
        <h1 class="text-center mt-5">Services</h1>
        <div class="container text-center mt-5 mb-5">
            <div class="d-flex justify-content-center flex-wrap" style="gap: 3rem;">
                <div class="col text-center service-item">
                    <img src="../img/businessman.png" class="service-img" alt="Business">
                    <h5 class="service-text mt-3">Business</h5>
                </div>
                <div class="col text-center service-item">
                    <img src="../img/performance.png" class="service-img" alt="Performance">
                    <h5 class="service-text mt-3">Performance</h5>
                </div>
                <div class="col text-center service-item">
                    <img src="../img/knowlage.png" class="service-img" alt="Knowledge">
                    <h5 class="service-text mt-3">Knowledge</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services bar -->


    <!-- About info -->
    <div class="about-container container-fluid d-flex bg-black h-100 pb-5" id="about-section">
        <div class="container text-center text-white my-5 ">
            <div class="mb-5">
                <h2 class=" mb-3">DEVELOPER </h2>
                <p >"Good website development requires effective teamwork, where each member plays an important role. Clear communication, appropriate task division, and mutual support are crucial elements. Every step, from planning, design, development, to testing, 
                    requires collaboration to produce a result that meets the objectives and achieves the highest quality."</p>
            </div>


            <!-- Second row with   อ้ายมา6คน -->
            <div class="row justify-content-center ">
                <div class="col-12 text-center member">
                    <div class="circle bg-secondary mx-auto " 
                        style="width: 150px; height: 200px; border-radius: 0 32px; overflow: hidden;"
                        onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                        DEV OPE
                        <img src="../img/1image.jpg" style="width: 100%; height: 100%; object-fit: cover;">
                    
                    </div>
                    

                    <div class="tooltip-box">
                        Lead solution architect คือผู้ดูแลการออกแบบและวางโครงสร้างระบบเทคโนโลยี โดยทำงานร่วมกับทีมเพื่อสร้างโซลูชันที่ตอบโจทย์ทั้งด้านธุรกิจและเทคนิค ดูแลการเลือกเทคโนโลยีและเครื่องมือที่เหมาะสม รวมถึงการจัดการความเสี่ยงและประสิทธิภาพของระบบ.
                    </div>
                </div>
                <div class="col-2 text-center member">
                    <div class="circle bg-secondary mx-auto" style="width: 150px; height: 200px; border-radius: 0 32px;"
                        onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                        BACK-END

                        <img src="..//img/2image.jpg" style="width: 100%; height: 100%; object-fit: cover;">

                    </div>
    
                    <div class="tooltip-box">
                        Head of Developer คือผู้บริหารที่รับผิดชอบดูแลและนำทีมพัฒนาซอฟต์แวร์หรือแอปพลิเคชันในองค์กร โดยกำหนดทิศทางและกลยุทธ์ในการพัฒนา พร้อมทั้งดูแลการทำงานของนักพัฒนาทั้งทีมให้มีประสิทธิภาพ รวมถึงการตัดสินใจในเรื่องเทคโนโลยีที่ใช้ การพัฒนาทักษะของทีม และการรักษาคุณภาพของผลิตภัณฑ์.
                    </div>
                </div>
                <div class="col-2 text-center member">
                    <div class="circle bg-secondary mx-auto" style="width: 150px; height: 200px; border-radius: 0 32px;"
                        onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                        FRONT-END

                        <img src="..//img/3image.jpg" style="width: 100%; height: 100%; object-fit: cover;">

                    </div>

                    <div class="tooltip-box">
                        Team Leader คือผู้นำทีมที่รับผิดชอบในการกำหนดทิศทางการทำงานและสนับสนุนสมาชิกในทีมให้ทำงานได้ตามเป้าหมาย 
                        โดยมักจะทำหน้าที่เป็นผู้ประสานงานระหว่างทีมกับผู้บริหารหรือฝ่ายอื่น ๆ รวมถึงการให้คำแนะนำ แก้ปัญหา 
                        และพัฒนาทักษะของทีมเพื่อให้ทำงานได้อย่างมีประสิทธิภาพ.
                    </div>
                </div>
                <div class="col-2 text-center member">
                    <div class="circle bg-secondary mx-auto" style="width: 150px; height: 200px; border-radius: 0 32px;"
                        onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                        FRONT-END
                        <img src="..//img/4image.jpg" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="tooltip-box">          
                    Junior Front-end Developer คือผู้พัฒนาซอฟต์แวร์ที่มีประสบการณ์น้อยในด้านการพัฒนาเว็บหรือแอปพลิเคชันส่วนหน้าหรือ "Front-end" 
                    โดยมักจะเริ่มต้นจากการทำงานร่วมกับทีมพัฒนาเพื่อเรียนรู้และพัฒนาทักษะในการใช้เทคโนโลยีเช่น HTML, CSS, JavaScript 
                    รวมถึงเครื่องมืออื่น ๆ เพื่อช่วยสร้างส่วนติดต่อผู้ใช้ (UI) ที่ใช้งานง่ายและตอบสนองได้ดี.
                    </div>
                </div>
                <div class="col-2 text-center member ">
                    <div class="circle bg-secondary mx-auto" style="width: 150px;  height: 200px; border-radius: 0 32px;"
                        onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                        FRONT-END
                        <img src="..//img/5image.jpg" style="width: 100%; height: 100%; object-fit: cover;">

                    </div>
                    <div class="tooltip-box">
                    Front-end Developer คือผู้พัฒนาซอฟต์แวร์ที่รับผิดชอบในการออกแบบและสร้างส่วนของเว็บไซต์หรือแอปพลิเคชันที่ผู้ใช้สามารถเห็นและโต้ตอบได้ 
                    โดยทำงานกับภาษาโปรแกรม เช่น HTML, CSS, และ JavaScript เพื่อสร้างประสบการณ์ผู้ใช้ (UX) ที่ดีและทำให้เว็บไซต์หรือแอปมีความสวยงามและใช้งานง่าย.
                    </div>
                </div>
                <div class="col-2 text-center member">
                    <div class="circle bg-secondary mx-auto" style="width: 150px; height: 200px; border-radius: 0 32px;"
                        onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                        FRONT-END

                        <img src="../img/6image.jpg" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="tooltip-box">
                    Junior Front-end Developer คือผู้พัฒนาซอฟต์แวร์ที่มีประสบการณ์น้อยในด้านการพัฒนาเว็บหรือแอปพลิเคชันส่วนหน้าหรือ 
                    "Front-end" โดยมักจะเริ่มต้นจากการทำงานร่วมกับทีมพัฒนาเพื่อเรียนรู้และพัฒนาทักษะในการใช้เทคโนโลยีเช่น 
                    HTML, CSS, JavaScript รวมถึงเครื่องมืออื่น ๆ เพื่อช่วยสร้างส่วนติดต่อผู้ใช้ (UI) ที่ใช้งานง่ายและตอบสนองได้ดี.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End about info -->



    <!-- footer -->
    <footer class="footer-container" id="contact-section">
        <div class="image-footer">
            <img src="../img/footer-bg.png" alt="">
        </div>
        <div class="info-footer">
            <div class="info-taxify">
                <div class="logo-taxify">
                    <img src="../img/Taxify_Logo-removebg-preview.png" alt="">
                    <a href="">Taxify Thailand</a>
                </div>

                <div class="info-about">
                    <p>Tax calculation starts by determining the net income, which is derived by subtracting expenses
                        and deductions from total income.</p>
                </div>
            </div>

            <div class="info-contact">
                <ul>
                    <li><a href="#">Taxifythailand@gmail.com</a></li>
                    <li><a href="#">66+123456789</a></li>
                    <li><a href="#">Taxify Thailand</a></li>
                </ul>
                <div>
                    <div class="icon-contact">
                        <img src="../img/gmail.png" alt="">
                        <img src="../img/facebook.png" alt="">
                        <img src="../img/phone-call.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="info-contact-2">
        <ul>
            <li>
                <img style="width: 20px; margin-right: 10px;" src="../img/gmail.png" alt="">
                <a href="#">Taxifythailand@gmail.com</a>
            </li>
            <li>
                <img style="width: 20px; margin-right: 10px;" src="../img/phone-call.png" alt="">
                <a href="#">66+123456789</a>
            </li>
            <li>
                <img style="width: 20px; margin-right: 10px;" src="../img/facebook.png" alt="">
                <a href="#">Taxify Thailand</a>
            </li>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>