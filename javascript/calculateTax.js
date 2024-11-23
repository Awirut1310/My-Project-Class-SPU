//slide step
const box = document.querySelector(".box");
const step1 = document.getElementById("step-1");
const step2 = document.getElementById("step-2");
const step3 = document.getElementById("step-3");
const step4 = document.getElementById("step-4");

// form 1 valuable
const salary = document.getElementById("salary");
const bonus = document.getElementById("bonus");
const yearSalary = document.getElementById("year-salary");

// form 2 valuable
const exemptIncome = document.getElementById("exemptIncome");
const providentFund = document.getElementById("providentFund");
const maritalStatus = document.getElementById("maritalStatus");
const parentResponsibility = document.getElementById("parentResponsibility");
const spouseParentResponsibility = document.getElementById("spouseParentResponsibility");
const childResponsibility = document.getElementById("childResponsibility");
const disabledResponsibility = document.getElementById("disabledResponsibility");
const socialInsurance = document.getElementById("socialInsurance");

// form 3 valuable
const lifeInsurance = document.getElementById("lifeInsurance");
const ssfInvestment = document.getElementById("ssfInvestment");
const rmfInvestment = document.getElementById("rmfInvestment");
const thaiESGInvestment = document.getElementById("thaiESGInvestment");
const homeLoanInterest = document.getElementById("homeLoanInterest");
const donation = document.getElementById("donation");

// form 4 valuable
const netIncome = document.getElementById("netIncome");
const taxBeforeDeductions = document.getElementById("taxBeforeDeductions");
const ssfSumInvestment = document.getElementById("ssfSumInvestment");
const rmfSumInvestment = document.getElementById("rmfSumInvestment");
const thaiESGSumInvestment = document.getElementById("thaiESGSumInvestment");
const totalInvestment = document.getElementById("totalInvestment");
const taxSavings = document.getElementById("taxSavings");
const maxTaxSavings = document.getElementById("maxTaxSavings");
const customTaxSavings = document.getElementById("customTaxSavings");
const remainingTax = document.getElementById("remainingTax");

//add box detail
let content = document.getElementById('box-content');
let show = document.getElementById('show');

function toggleForm1(number)  {
  
  if (content.style.display === 'none') {
    content.style.display = 'block'
      if (number === 1) {
        show.textContent = "เงินค่าตอบแทนการทํางานที่กําหนดให้เป็นรายเดือน หรือ ค่าใช้จ่ายต่าง ๆ ที่องค์การจ่ายให้แก่ผู้ปฏิบัติงาน"
      }else if (number === 2) {
        show.textContent = "เงินพิเศษ ที่องค์กรจ่ายให้เป็นบำเหน็จรางวัลแก่พนักงานนอกเหนือจากเงินเดือนค่าจ้าง"
      }else {
        show.textContent = " รายได้อื่นๆ เช่น การขายของออนไลน์, รับจ้างฟรีแลนซ์"
      }
  }else {
    content.style.display = 'none'
  }

}

function toggleForm2(number)  {
  
  if (content.style.display === 'none') {
    content.style.display = 'block'
      if (number === 1) {
        show.textContent = "เงินได้ที่ได้รับยกเว้นอื่นๆ: ครอบคลุมรายได้บางประเภทที่ไม่ต้องเสียภาษี เช่น เงินทดแทนประกันสังคม หรือรายได้จากการขายที่ได้รับการยกเว้น"
      }else if (number === 2) {
        show.textContent = "เป็นกองทุนออมระยะยาวที่นายจ้างและลูกจ้างร่วมสมทบเงินเพื่อสร้างความมั่นคงในวัยเกษียณ โดยเงินสะสมและสมทบได้รับสิทธิยกเว้นภาษี และผลตอบแทนจากการลงทุนปลอดภาษี ทั้งนี้ ลูกจ้างสามารถเลือกนโยบายการลงทุนและรับเงินเมื่อเกษียณหรือออกจากงาน"
      }else {
        show.textContent = "เงินค่าประกันสังคม: การจ่ายเงินประกันสังคมช่วยคุ้มครองสิทธิประโยชน์ด้านสุขภาพและการเกษียณ และสามารถลดหย่อนภาษีได้เต็มจำนวน"
      }
  }else {
    content.style.display = 'none'
  }

}

function toggleForm3(number)  {
  
  if (content.style.display === 'none') {
    content.style.display = 'block'
      if (number === 1) {
        show.textContent = "กองทุน SSF (Super Savings Fund) เป็นกองทุนเปิดที่ส่งเสริมการออมระยะยาว โดยผู้ลงทุนต้องถือครองหน่วยลงทุนไม่น้อยกว่า 10 ปีปฏิทิน จึงจะได้รับสิทธิประโยชน์ทางภาษี นอกจากนี้ยังช่วยกระจายความเสี่ยงและสร้างโอกาสในการเติบโตของเงินลงทุน"
      }else if (number === 2) {
        show.textContent = "กองทุน RMF (Retirement Mutual Fund) ออกแบบเพื่อการเกษียณอายุ โดยผู้ลงทุนต้องลงทุนอย่างต่อเนื่องทุกปี (เว้นได้ไม่เกิน 1 ปีติดต่อกัน) และขายได้เมื่ออายุครบ 55 ปีบริบูรณ์ขึ้นไป ทั้งนี้กองทุน RMF ช่วยสนับสนุนการวางแผนทางการเงินระยะยาว"
      }else if (number === 3) {
        show.textContent = "กองทุน ThaiESG เน้นการลงทุนที่คำนึงถึงปัจจัยด้านสิ่งแวดล้อม (Environmental), สังคม (Social), และธรรมาภิบาล (Governance) ช่วยสนับสนุนธุรกิจที่มีความรับผิดชอบและยั่งยืน ทั้งยังมีศักยภาพในการเติบโตระยะยาว ขณะเดียวกันก็ช่วยลดหย่อนภาษีตามเกณฑ์ที่กำหนด"
      }else if (number === 4) {
        show.textContent = "ดอกเบี้ยจากการกู้ยืมเพื่อที่อยู่อาศัยนำมาลดหย่อนได้สูงสุด 100,000 บาท โดยเงื่อนไขสำคัญคือบ้านหลังดังกล่าวต้องเป็นที่อยู่อาศัยของผู้กู้หรือครอบครัว การลดหย่อนนี้ช่วยแบ่งเบาภาระค่าใช้จ่ายและสนับสนุนการเป็นเจ้าของบ้าน"
      }else {
        show.textContent = "การบริจาคเงินหรือทรัพย์สินให้กับองค์กรที่ได้รับการรับรอง เช่น โรงพยาบาล โรงเรียน หรือมูลนิธิที่จดทะเบียนถูกต้อง สามารถลดหย่อนภาษีได้สูงสุด 2 เท่าของยอดบริจาค ในกรณีที่บริจาคในโครงการที่รัฐกำหนด เช่น โครงการเพื่อการศึกษา หรือเพื่อสาธารณประโยชน์"
      }
  }else {
    content.style.display = 'none'
  }

}


function formatNumber(input) {
  // กำจัดตัวอักษรที่ไม่ใช่ตัวเลขหรือจุดทศนิยม
  let value = input.value.replace(/[^0-9.]/g, '');
  
  // แยกเป็นส่วนทศนิยมถ้ามี
  let parts = value.split('.');
  // เพิ่มลูกน้ำให้กับส่วนจำนวนเต็ม
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  
  // เชื่อมต่อส่วนจำนวนเต็มและทศนิยม
  input.value = parts.join('.');
}

//next and prev btn
const next = (margin) => {
  if (margin == 340) addCss(step1, step2);

  if (margin == 680) addCss(step2, step3);

  if (margin == 1020) addCss(step3, step4);

  if (margin == 0) window.location.reload();

  box.style.marginLeft = "-" + margin + "px";
  return false;
};

const prev = (margin) => {
  if (margin == 0) removeCss(step1, step2);

  if (margin == 340) removeCss(step2, step3);

  box.style.marginLeft = "-" + margin + "px";

  step3.querySelector("span").style.display = "block";
  step3.querySelector("i").classList.remove("active");
};
//end next and prev btn


//step action
const addCss = (step1, step2) => {
  step1.classList.add("active");
  step2.querySelector("span").classList.add("active");
  step1.querySelector("span").style.display = "none";
  step1.querySelector("i").classList.add("active");
};

const removeCss = (step1, step2) => {
  step1.classList.remove("active");
  step2.querySelector("span").classList.remove("active");
  step1.querySelector("span").style.display = "block";
  step1.querySelector("i").classList.remove("active");
};
//end step action

//validate form 1
const validateForm1 = () => {
  // ลบลูกน้ำออกจากค่า salary ก่อนทำการตรวจสอบ
  const salaryValue = salary.value.replace(/,/g, '');
  
  // ตรวจสอบว่าเป็นตัวเลขหรือไม่
  if (!salaryValue || isNaN(salaryValue)) {
    alert("กรุณากรอกข้อมูลเป็นตัวเลขให้ครบถ้วน!");
    return;
  }

  // ถ้าไม่มีปัญหา ก็สามารถดำเนินการต่อได้
  // เช่นส่งข้อมูลไปยัง server หรือประมวลผลอื่นๆ
  next("340");
};

//end validate form 1

//validate form 2
const validateForm2 = () => {
  if (!exemptIncome.value) {
    alert("กรุณากรอกข้อมูลเงินได้ที่ได้รับยกเว้นอื่นๆ");
    return;
  }
  if (!providentFund.value) {
    alert("กรุณากรอกข้อมูลการลงทุนในกองทุนสำรองเลี้ยงชีพ");
    return;
  }
  if (!maritalStatus.value) {
    alert("กรุณาเลือกสถานภาพของคุณ");
    return;
  }
  if (!parentResponsibility.value) {
    alert("กรุณาเลือกภาระรับผิดชอบพ่อแม่ของคุณ");
    return;
  }
  if (!spouseParentResponsibility.value) {
    alert("กรุณาเลือกภาระรับผิดชอบพ่อแม่ของคู่สมรส");
    return;
  }
  if (!childResponsibility.value) {
    alert("กรุณาเลือกภาระรับผิดชอบบุตรอายุไม่เกิน 25 ปี");
    return;
  }
  if (!disabledResponsibility.value) {
    alert("กรุณาเลือกภาระรับผิดชอบผู้พิการ/บุคคลไร้ความสามารถ");
    return;
  }
  if (!socialInsurance.value) {
    alert("กรุณากรอกข้อมูลค่าประกันสังคมที่จ่ายไป");
    return;
  }

  next("680");
};
//end validate form 2

//validate form 3
const validateForm3 = () => {
  if (!lifeInsurance.value) {
    alert("กรุณาเลือกว่าคุณจ่ายเบี้ยประกันชีวิตหรือไม่");
    return;
  }
  if (!ssfInvestment.value) {
    alert("กรุณากรอกข้อมูลการลงทุนในกองทุน SSF");
    return;
  }
  if (!rmfInvestment.value) {
    alert("กรุณากรอกข้อมูลการลงทุนในกองทุน RMF");
    return;
  }
  if (!thaiESGInvestment.value) {
    alert("กรุณากรอกข้อมูลการลงทุนในกองทุน ThaiESG");
    return;
  }
  if (!homeLoanInterest.value) {
    alert("กรุณากรอกข้อมูลดอกเบี้ยสินเชื่อบ้านที่จ่ายไป");
    return;
  }
  if (!donation.value) {
    alert("กรุณากรอกข้อมูลการบริจาคเพื่อการศึกษา/กีฬา/โรงพยาบาลรัฐ");
    return;
  }

  next("1020");
};
//end validate form 3

const validateForm4 = () => {

  //add condition form 4

  next("0")
}









function closeBtn() {
  let content = document.getElementById('box-content')
  content.style.display = 'none';
}



