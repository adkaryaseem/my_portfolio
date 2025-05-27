        // Set current year in footer
        document.getElementById('copyrightYear').textContent = new Date().getFullYear();
    

  (function () {
    emailjs.init("JgvN77xG8oXrk-5SS");
  })();

  document.getElementById("contactForm").addEventListener("submit", function (e) {
    e.preventDefault();

    var name = document.getElementById('user_name').value.trim();
    var email = document.getElementById('user_email').value.trim();
    var message = document.getElementById('message').value.trim();
    var formMessage = document.getElementById('formMessage');

    // Simple validation
    if (!name || !email || !message) {
      formMessage.style.color = 'red';
      formMessage.textContent = 'Please fill in all fields.';
      return;
    }

    // Email format validation
    var emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
    if (!emailPattern.test(email)) {
      formMessage.style.color = 'red';
      formMessage.textContent = 'Please enter a valid email address.';
      return;
    }

    // Send the form via EmailJS
    emailjs.sendForm("service_t60d1l8", "template_rermlzc", this)
      .then(function () {
        formMessage.style.color = 'green';
        formMessage.textContent = '✅ Message sent successfully!';
        setTimeout(function () {
          document.getElementById("contactForm").reset();
          formMessage.textContent = '';
        }, 1000);
      }, function (error) {
        formMessage.style.color = 'red';
        formMessage.textContent = '❌ Failed to send message: ' + JSON.stringify(error);
      });
  });