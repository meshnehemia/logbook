let submit = document.querySelector('.registration-form');
let return_response = document.querySelector('.feedback');
submit.addEventListener('submit',(e)=>{
    e.preventDefault();
    return_response.classList.add('feedback_loading');
    return_response.innerHTML="loading...";
    setTimeout(function() {
        let xml = new XMLHttpRequest();
        xml.open("POST",'../database/registration.php',true);
        xml.onload =()=>{
            if(xml.readyState === XMLHttpRequest.DONE){
                if(xml.status === 200){
                    let data =xml.response;
                    if(data =="New record created successfully"){
                        return_response.classList.add('feedback_login_success');
                        return_response.innerHTML=data;
                        setTimeout(function() {location.href = "../../login/index.php"; }, 2000);
                    }else{
                        return_response.classList.add('feedback_login_fail');
                        return_response.innerHTML=data;
                    }
                }
            }
        }
        let formData =new FormData(document.querySelector('.registration-form'));
        xml.send(formData);
    }, 2000);
});