window.onload = function() {
    document.querySelector('#contactForm').addEventListener('submit', function(event) { 
    const required = document.querySelectorAll('.required');
    const validateEmail = (email) => {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
      };
    for (let i = 0; i < required.length; i++) {
        required[i].addEventListener('change', function() {
            required[i].style = 'border-color:initial';
            });
            if(required[i].id == "email"){
                if(validateEmail(required[i].value) == false){
                    event.preventDefault();
                    required[i].style = 'border:solid 4px purple';
                    alert("You have entered an invalid email address!")
                    break;
                }
            }
       
            if (required[i].value == '') {
            event.preventDefault();
            required[i].style = 'border:solid 4px purple';
            alert('Please fill in all required fields');
            break;
            
        }
    
    }
});


}
