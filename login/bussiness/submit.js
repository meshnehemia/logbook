let submit = document.querySelector('.login-form');
let return_response = document.querySelector('.feedback');

submit.addEventListener('submit',(e)=>{
    e.preventDefault();
    return_response.classList.add('feedback_loading');
    return_response.innerHTML="loading...";
    setTimeout(function() {
        let xml = new XMLHttpRequest();
        xml.open("POST",'../database/checkemail.php',true);
        xml.onload =()=>{
            if(xml.readyState === XMLHttpRequest.DONE){
                if(xml.status === 200){
                    let data =xml.response;
                    if(data =="welcome back student"){
                        return_response.classList.add('feedback_login_success');
                        return_response.innerHTML=data;
                        setTimeout(function() {location.href = "../../student/fronted/logbook.php"; }, 2000);
                    }else if(data=="welcome admin"){
                        return_response.classList.add('feedback_login_success');
                        return_response.innerHTML=data;
                        setTimeout(function() {location.href = "../../administrator/fronted/logbook.php"; }, 2000);
                    }else if(data=="hello lecturer"){
                        return_response.classList.add('feedback_login_success');
                        return_response.innerHTML=data;
                        setTimeout(function() {location.href = "../../lecture/fronted/assigned_students.php"; }, 2000);
                    }else if(data=="logging in as supervisor"){
                        return_response.classList.add('feedback_login_success');
                        return_response.innerHTML=data;
                        setTimeout(function() {location.href = "../../supervisor/fronted/companyinfo.php"; }, 2000);
                    }else{
                        return_response.classList.add('feedback_login_fail');
                        return_response.innerHTML=data;
                    }
                }
            }
        }
        let formData =new FormData(document.querySelector('.login-form'));
        xml.send(formData);
    }, 2000);
});