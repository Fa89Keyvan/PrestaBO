<form action="/" method="post" id="frmHfContact"></form>

<script>
    var model = {
        Address: {type:'text',label:'آدرس'},
        City: {type:'text',label:'شهر'},
        Code: {type:'number',label:'کد حسابفا'},
        ContactType: {type:'number',label:'نوع مشتری'},
        Credits: {type:'number',label:'اعتبار'},
        EconomicCode: {type:'number',label:'کد اقتصادی'},
        Email: {type:'email',label:'ایمیل'},
        Fax: {type:'number',label:'فکس'},
        FirstName: { type: 'text', label: 'نام' },
        ID: { type: 'number', label: 'شناسه', readonly:true },
        LastName: {type:'text',label:'نام خانوادگی'},
        Liability: {type:'number',label:'سمت'},
        Mobile: {type:'text',label:'موبایل'},
        Name: {type:'text',label:'نام'},
        NationalCode: {type:'number',label:'کد ملی'},
        Note: {type:'text',label:'توضیح'},
        Phone: {type:'text',label:'تلفن'},
        PostalCode: {type:'text',label:'کد پستی'},
        RegistrationDate: {type:'text',label:'تاریخ ثبت نام'},
        RegistrationNumber: {type:'number',label:'کد ثبت نام'},
        SharePercent: {type:'number',label:'قدرالسهم'},
        State: {type:'text',label:'استان'},
        Website: {type:'text',label:'وبسایت'}
    };

    var formElements = editorForModel(model);
    formElements += submit('ارسال','btnSendToHf')
    var frmHfContact = document.getElementById('frmHfContact');
    frmHfContact.innerHTML = formElements;
    
</script>
