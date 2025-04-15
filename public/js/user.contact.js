  //contact us js

  document.getElementById('contactForm').addEventListener('submit', function(e) {
    if (!this.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
      alert("Please fill all required fields correctly!");
    }
    this.classList.add('was-validated');
  });