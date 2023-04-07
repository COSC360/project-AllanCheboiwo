window.onload= function(){
    function sendEmail() {
        Email.send({
          Host: "smtp.gmail.com",
          Username: "allangabz@gmail.com",
          Password: "kumberel16",
          To: 'allangabz@gmail.com',
          From: "allangabz@gmail.com",
          Subject: "Discuss Contact Form",
          Body: "Well that was easy!!",
        })
          .then(function (message) {
            alert("mail sent successfully")
          });
      }
}