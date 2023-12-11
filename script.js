document.addEventListener('DOMContentLoaded', function() {
    // Handle 'Add User' form submission
    var urlParams = new URLSearchParams(window.location.search);
    window.userId = urlParams.get('userId');
 
    var addUserForm = document.getElementById('addUserForm');
    if (addUserForm) {
      addUserForm.onsubmit = function(event) {
        event.preventDefault();
        var formData = new FormData(addUserForm);
        var xhrAddUser = new XMLHttpRequest();
        xhrAddUser.open('POST', `add_user.php`, true);
  
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
        // Append userId to formData
        formData.append('createdBy', window.userId);
    
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
    var assignBtn = document.getElementById('assign-to-me-btn');
    if (assignBtn) {
        assignBtn.addEventListener('click', function() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'assign_contact.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    var response = JSON.parse(this.responseText);
                    alert(response.message);
                    if (response.success) {
                        // Update the page or reload
                    }
                } else {
                    alert('Error with the request.');
                }
            };
            xhr.send('contactId=<?php echo $contactId; ?>');
        });
    }
    var addNoteForm = document.getElementById('add-note-form');
    if(addNoteForm){
      addNoteForm.onsubmit = function(event) {
        event.preventDefault();
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_note.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status === 200) {
                var response = JSON.parse(this.responseText);
                alert(response.message);
                if (response.success) {
                    // Optionally, clear the textarea and update the notes displayed on the page
                    document.getElementById('note-text').value = '';
                }
            } else {
                alert('Error with the request.');
            }
        };
        xhr.send('contactId=' + encodeURIComponent(addNoteForm.contactId.value) +
                  '&userId=' + encodeURIComponent(addNoteForm.userId.value) +
                  '&note=' + encodeURIComponent(addNoteForm.note.value));
    };
    }
    function filterContacts(filterType) {
      // Get all filter options
      var filters = document.querySelectorAll('.filter-option');
  
      // Remove the 'filter-clicked' class from all filters
      filters.forEach(function(filter) {
          filter.classList.remove('filter-clicked');
      });
  
      // Add the 'filter-clicked' class to the clicked filter
      document.getElementById('filter-' + filterType.toLowerCase().replace(/\s+/g, '-')).classList.add('filter-clicked');
  
      var rows = document.getElementById('userTableBody').rows;
      for (var i = 0; i < rows.length; i++) {
          var typeCell = rows[i].cells[3].textContent;
          if (filterType === 'all' || typeCell === filterType) {
              rows[i].style.display = '';
          } else {
              rows[i].style.display = 'none';
          }
      }
  }
    
  });  
