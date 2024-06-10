
    document.addEventListener('DOMContentLoaded', function() {
      const backToLoginButton = document.getElementById('back-to-login-button');
      if (backToLoginButton) {
        backToLoginButton.addEventListener('click', function() {
          window.location.href = 'login.php';  
        });
      }
    });
  