

// Additional javascript for enhanced visual effects

window.onload = function() {
    var speed = 50;  
    var element = document.querySelector('.description');
    typeEffect(element, speed);
  };
  
  document.addEventListener('DOMContentLoaded', function() {
    var roles = ['Student', 'Designer', 'Web Developer'];
    var currentRoleIndex = 0; 
    var roleElement = document.getElementById('role');
  
    
    function updateRole() {
        roleElement.style.opacity = 0; 
        setTimeout(function() {
            if (currentRoleIndex >= roles.length) {
                currentRoleIndex = 0; 
            }
            roleElement.textContent = roles[currentRoleIndex++]; 
            roleElement.style.opacity = 1; 
        }, 500); 
    }
  
    setInterval(updateRole, 2000); 
  
    
    updateRole();
  });

  function typeEffect(element, speed) {
    var text = element.innerHTML;
    element.innerHTML = "";

    var i = 0;
    var timer = setInterval(function() {
        if (i < text.length) {
            element.append(text.charAt(i));
            i++;
        } else {
            clearInterval(timer);
        }
    }, speed);
}