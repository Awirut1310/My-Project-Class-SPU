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
    <title>Document</title>

    <link rel="stylesheet" href="../css/Userdocument.css">
    <link rel="stylesheet" href="../css/hambar.css">

    <!-- remix icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css"
        integrity="sha512-6p+GTq7fjTHD/sdFPWHaFoALKeWOU9f9MPBoPnvJEWBkGS4PKVVbCpMps6IXnTiXghFbxlgDE8QRHc3MU91lJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
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
                <a class="username navbar-toggler-icon text-white" style=" width: auto; height: 30px; text-decoration: none;">Hello, <?php echo $userData['username'] ?>
                    <img src="../img/user image.svg" style="width: 30px; height: 30px; border-radius: 100%; border: 2px solid; background: white; object-fit: cover;">
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
                                <a class="nav-link" aria-current="page" href="../account/User-home.php#home-section"><i class="ri-home-2-line"></i>Home</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" aria-current="page" href="../account/User-home.php#services-section"><i class="ri-apps-2-ai-fill"></i>Services</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="../account/User-home.php#about-section"><i class="ri-team-fill"></i>About</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="./User-document.php"><i class="ri-file-copy-2-line"></i>Docs</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="../account/User-home.php#contact-section"><i class="ri-customer-service-2-fill"></i>Contact Us</a>
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

    <!-- End nav -->
    <main style="font-family: Kanit, sans-serif;" class="container my-5">
        <div class="p-4 p-md-5 mb-4  mt-6 rounded text-body-emphasis bg-body-secondary">
            <div class="col-lg-6 px-0">
                <h1 class="display-4 fst-italic">ภาษีคือการร่วมลงทุนในอนาคตของประเทศ</h1>
                <p class="lead my-3 fs-6">ข้อความนี้สะท้อนความคิดที่ว่า
                    การจ่ายภาษีเป็นการมีส่วนร่วมในการพัฒนาและสร้างสิ่งดี ๆ
                    ให้กับสังคมในอนาคต แต่ยังคงความชัดเจนในแง่ของการใช้ทรัพยากรเพื่อผลประโยชน์ส่วนรวม</p>
                <a class="btn btn-primary" type="button" href="./User-calculate.php">คำนวณภาษี</a>
            </div>
        </div>

        <article style="font-family: Kanit, sans-serif;" class="blog-post">
            <h2>ความสำคัญของภาษี</h2>
            <p>ความสำคัญของภาษีคือช่วยสนับสนุนการพัฒนาโครงสร้างพื้นฐาน การศึกษา และสาธารณสุขของประเทศ
                เป็นแหล่งรายได้หลักของรัฐบาลที่ใช้ในการสร้างสวัสดิการและลดความเหลื่อมล้ำในสังคม
                นอกจากนี้ยังช่วยกระตุ้นเศรษฐกิจและส่งเสริมความยั่งยืนในอนาคต.</p>
            <hr>
            <img src="../img/imgDocs.jpg" alt=""
                style="width:100%; height: 300px; object-fit: cover; margin-bottom: 1rem;">
            <h2>วันจ่ายภาษีของประเทศไทย</h2>

            <ul>
                <p>1. ภาษีเงินได้บุคคลธรรมดา (ภ.ง.ด. 90 และ 91)</p>
                <li style="margin-left: 3rem;">การยื่น: ภายในวันที่ 31 มีนาคมของทุกปี</li>
                <li style="margin-left: 3rem;">การชำระ: ภายในวันที่ 31 มีนาคม (หากเป็นการยื่นแบบออนไลน์
                    จะสามารถขยายเวลาไปถึง 8
                    เมษายนได้)</li>
            </ul>
            <ul>
                <p>2. ภาษีเงินได้นิติบุคคล (ภ.ง.ด. 50)</p>
                <li style="margin-left: 3rem;">การยื่น: ภายใน 150 วัน หลังจากวันสิ้นปีงบประมาณของนิติบุคคล</li>
                <li style="margin-left: 3rem;">การชำระ: ภายในวันที่ยื่นแบบ</li>
            </ul>
            <ul>
                <p>3. ภาษีมูลค่าเพิ่ม (VAT)</p>
                <li style="margin-left: 3rem;">การยื่น: ภายในวันที่ 15 ของเดือนถัดไป</li>
                <li style="margin-left: 3rem;">การชำระ: ภายในวันที่ 15 ของเดือนถัดไป</li>
            </ul>
            <ul>
                <p>4. ภาษีธุรกิจเฉพาะ (ภ.ง.ด. 53)</p>
                <li style="margin-left: 3rem;">การชำระ: ภายในวันที่ 15 ของเดือนถัดไป</li>
                <li style="margin-left: 3rem;">การยื่น: ภายในวันที่ 15 ของเดือนถัดไปจากเดือนที่มีกำไร</li>
            </ul>
            <ul>
                <p>5. ภาษีหัก ณ ที่จ่าย</p>
                <li style="margin-left: 3rem;">การยื่นและชำระ: ภายในวันที่ 7 ของเดือนถัดไป</li>
            </ul>
            <hr>
            <img src="../img/imgDocs2.jpg" alt=""
                style="width: 100%; height: 300px; object-fit: cover; margin-bottom: 1rem;">
            <h2>โทษของการไม่จ่ายภาษี</h2>
            <p>การไม่จ่ายภาษีหรือการหลีกเลี่ยงภาษีในประเทศไทยมีโทษตามกฎหมายภาษีที่กำหนดไว้ใน ประมวลรัษฎากร
                ซึ่งมีโทษทั้งทางแพ่งและทางอาญา ดังนี้</p>
            <ul>
                <p>1. โทษทางแพ่ง</p>
                <li style="margin-left: 3rem;"><strong>การเสียภาษีไม่ครบถ้วนหรือการยื่นภาษีเท็จ :</strong>
                    หากไม่ชำระภาษีหรือจ่ายภาษีไม่ครบถ้วน อาจถูกเรียกเก็บเงินภาษีที่ขาดพร้อมดอกเบี้ยร้อยละ 1.5 ต่อเดือน
                    นับจากวันที่ครบกำหนดชำระจนถึงวันที่ชำระครบ</li>
                <li style="margin-left: 3rem;"><strong>ค่าปรับ :</strong> การหลีกเลี่ยงการจ่ายภาษี
                    หรือการยื่นภาษีที่ไม่ถูกต้อง
                    (เช่น การปกปิดรายได้) อาจต้องเสียค่าปรับตามอัตราที่กำหนดในประมวลรัษฎากร
                    ซึ่งปรับเป็นจำนวนเงินหรือเปอร์เซ็นต์ของภาษีที่ค้างชำระ</li>
                <li style="margin-left: 3rem;"><strong>ค่าปรับจากการไม่ยื่นแบบภาษี :</strong> สูงสุดไม่เกิน 2
                    เท่าของจำนวนภาษีที่ค้างชำระ</li>
                <li style="margin-left: 3rem;"><strong>ค่าปรับจากการไม่ชำระภาษี :</strong> สูงสุดไม่เกิน 1
                    เท่าของจำนวนภาษีที่ค้างชำระ</li>
            </ul>
            <ul>
                <p>2. โทษทางอาญา</p>
                <li style="margin-left: 3rem;"><strong>การหลีกเลี่ยงภาษีหรือการปกปิดรายได้ :</strong>
                    อาจถูกดำเนินคดีตามมาตรา 37
                    ของประมวลรัษฎากร</li>
                <li style="margin-left: 3rem;"><strong>โทษจำคุก :</strong> หากมีการหลีกเลี่ยงการจ่ายภาษีโดยเจตนา
                    ผู้กระทำความผิดอาจต้องโทษจำคุกไม่เกิน 7 ปี หรือปรับไม่เกิน 200,000 บาท หรือทั้งจำทั้งปรับ</li>
                <li style="margin-left: 3rem;"><strong>การยื่นเอกสารหรือข้อมูลเท็จ :</strong>
                    หากยื่นข้อมูลเท็จเพื่อหลีกเลี่ยงภาษี จะมีโทษจำคุกไม่เกิน 7 ปี หรือปรับไม่เกิน 200,000 บาท
                    หรือทั้งจำทั้งปรับ
                </li>
                <li style="margin-left: 3rem;"><strong>การหลีกเลี่ยงภาษีในปริมาณมาก :</strong>
                    กรณีที่มีจำนวนภาษีหลีกเลี่ยงจำนวนมาก การดำเนินคดีจะเป็นไปตามกรณีความผิดร้ายแรง อาจมีโทษจำคุกสูงสุด
                    10 ปี</li>
            </ul>
            <ul>
                <p>3. การฟ้องร้องทางกฎหมาย</p>
                <p style="margin-left: 2rem;">หากเจ้าหน้าที่สรรพากรพบการกระทำผิดเกี่ยวกับการหลีกเลี่ยงภาษี
                    เจ้าหน้าที่สามารถดำเนินการฟ้องร้องทางกฎหมายและยึดทรัพย์สินของผู้กระทำความผิดเพื่อชำระภาษีที่ค้าง</p>
            </ul>
            <ul>
                <p>4. สรุป</p>
                <p style="margin-left: 2rem;">
                    การไม่จ่ายภาษีหรือหลีกเลี่ยงการชำระภาษีอาจทำให้ผู้กระทำความผิดต้องเผชิญกับทั้ง
                    ค่าปรับ และ โทษจำคุก ขึ้นอยู่กับความร้ายแรงของการกระทำผิด รวมถึงการชำระภาษีที่ค้างชำระพร้อมดอกเบี้ย
                    ซึ่งอาจทำให้มีภาระเพิ่มขึ้นมากมายหากไม่ปฏิบัติตามกฎหมายภาษี</p>
            </ul>
        </article>
    </main>

    </script>
</body>

</html>