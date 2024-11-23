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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" type="x-icon" sizes="24x24" href="img/Taxify_Logo.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <link rel="stylesheet" href="../css/calculateTax.css" />
  <link rel="stylesheet" href="../css/hambar.css">

  <!-- remix icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css"
    integrity="sha512-6p+GTq7fjTHD/sdFPWHaFoALKeWOU9f9MPBoPnvJEWBkGS4PKVVbCpMps6IXnTiXghFbxlgDE8QRHc3MU91lJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
  <title>Taxify</title>
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
  <!-- Nav bar -->
  <nav class="navbar">
    <a style="display: flex; justify-content: flex-end; align-items: start;" class="logo" href="./User-home.php"><img
        src="../img/New logo.png" style="width: 40px; margin-right: 12px;">TAXIFY</a>
    <div class="menu">
      <ul>
        <li><a href="../index/home-page.php#home-section">HOME</a></li>
        <li><a href="../index/home-page.php#services-section">SERVICES</a></li>
        <li><a href="../index/home-page.php#about-section">ABOUT</a></li>
        <li><a href="../index/home-page.php#contact-section">CONTACT</a></li>
        <li><a href="./User-document.php">DOCS</a></li>
      </ul>
    </div>
    <div class="info-user">

      <div class="account" style="width: auto;">
        <p>Hello, <?php echo $userData['username'] ?></p>
        <img id="image-user"
          src="https://t3.ftcdn.net/jpg/04/13/17/40/360_F_413174010_vwcb74ImpbZguCgGxBp0avUQDLGjXwpI.jpg">
      </div>


      <a class="logout" href="../index/home-page.php">Logout</a>

      <div class="hambuger-bar" onclick="myFunction(this)">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
      </div>


      <div class="drop-down">
        <div class="drop-menu">
          <ul>
            <li><a href="../index/home-page.php#home-section"><i class="ri-home-2-fill"></i>HOME</a></li>
            <li></i><a href="../index/home-page.php#services-section"><i class="ri-gallery-view-2"></i>SERVICES</a></li>
            <li><a href="../index/home-page.php#about-section"><i class="ri-group-line"></i>ABOUT</a></li>
            <li><a href="../index/home-page.php#contact-section"><i class="ri-customer-service-2-fill"></i>CONTACT</a></li>
            <li><a href="./User-document.php"><i class="ri-file-copy-2-line"></i>DOCS</a></li>
            <li><a href="../index/home-page.php"><i class="ri-logout-box-line"></i>LOGOUT</a></li>
          </ul>
        </div>
      </div>


    </div>
  </nav>
  <!-- end Nav bar -->


  <!-- กล่องกรองข้อมูล -->
  <div class="wrapper">
    <div class="text-wrapper">
      <h1>Calculate your tax</h1>
    </div>


    <div class="container">

      <!-- slide step -->
      <section class="progress-bar">
        <div id="step-1" class="step">
          <span class="active">1</span>
          <i class="fa-regular fa-circle-check"></i>
        </div>
        <div id="step-2" class="step">
          <span>2</span>
          <i class="fa-regular fa-circle-check"></i>
        </div>
        <div id="step-3" class="step">
          <span>3</span>
          <i class="fa-regular fa-circle-check"></i>
        </div>
        <div id="step-4" class="step">
          <span>4</span>
          <i class="fa-regular fa-circle-check"></i>
        </div>
      </section>
      <!-- end slide step -->

      <section>
        <!-- กล่องฟอร์ม -->
        <div class="box">
          <!-- form 1 -->
          <form id="form-1" class="form">
            <div class="text-step">
              <h2>ขั้นตอนที่ 1</h2>
              <h3>(เช็ครายได้ของคุณ<?php echo $userData['username'] ?>)</h3>
            </div>
            <div class="form-field">
              <label for="salary">รายได้ต่อเดือน(บาท)</label>
              <input id="salary" type="text" placeholder="ระบุเงินเดือนของคุณ" oninput="formatNumber(this)"
                autocomplete="off" />
              <a class="learn-more" style="margin-left: 10px" id="toggle-btn" onclick="toggleForm1(1)">
                *ข้อมูลเพิ่มเติมที่นี่
                <span class="tooltip">ℹ️
                  <span class="tooltiptext">
                    เงินค่าตอบแทนการทํางานที่กําหนดให้เป็นรายเดือน หรือ ค่าใช้จ่ายต่าง ๆ
                    ที่องค์การจ่ายให้แก่ผู้ปฏิบัติงาน
                  </span>
                </span>
              </a>

            </div>
            <div class="form-field">
              <label for="bonus">โบนัส(บาท)</label>
              <input id="bonus" type="text" placeholder="ระบุโบนัสของคุณ" autocomplete="off"
                oninput="formatNumber(this)" />
              <a class="learn-more" style="margin-left: 10px" id="toggle-btn"
                onclick="toggleForm1(2)">*ข้อมูลเพิ่มเติมที่นี่
                <span class="tooltip">ℹ️
                  <span class="tooltiptext">
                    เงินพิเศษ ที่องค์กรจ่ายให้เป็นบำเหน็จรางวัลแก่พนักงานนอกเหนือจากเงินเดือนค่าจ้าง
                  </span>
              </a>
            </div>
            <div class="form-field">
              <label for="yearSalary">รายได้อื่นๆ(บาท)</label>
              <input id="year-salary" type="text" placeholder="ระบุรายได้ทั้งปี" autocomplete="off"
                oninput="formatNumber(this)" />
              <a class="learn-more" style="margin-left: 10px" id="toggle-btn"
                onclick="toggleForm1(3)">*ข้อมูลเพิ่มเติมที่นี่
                <span class="tooltip">ℹ️
                  <span class="tooltiptext">
                    รายได้อื่นๆ เช่น การขายของออนไลน์, รับจ้างฟรีแลนซ์
                  </span>
              </a>
            </div>

            <!-- click show box content -->
            <div id="box-content" class="box-content">
              <p id="show"></p>
              <button type="button" class="close-btn" onclick="closeBtn()">X</button>
            </div>

            <!-- next button -->
            <div class="btn-group">
              <button type="submit" onclick="validateForm1()">Next</button>
            </div>
          </form>
          <!-- end form 1 -->


          <!-- form 2 -->
          <form action="" id="form-2">
            <div id="form2" class="form">
              <div class="text-step">
                <h2>ขั้นตอนที่ 2</h2>
                <h3>(เช็คค่าลดหย่อนส่วนตัวและครอบครัว)</h3>
              </div>

              <div class="form-field">
                <label for="exemptIncome">คุณมีเงินได้ที่ได้รับยกเว้นอื่นๆเท่าไหร่?</label>
                <input id="exemptIncome" type="text" autocomplete="off" oninput="formatNumber(this)" />
                <a class="learn-more" style="margin-left: 10px" id="toggle-btn"
                  onclick="toggleForm2(1)">*ข้อมูลเพิ่มเติมที่นี่
                  <span class="tooltip">ℹ️
                    <span class="tooltiptext">
                      รวมถึงรายได้บางประเภทที่ได้รับการยกเว้นภาษี เช่น เงินช่วยเหลือสวัสดิการจากรัฐบาล
                      หรือเงินชดเชยบางประเภทตามกฎหมาย
                    </span>
                </a>
              </div>

              <div class="form-field">
                <label for="providentFund">คุณได้ลงทุนในกองทุนสำรองเลี้ยงชีพไปเท่าไหร่?</label>
                <input id="providentFund" type="text" autocomplete="off" oninput="formatNumber(this)" />
                <a class="learn-more" style="margin-left: 10px" id="toggle-btn"
                  onclick="toggleForm2(2)">*ข้อมูลเพิ่มเติมที่นี่
                  <span class="tooltip">ℹ️
                    <span class="tooltiptext">
                      เป็นค่าใช้จ่ายที่นำมาลดหย่อนภาษีได้เต็มจำนวนตามที่จ่ายจริง ไม่เกินข้อกำหนดที่ระบุในแต่ละปี
                    </span>
                </a>
              </div>

              <div class="form-field">
                <label for="socialInsurance">คุณจ่ายเงินค่าประกันสังคมไปเท่าไหร่?</label>
                <input id="socialInsurance" type="text" autocomplete="off" oninput="formatNumber(this)" />
                <a class="learn-more" style="margin-left: 10px" id="toggle-btn"
                  onclick="toggleForm2(3)">*ข้อมูลเพิ่มเติมที่นี่
                  <span class="tooltip">ℹ️
                    <span class="tooltiptext">
                      เบี้ยประกันชีวิตลดหย่อนได้ตามจำนวนที่จ่ายจริง แต่ไม่เกิน 100,000 บาทต่อปี
                      เพื่อส่งเสริมการออมและความมั่นคง
                    </span>
                </a>
              </div>

              <div class="form-field">
                <label for="maritalStatus">สถานภาพของคุณ</label>
                <select id="maritalStatus">
                  <option value="60000">โสด</option>
                  <option value="60000">สมรส</option>
                  <option value="60000">หย่า/เป็นหม้าย</option>
                </select>
              </div>

              <div class="form-field">
                <label for="parentResponsibility">ภาระรับผิดชอบพ่อแม่ของคุณ</label>
                <select id="parentResponsibility">
                  <option value="0">ไม่มี</option>
                  <option value="30000">1 คน(พ่อหรือแม่)</option>
                  <option value="60000">2 คน(พ่อและแม่)</option>
                </select>
              </div>

              <div class="form-field">
                <label for="spouseParentResponsibility">ภาระรับผิดชอบพ่อแม่ของคู่สมรส</label>
                <select id="spouseParentResponsibility">
                  <option value="0">ไม่มี</option>
                  <option value="30000">1 คน(พ่อหรือแม่ของคู่สมรส)</option>
                  <option value="60000">2 คน(พ่อและแม่ของคู่สมรส)</option>
                </select>
              </div>

              <div class="form-field">
                <label for="childResponsibility">ภาระรับผิดชอบบุตรอายุไม่เกิน 2 คน5 ปี</label>
                <select id="childResponsibility">
                  <option value="0">ไม่มี</option>
                  <option value="30000">1 คน</option>
                  <option value="60000">2 คน</option>
                  <option value="90000">3 คน</option>
                  <option value="120000">4 คน</option>
                  <option value="150000">5 คน</option>
                </select>
              </div>

              <div class="form-field">
                <label for="disabledResponsibility">ภาระรับผิดชอบผู้พิการ/บุคคลไร้ความสามารถ</label>
                <select id="disabledResponsibility">
                  <option value="0">ไม่มี</option>
                  <option value="60000">1 คน</option>
                  <option value="120000">2 คน</option>
                  <option value="180000">3 คน</option>
                  <option value="240000">4 คน</option>
                  <option value="300000">5 คน</option>
                  <option value="360000">6 คน</option>
                </select>
              </div>

              <!-- next and previous button -->
              <div class="btn-group">
                <button type="button" onclick="prev('0')">Previous</button>
                <button type="submit" onclick="validateForm2()">Next</button>
              </div>
            </div>
          </form>
          <!-- end form 2 -->


          <!-- form 3 -->
          <form action="" id="form-3">
            <div id="form3" class="form">
              <div class="text-step">
                <h2>ขั้นตอนที่ 3</h2>
                <h3>(เช็คค่าลดหย่อนภาษี)</h3>
              </div>

              <div class="form-field">
                <label for="lifeInsurance">ปีนี้คุณจ่ายเบี้ยประกันชีวิตหรือไม่?</label>
                <select id="lifeInsurance">
                  <option value="0">ไม่ได้จ่าย</option>
                  <option value="9000">จ่ายแล้ว</option>
                </select>
              </div>

              <div class="form-field">
                <label for="ssfInvestment">คุณได้ลงทุนในกองทุน SSF ไปเท่าไหร่?</label>
                <input id="ssfInvestment" type="text" autocomplete="off" oninput="formatNumber(this)" />
                <a class="learn-more" style="margin-left: 10px" id="toggle-btn"
                  onclick="toggleForm3(1)">*ข้อมูลเพิ่มเติมที่นี่
                  <span class="tooltip">ℹ️
                    <span class="tooltiptext">
                      กองทุนเพื่อการออมระยะยาวที่ลดหย่อนภาษีได้ตามจำนวนที่ลงทุนจริง แต่ไม่เกิน 30% ของรายได้และสูงสุด
                      200,000 บาท
                    </span>
                </a>
              </div>

              <div class="form-field">
                <label for="rmfInvestment">คุณได้ลงทุนในกองทุน RMF ไปเท่าไหร่?</label>
                <input id="rmfInvestment" type="text" autocomplete="off" oninput="formatNumber(this)" />
                <a class="learn-more" style="margin-left: 10px" id="toggle-btn"
                  onclick="toggleForm3(2)">*ข้อมูลเพิ่มเติมที่นี่
                  <span class="tooltip">ℹ️
                    <span class="tooltiptext">
                      กองทุนเพื่อการเกษียณอายุที่ช่วยลดหย่อนภาษี โดยลงทุนตามเงื่อนไข เช่น ต้องถือครองถึงอายุ 55 ปี
                    </span>
                </a>
              </div>

              <div class="form-field">
                <label for="thaiESGInvestment">คุณได้ลงทุนในกองทุน ThaiESG ไปเท่าไหร่?</label>
                <input id="thaiESGInvestment" type="text" autocomplete="off" oninput="formatNumber(this)" />
                <a class="learn-more" style="margin-left: 10px" id="toggle-btn"
                  onclick="toggleForm3(3)">*ข้อมูลเพิ่มเติมที่นี่
                  <span class="tooltip">ℹ️
                    <span class="tooltiptext">
                      กองทุนเพื่อการลงทุนที่คำนึงถึงสิ่งแวดล้อมและสังคม ช่วยลดหย่อนภาษีและสนับสนุนความยั่งยืน
                    </span>
                </a>
              </div>

              <div class="form-field">
                <label for="homeLoanInterest">คุณจ่ายดอกเบี้ยสินเชื่อบ้านไปเท่าไหร่?</label>
                <input id="homeLoanInterest" type="text" autocomplete="off" oninput="formatNumber(this)" />
                <a class="learn-more" style="margin-left: 10px" id="toggle-btn"
                  onclick="toggleForm3(4)">*ข้อมูลเพิ่มเติมที่นี่
                  <span class="tooltip">ℹ️
                    <span class="tooltiptext">
                      ดอกเบี้ยบ้านนำมาลดหย่อนภาษีได้สูงสุด 100,000 บาทต่อปี ช่วยลดภาระผู้กู้สินเชื่อที่อยู่อาศัย
                    </span>
                </a>
              </div>

              <div class="form-field">
                <label for="donation">คุณบริจาคเพื่อการศึกษา/กีฬา/โรงพยาบาลรัฐไปเท่าไหร่?</label>
                <input id="donation" type="text" autocomplete="off" oninput="formatNumber(this)" />
                <a class="learn-more" style="margin-left: 10px" id="toggle-btn"
                  onclick="toggleForm3(5)">*ข้อมูลเพิ่มเติมที่นี่
                  <span class="tooltip">ℹ️
                    <span class="tooltiptext">
                      การบริจาคเพื่อการกุศล โรงเรียน หรือโรงพยาบาล สามารถลดหย่อนได้ 1-2
                      เท่าของจำนวนเงินบริจาคตามเงื่อนไข
                    </span>
                </a>
              </div>

              <div class="btn-group">
                <button type="button" onclick="prev('340')">Previous</button>
                <button type="submit" id="submitBtn" onclick="validateForm3()">Submit</button>
              </div>
            </div>
          </form>
          <!-- end form 3-->


          <!-- form submit 4  -->
          <div id="form-4" class="form">
            <div class="text-step">
              <h2>ขั้นตอนที่ 4</h2>
              <h3>(สรุปผลรวมภาษีของคุณ<?php echo $userData['username'] ?>)</h3>
            </div>

            <div class="form-field">
              <label class="text-form-4" for="totalNetIncome">
                <h3>รวมเงินได้สุทธิ</h3>
              </label>
              <p id="result" class="">0 บาท</p>
            </div>

            <div class="form-field">
              <label class="text-form-4" for="taxBeforeDeductions">
                <h3>ภาษีที่ต้องจ่าย</h3>
                <li>(ก่อนลดหย่อนด้วย SSF / RMF / ThaiESG)</li>
              </label>
              <p id="taxBeforeDeductions">0 บาท</p>
            </div>

            <div class="form-field">
              <label class="text-form-4" for="ssfSumInvestment">
                <h3>ลงทุน SSF อย่างเดียว</h3>
                <li>SSF 30% ของรายได้ทั้งปี ไม่เกิน 200,000 บาท <br> และรวมกับกองทุนกลุ่มเกษียณ ไม่เกิน 500,000 บาท</li>
              </label>
              <p id="ssfSumInvestment">0 บาท</p>
            </div>

            <div class="form-field">
              <label class="text-form-4" for="rmfSumInvestment">
                <h3>ลงทุน RMF อย่างเดียว</h3>
                <p>จำนวนที่คุณลงทุนได้สูงสุด (บาท)</p>
                <li>RMF 30% ของรายได้ทั้งปี และรวมกับ <br> กองทุนกลุ่มเกษียณ ไม่เกิน 500,000 บาท</li>
              </label>
              <p id="rmfSumInvestment">0 บาท</p>
            </div>

            <div class="form-field">
              <label class="text-form-4" for="thaiESGSumInvestment">
                <h3> ลงทุน ThaiESG</h3>
                <li>ThaiESG 30% ของรายได้ทั้งปี ไม่เกิน 100,000 บาท <br> และไม่รวมกับกองทุนกลุ่มเกษียณ</li>
              </label>
              <p id="thaiESGSumInvestment">0 บาท</p>
            </div>

            <div class="form-field">
              <div class="sum-result">
                <h4>ลงทุนรวม</h4>
                <p id="totalInvestment">0 บาท</p>
              </div>
            </div>

            <hr>

            <div class="form-field">
              <label class="text-form-4" for="taxSavings">
                <h3>ภาษีที่ประหยัดไปได้</h3>
                <li>หลังลดหย่อน SSF / RMF / ThaiESG</li>
              </label>
              <div>
                <h5>เมื่อลงทุนสูงสุด (บาท)</h5>
                <p id="maxTaxSavings">0 บาท</p>
              </div>
              <div>
                <h5>ลดหย่อนเงินบริจาค และสินเชื่อบ้าน (บาท)</h5>
                <p id="customTaxSavings">0 บาท</p>
              </div>
            </div>

            <hr>

            <div class="form-field">
              <div class="sum-result">
                <h4>เหลือภาษีที่ต้องจ่าย</h4>
                <p id="remainingTax">0 บาท</p>
              </div>
            </div>

            <!-- restart to button -->
            <div class="btn-group">
              <button type="button" onclick="prev('680')">Previous</button>
              <button type="button" onclick="validateForm4()">Restart</button>
            </div>
          </div>
        </div>

      </section>
    </div>
  </div>
  <!-- end form 4 -->

  <!-- start footer -->
  <footer class="footer-container">
    <!-- image footer -->
    <div class="image-footer">
      <img src="../img/footer-bg.png" alt="">
    </div>
    <!-- end image footer -->

    <!-- info of about taxify -->
    <div class="info-footer">
      <div class="info-taxify">
        <div class="logo-taxify">
          <img src="../img/Taxify_Logo-removebg-preview.png" alt="">
          <a href="">Taxify Thailand</a>
        </div>

        <div class="info-about">
          <p>Tax calculation starts by determining the net income, which is derived by subtracting expenses and
            deductions from total income.</p>
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
    <!-- info of about taxify -->
  </footer>
  <!-- end footer -->

  <!-- responsive icon info contact -->
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
  <!-- end responsive icon info contact (768px)-->

  <!-- <script src="script.js"></script> -->

  <script>
    let button = document.querySelector('.hambuger-bar')
    let dropDown = document.querySelector('.drop-down')

    function myFunction(x) {
      x.classList.toggle("change");
    }

    button.addEventListener('click', function () {

      dropDown.style.display = dropDown.style.display === 'block' ? 'none' : 'block';
    })

    window.addEventListener('click', function (event) {
      if (!button.contains(event.target) && !dropDown.contains(event.target)) {
        dropDown.style.display = 'none'
      }
    })

  </script>


  <script src="../javascript/calculateTax.js"></script>
  <script src="../javascript/calculate.js"></script>
</body>

</html>