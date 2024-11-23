let FormData1 = {
    salary: null,   // รายได้ต่อเดือน
    bonus: null,    // โบนัส
    OtherIncome: null // รายได้อื่นๆ
};

let FormData2 = {
    exemptIncome: null, //เงินที่ได้รับยกเว้น
    providentFund: null,    //กองทุนสำรองเลี้ยงชีพ   
    socialInsurance: null,  //เงินค่าประกันสังคม
    maritalStatus: null,    //สถานภาพของคุณ
    parentResponsibility: null, //ภาระรับผิดชอบพ่อแม่ของคุณ
    spouseParentResponsibility: null,   //ภาระรับผิดชอบพ่อแม่ของคู่สมรส
    childResponsibility: null,  //ภาระรับผิดชอบบุตรอายุไม่เกิน 2 คน5 ปี
    disabledResponsibility: null    //ภาระรับผิดชอบผู้พิการ/บุคคลไร้ความสามารถ
};

let FormData3 = {
    lifeInsurance: null,    //ปีนี้คุณจ่ายเบี้ยประกันชีวิตหรือไม่
    ssfInvestment: null,    //คุณได้ลงทุนในกองทุน SSF ไปเท่าไหร่?
    rmfInvestment: null,    //คุณได้ลงทุนในกองทุน RMF ไปเท่าไหร่?
    thaiESGInvestment: null,    //คุณได้ลงทุนในกองทุน ThaiESG ไปเท่าไหร่?
    homeLoanInterest: null,     //คุณจ่ายดอกเบี้ยสินเชื่อบ้านไปเท่าไหร่?
    donation: null              //คุณบริจาคเพื่อการศึกษา/กีฬา/โรงพยาบาลรัฐไปเท่าไหร่?
};

let DataInvasting = { 
    SSF: null,
    RMF: null,
    EGS: null
};

    // function calculate Home loan
    function Homeloan() {
        const HomeLimit = 100000; // ลดหย่อนสินเชื่อบ้านได้ไม่เกิน 100,000 บาท
        const Home = FormData3.homeLoanInterest; //รับค่ามาจาก สินเชื่อบ้านที่ลูกค้า ส่งข้อมูลมาจาก form-3

        return Math.min(Home, HomeLimit); //ส่งค่าที่น้อยที่สุดแต่ไม่เกิน 100,000 บาท
    }

    // คำนวณการบริจาค form-3
    function Donation() {

        // รายได้สุทธิทั้งหมด
        const TotalIncome = FormData1.salary + FormData1.bonus + FormData1.OtherIncome + FormData2.exemptIncome; // รายได้สุทธิทั้งหมด
        // รวมค่าลดหย่อน form-2
        const Deductibles = FormData2.providentFund + FormData2.socialInsurance + FormData2.maritalStatus + FormData2.parentResponsibility + 
            FormData2.spouseParentResponsibility + FormData2.childResponsibility + FormData2.disabledResponsibility; 
        // ลดหย่อนของกองทุน
        const Result = DataInvasting.SSF + DataInvasting.RMF + DataInvasting.EGS;
        // ลบค่าลดหย่อนทั้งหมด
        const CalDonation = TotalIncome - Deductibles - Result ;


        // คิดLimit ที่user สามารถลดได้
        const LimitDonation = CalDonation * 0.1 ;
        //ค่าที่ลูกค้ากรอกเข้ามา
        const UserDonation = FormData3.donation;

        return Math.min(UserDonation, LimitDonation);

    }

function saveform1(event) {
    event.preventDefault(); // ป้องกันการส่งฟอร์มและรีเฟรชหน้าเว็บ
    
    // ฟังก์ชันเพื่อกำจัดลูกน้ำและแปลงเป็นตัวเลข
    function parseNumberWithComma(value) {
        return parseFloat(value.replace(/,/g, '')) || 0;
    }

    // กำหนดค่าของ FormData1 โดยลบลูกน้ำออกก่อนแปลงเป็นตัวเลข
    FormData1.salary = parseNumberWithComma(document.getElementById('salary').value);
    FormData1.bonus = parseNumberWithComma(document.getElementById('bonus').value);
    FormData1.OtherIncome = parseNumberWithComma(document.getElementById('year-salary').value);
}



function saveform2(event) {
    event.preventDefault(); // ป้องกันการส่งฟอร์มและรีเฟรชหน้าเว็บ

    // ฟังก์ชันเพื่อกำจัดลูกน้ำและแปลงเป็นตัวเลข
    function parseNumberWithComma(value) {
        return parseFloat(value.replace(/,/g, '')) || 0;
    }

    // กำหนดค่าของ FormData2 โดยลบลูกน้ำออกก่อนแปลงเป็นตัวเลข
    FormData2.exemptIncome = parseNumberWithComma(document.getElementById('exemptIncome').value);
    FormData2.providentFund = parseNumberWithComma(document.getElementById('providentFund').value);
    FormData2.socialInsurance = parseNumberWithComma(document.getElementById('socialInsurance').value);
    FormData2.maritalStatus = parseNumberWithComma(document.getElementById('maritalStatus').value);
    FormData2.parentResponsibility = parseNumberWithComma(document.getElementById('parentResponsibility').value);
    FormData2.spouseParentResponsibility = parseNumberWithComma(document.getElementById('spouseParentResponsibility').value);
    FormData2.childResponsibility = parseNumberWithComma(document.getElementById('childResponsibility').value);
    FormData2.disabledResponsibility = parseNumberWithComma(document.getElementById('disabledResponsibility').value);
}




function saveform3(event) {
    event.preventDefault(); // ป้องกันการส่งฟอร์มและรีเฟรชหน้าเว็บ

    // ฟังก์ชันเพื่อกำจัดลูกน้ำและแปลงเป็นตัวเลข
    function parseNumberWithComma(value) {
        return parseFloat(value.replace(/,/g, '')) || 0;
    }

    // กำหนดค่าของ FormData3
    FormData3.lifeInsurance = parseNumberWithComma(document.getElementById('lifeInsurance').value);
    FormData3.ssfInvestment = parseNumberWithComma(document.getElementById('ssfInvestment').value);
    FormData3.rmfInvestment = parseNumberWithComma(document.getElementById('rmfInvestment').value);
    FormData3.thaiESGInvestment = parseNumberWithComma(document.getElementById('thaiESGInvestment').value);
    FormData3.homeLoanInterest = parseNumberWithComma(document.getElementById('homeLoanInterest').value); //สินเชื่อบ้าน
    FormData3.donation = parseNumberWithComma(document.getElementById('donation').value); //การบริจาค

    let TotalAllSSF = FormData1.salary + FormData1.bonus + FormData1.OtherIncome + FormData2.exemptIncome ;

    // ฟังก์ชันคำนวณ SSF
    function calculatSSF() {
        const SSFLimit = 200000;
        const SSFUserLimit = TotalAllSSF * 0.3;
        const SSF = FormData3.ssfInvestment;

        if (SSFUserLimit > SSFLimit) {
            return Math.min(SSF, SSFLimit);
        } else {
            return Math.min(SSF, SSFUserLimit);
        }
    }

    // ฟังก์ชันคำนวณ RMF
    function calculatRMF() {
        const RMFLimit = 300000;
        const RMFUserLimit = TotalAllSSF * 0.3;
        const RMF = FormData3.rmfInvestment;

        if (RMFUserLimit > RMFLimit) {
            return Math.min(RMF, RMFLimit);
        } else {
            return Math.min(RMF, RMFUserLimit);
        }
    }

    // ฟังก์ชันคำนวณ EGS
    function calculatEGS() {
        const EGSLimit = 100000;
        const EGSUserLimit = TotalAllSSF * 0.3;
        const EGS = FormData3.thaiESGInvestment;

        if (EGSUserLimit > EGSLimit) { 
            return Math.min(EGS, EGSLimit);
        } else {
            return Math.min(EGS, EGSUserLimit);
        }
    }

    // คำนวณค่า SSF, RMF, EGS และส่งค่าไปยัง DataInvasting
    DataInvasting.SSF = calculatSSF();
    DataInvasting.RMF = calculatRMF();
    DataInvasting.EGS = calculatEGS();

    // ตรวจสอบค่าที่ได้จาก DataInvasting
    console.log("SSF: " + DataInvasting.SSF);
    console.log("RMF: " + DataInvasting.RMF);
    console.log("EGS: " + DataInvasting.EGS);
}

function CalTaxForm2(){
    let Deductibles = FormData2.providentFund + FormData2.socialInsurance + FormData2.maritalStatus + FormData2.parentResponsibility + 
    FormData2.spouseParentResponsibility + FormData2.childResponsibility + FormData2.disabledResponsibility;

    let TotalIncome = FormData1.salary + FormData1.bonus + FormData1.OtherIncome + FormData2.exemptIncome; // รายได้สุทธิทั้งหมด
    let DeducTax = TotalIncome - Deductibles; //ยังไม่รวมกองทุน
    let CalDeducTax = 0;

    if (DeducTax <= 150000) {
        return "รายได้ของคุณไม่ได้อยู่ในเกณฑ์ที่ต้องจ่ายภาษี";
    } else if (DeducTax > 150001 && DeducTax <= 300000) {
        CalDeducTax = DeducTax * 0.05;
    } else if (DeducTax > 300001 && DeducTax <= 500000) {
        CalDeducTax = DeducTax * 0.1;
    } else if (DeducTax > 500001 && DeducTax <= 750000) {
        CalDeducTax = DeducTax * 0.15;
    } else if (DeducTax > 750001 && DeducTax <= 1000000) {
        CalDeducTax = DeducTax * 0.2;
    } else if (DeducTax > 1000001 && DeducTax <= 2000000) {
        CalDeducTax = DeducTax * 0.25;
    } else if (DeducTax > 2000001 && DeducTax <= 5000000) {
        CalDeducTax = DeducTax * 0.3;
    } else {
        CalDeducTax = DeducTax * 0.35;
    }   
    return CalDeducTax;
}

function CalTaxForm3(){
    let Deductibles = FormData2.providentFund + FormData2.socialInsurance + FormData2.maritalStatus + FormData2.parentResponsibility + 
    FormData2.spouseParentResponsibility + FormData2.childResponsibility + FormData2.disabledResponsibility;

    let ssf = DataInvasting.SSF;    
    let rmf = DataInvasting.RMF;
    let egs = DataInvasting.EGS;
    let Result = ssf + rmf + egs;

    let TotalIncome = FormData1.salary + FormData1.bonus + FormData1.OtherIncome + FormData2.exemptIncome; // รายได้สุทธิทั้งหมด
    let InvestTax = TotalIncome - Deductibles - Result; //รวมกองทุน
    let CalInvestTax = 0;

    if (InvestTax <= 150000) {
        return "รายได้ของคุณไม่ได้อยู่ในเกณฑ์ที่ต้องจ่ายภาษี";
    } else if (InvestTax > 150001 && InvestTax <= 300000) {
        CalInvestTax = InvestTax * 0.05;
    } else if (InvestTax > 300001 && InvestTax <= 500000) {
        CalInvestTax = InvestTax * 0.1;
    } else if (InvestTax > 500001 && InvestTax <= 750000) {
        CalInvestTax = InvestTax * 0.15;
    } else if (InvestTax > 750001 && InvestTax <= 1000000) {
        CalInvestTax = InvestTax * 0.2;
    } else if (InvestTax > 1000001 && InvestTax <= 2000000) {
        CalInvestTax = InvestTax * 0.25;
    } else if (InvestTax > 2000001 && InvestTax <= 5000000) {
        CalInvestTax = InvestTax * 0.3;
    } else {
        CalInvestTax = InvestTax * 0.35;
    }   
    return CalInvestTax;


}

function submitForm(event) {
    event.preventDefault(); // ป้องกันการรีเฟรชหน้าเว็บเมื่อกดปุ่ม submit

    // เรียกฟังก์ชันต่าง ๆ ในการเก็บข้อมูลและคำนวณ
    saveform3(event);  // ฟังก์ชันที่คำนวณค่าต่าง ๆ และเก็บผลลัพธ์
    ShowForm();   // ฟังก์ชันที่แสดงผลลัพธ์
}


function ShowForm() {
    // ตรวจสอบว่าค่าของ DataInvasting ไม่เป็น null
    if (DataInvasting.SSF === null || DataInvasting.RMF === null) {
        console.log("Error: DataInvasting is not updated yet. Please submit the form first.");
        return; // หยุดการทำงานของฟังก์ชันถ้าค่าของ DataInvasting ยังเป็น null
    };

    // Total deductibles included รวมค่าลดหย่อนทั้งหมด
    let Deductibles = FormData2.providentFund + FormData2.socialInsurance + FormData2.maritalStatus + FormData2.parentResponsibility + 
                        FormData2.spouseParentResponsibility + FormData2.childResponsibility + FormData2.disabledResponsibility;

    let TotalIncome = FormData1.salary + FormData1.bonus + FormData1.OtherIncome + FormData2.exemptIncome; // รายได้สุทธิทั้งหมด
    let ssf = DataInvasting.SSF;    
    let rmf = DataInvasting.RMF;
    let egs = DataInvasting.EGS;
    let Result = ssf + rmf + egs;

    let ResultCalTax = CalTaxForm2(); // คำนวณภาษีที่ไม่รวมกองทุน
    let ResultCalTax1 = CalTaxForm3(); // คำนวณภาษีที่รวมกองทุน
    let CalHomeloan = Homeloan(); // ค่าที่คำนวณ สินเชื่อบ้าน
    let CalDonation = Donation(); // ค่าที่คำนวณ การบริจาค

    let FinalTotal = ResultCalTax1 - CalHomeloan - CalDonation;
    let HandD = CalHomeloan + CalDonation;

    console.log("check totalall from form1: " + TotalIncome); // เช็คยอดรวมรายรับ
    console.log("check RMF from DataInvasting: " + ssf); // เช็คค่า SSF
    console.log("check RMF from DataInvasting: " + rmf); // เช็คค่า RMF
    console.log("check RMF from DataInvasting: " + Result); // เช็คค่ารวมของ SSF RMF EGs
    console.log("check total Deductibles : " + Deductibles); // เช็ค ค่าลดหย่อนทั้งหมด จาก form2
    console.log("check total ResultCalTax : " + ResultCalTax); // เช็คค่า คำนวณภาษีที่ไม่รวมกองทุน
    console.log("check total ResultCalTax1 : " + ResultCalTax1); // เช็คค่า คำนวณภาษีที่รวมกองทุน
    console.log("check total Homeloan : " + CalHomeloan); // เช็คค่า ค่าที่คำนวณ สินเชื่อบ้าน
    console.log("check total Donation : " + CalDonation); // เช็คค่า ค่าที่คำนวณ การบริจาค

    // แสดงค่าที่form 4 ทั้งหมด
    document.getElementById('result').innerHTML = TotalIncome.toLocaleString() + " บาท" // รวมเงินได้สุทธิ
    document.getElementById('taxBeforeDeductions').innerHTML = ResultCalTax.toLocaleString() + " บาท" // ภาษีที่ต้องจ่าย (ก่อนลดหย่อนด้วย SSF / RMF / ThaiESG)
    document.getElementById('ssfSumInvestment').innerHTML = ssf.toLocaleString() + " บาท" // ลงทุน SSF อย่างเดียว
    document.getElementById('rmfSumInvestment').innerHTML = rmf.toLocaleString() + " บาท" // ลงทุน RMF อย่างเดียว
    document.getElementById('thaiESGSumInvestment').innerHTML = egs.toLocaleString() + " บาท" // ลงทุน ThaiESG
    document.getElementById('totalInvestment').innerHTML = Result.toLocaleString() + " บาท" // ลงทุนรวม
    document.getElementById('maxTaxSavings').innerHTML = Result.toLocaleString() + " บาท" // เมื่อลงทุนสูงสุด (บาท
    document.getElementById('remainingTax').innerHTML = FinalTotal.toLocaleString() + " บาท" // เหลือภาษีที่ต้องจ่ายทั้งหมด
    document.getElementById('customTaxSavings').innerHTML = HandD.toLocaleString() + " บาท" // ยอดรวมเงินบริจาคและสินเชื่อ

    Donation();
    Homeloan();
    CalTaxForm3();
    CalTaxForm2();
}


document.getElementById('form-1').addEventListener('submit', saveform1);
document.getElementById('form-2').addEventListener('submit', saveform2);
document.getElementById('form-3').addEventListener('submit', saveform3);
document.getElementById('submitBtn').addEventListener('click', submitForm);


