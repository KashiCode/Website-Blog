
// Functional javascript. 


// Assessment Criteria 5.
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const titleInput = document.getElementById('title');
    const postContentInput = document.getElementById('message');

    form.addEventListener('submit', function(event) {
      let isValid = true;

      titleInput.classList.remove('missing');
      postContentInput.classList.remove('missing');

      if (!titleInput.value.trim()) {
        titleInput.classList.add('missing');
        isValid = false;
      }

      if (!postContentInput.value.trim()) {
        postContentInput.classList.add('missing');
        isValid = false;
      }

      if (!isValid) {
        event.preventDefault(); // Prevent form submission
        alert('Please fill in all required fields.');
      }
    });
  });


// Clear Button Event Listener.
document.getElementById('clearButton').addEventListener('click', function() {
  window.location.reload();
});


// Extra Feature 2. 
if (new URLSearchParams(window.location.search).has('error')) {
    alert('Incorrect password or email.');
    // Redirect to remove the GET parameter after showing the alert
    window.history.replaceState({}, document.title, "login.html");
  }



function previewPost() {
  var title = document.getElementById('title').value;
  var content = document.getElementById('message').value;
  
  var popupContent = '<div style="font-family: sans-serif;">';
  popupContent += '<h3>' + title + '</h3>';
  popupContent += '<p>' + content.replace(/\n/g, '<br>') + '</p>';
  popupContent += '</div>';


  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'fetchPosts.php', true);
  xhr.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
          
          popupContent += this.responseText;

         
          var previewWindow = window.open('', 'Preview Post', 'width=800,height=600,scrollbars=yes');
          previewWindow.document.write(popupContent);
          previewWindow.document.close(); // Ensure the popup content is rendered immediately
      }
  };
  xhr.send();
}


document.addEventListener('DOMContentLoaded', (event) => {
  var previewBtn = document.getElementById('previewButton');
  if(previewBtn) {
      previewBtn.addEventListener('click', previewPost);
  }
});





  