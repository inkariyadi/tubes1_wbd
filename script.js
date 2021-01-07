var username = document.getElementById('username');
var email = document.getElementById('email');
var container = document.getElementById('con');
var container1 = document.getElementById('con2');
var reg = document.getElementById('reg');  
var password = document.getElementById('password');
var conpassword = document.getElementById('conpassword');
var container2 = document.getElementById('con3');

// reg.addEventListener('mouseover',function(){
//     alert('yeyyy');
// })

email.addEventListener('keyup',function(){
    // console.log(email.value);

    //Buat object AJAX
    var xhr = new XMLHttpRequest();

    //Cek kesiapan AJAX
    //4 : Sumber ready
    //200 : Status oke
    xhr.onreadystatechange = function(){
        if(xhr.readyState==4 && xhr.status==200){
            // console.log('Ajax Ready');
            // console.log(xhr.responseText);
            console.log(xhr.responseText);
            if(xhr.responseText=="0"){
                email.style.border = "3px solid green";
                container.innerHTML = "";
            }
            else {
                email.style.border = "3px solid red";
                if(xhr.responseText=="1"){
                    container.innerHTML = "Please input a valid email";
                }else{
                    container.innerHTML = "Email taken. Please try another email";
                }
                
                
            }
            // container.innerHTML = xhr.responseText;
        }
    }
    xhr.open('POST','ajax/email.php?email='+email.value,true);
    xhr.send();


})

username.addEventListener('keyup',function(){
    // console.log(email.value);

    //Buat object AJAX
    var xhr = new XMLHttpRequest();

    //Cek kesiapan AJAX
    //4 : Sumber ready
    //200 : Status oke
    xhr.onreadystatechange = function(){
        if(xhr.readyState==4 && xhr.status==200){
            // console.log('Ajax Ready');
            // console.log(xhr.responseText);
            console.log(xhr.responseText);
            if(xhr.responseText=="0"){
                username.style.border = "3px solid green";
                container1.innerHTML = "";
            }
            else {
                username.style.border = "3px solid red";
                if(xhr.responseText=="1"){
                    container1.innerHTML = "Please input a valid username";
                }else{
                    container1.innerHTML = "Username taken. Please try another username";
                }
                
                
            }
            // container.innerHTML = xhr.responseText;
        }
    }
    xhr.open('POST','ajax/username.php?username='+username.value,true);
    xhr.send();


})

conpassword.addEventListener('keyup',function(){
    // console.log(email.value);

    //Buat object AJAX
    var xhr = new XMLHttpRequest();

    //Cek kesiapan AJAX
    //4 : Sumber ready
    //200 : Status oke
    xhr.onreadystatechange = function(){
        if(xhr.readyState==4 && xhr.status==200){
            // console.log('Ajax Ready');
            // console.log(xhr.responseText);
            console.log(xhr.responseText);
            if(xhr.responseText=="0"){
                conpassword.style.border = "3px solid green";
                container2.innerHTML = "";
            }
            else {
                conpassword.style.border = "3px solid red";
                container2.innerHTML = "Password not the same";
                
                
                
            }
            // container.innerHTML = xhr.responseText;
        }
    }
    xhr.open('POST','ajax/password.php?conpassword='+conpassword.value+'&password='+password.value,true);
    xhr.send();


})