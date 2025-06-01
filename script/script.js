    // Make header sticky when it reaches the top
    window.addEventListener('DOMContentLoaded', function() {
        const header = document.querySelector('header');
        header.style.position = 'sticky';
        header.style.top = '0';
        header.style.zIndex = '1100';
    });
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');
    function handleMenuDisplay() {
        if (window.innerWidth <= 768) {
            menuToggle.style.display = 'block';
            mainNav.classList.remove('show');
        } else {
            menuToggle.style.display = 'none';
            mainNav.style.display = '';
            mainNav.classList.remove('show');
            mainNav.style.transform = '';
        }
    }
    menuToggle.addEventListener('click', function() {
        mainNav.classList.toggle('show');
    });
    mainNav.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                mainNav.classList.remove('show');
            }
        });
    });
    window.addEventListener('resize', handleMenuDisplay);
    window.addEventListener('DOMContentLoaded', handleMenuDisplay);
    
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
