document.addEventListener('DOMContentLoaded', function() {
    // Handle 'Add User' form submission
    var addUserForm = document.getElementById('addUserForm');
    if (addUserForm) {
      addUserForm.onsubmit = function(event) {
        event.preventDefault();
        var formData = new FormData(addUserForm);
        var xhrAddUser = new XMLHttpRequest();
        xhrAddUser.open('POST', 'add_user.php', true);
  
        xhrAddUser.onload = function() {
          if (this.status === 200) {
            var response = JSON.parse(this.responseText);
            if (response.success) {
              alert('User added successfully');
              loadUsers(); // Reload the user list
            } else {
              alert('Error: ' + response.message);
            }
          } else {
            alert('Error with the request.');
          }
        };
        xhrAddUser.send(formData);
      };
    }
  
    // Handle 'Login' form submission
    var loginForm = document.getElementById('loginForm');
    if (loginForm) {
      loginForm.onsubmit = function(event) {
        event.preventDefault();
        var formData = new FormData(loginForm);
        var xhrLogin = new XMLHttpRequest();
        xhrLogin.open('POST', 'login.php', true);
        xhrLogin.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
        xhrLogin.onreadystatechange = function() {
          if (this.readyState === XMLHttpRequest.DONE) {
            var response = JSON.parse(this.responseText);
            if (this.status === 200 && response.success) {
              alert('Login successful');
              // Redirect using JavaScript if needed
              window.location.href = 'dashboard.php';
            } else {
              alert('Error: ' + response.message);
            }
          }
        };
  
        var urlEncodedData = '';
        var urlEncodedDataPairs = [];
        formData.forEach(function(value, key) {
          urlEncodedDataPairs.push(encodeURIComponent(key) + '=' + encodeURIComponent(value));
        });
        urlEncodedData = urlEncodedDataPairs.join('&').replace(/%20/g, '+');
        xhrLogin.send(urlEncodedData);
      };
    }
  
    var addContactForm = document.getElementById('addContactForm');
    if (addContactForm) {
      addContactForm.onsubmit = function(event) {
        event.preventDefault();
  
        var formData = new FormData(addContactForm);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_contact.php', true);
  
        xhr.onload = function() {
          if (this.status === 200) {
            var response = JSON.parse(this.responseText);
            alert(response.message);
            if (response.success) {
              // Clear the form or redirect as needed
              addContactForm.reset();
            }
          } else {
            alert('Error with the request.');
          }
        };
        xhr.send(formData);
      };
    }
  });  
