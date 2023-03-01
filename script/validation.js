window.onload = function() {
    document.querySelector('#contactForm').addEventListener('submit', function(event) { 
    // var email = document.querySelector('#email').value;
    // if (ValidateEmail(email) == false) {
    //     event.preventDefault();
    //     document.querySelector('#email').style = 'border:solid 4px purple';
    //     alert('Please fill in all required fields');
    // }
    const required = document.querySelectorAll('.required');
    for (let i = 0; i < required.length; i++) {
        required[i].addEventListener('change', function() {
            required[i].style = 'border-color:initial';
            });
       
            if (required[i].value == '') {
            event.preventDefault();
            required[i].style = 'border:solid 4px purple';
            alert('Please fill in all required fields');
            break;
            
        }
        if(required[i].id == "email"){
            if(ValidateEmail(required[i].value) == false){
                event.preventDefault();
                required[i].style = 'border:solid 4px purple';
                alert('Please Enter a valid email address');
                break;
            }
        }
    
    }
});
    function ValidateEmail(mail) 
    {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.emailAddr.value))
    {
        return (true)
    }
        alert("You have entered an invalid email address!")
        return (false)
    }

}
