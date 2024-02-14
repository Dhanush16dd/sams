const navigateToFormStep = (stepNumber) => {
    
    document.querySelectorAll(".form-step").forEach((formStepElement) => {
        formStepElement.classList.add("d-none");
    });
    
    document.querySelectorAll(".form-stepper-list").forEach((formStepHeader) => {
        formStepHeader.classList.add("form-stepper-unfinished");
        formStepHeader.classList.remove("form-stepper-active", "form-stepper-completed");
    });
    
    document.querySelector("#step-" + stepNumber).classList.remove("d-none");
    
    const formStepCircle = document.querySelector('li[step="' + stepNumber + '"]');
    
    formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-completed");
    formStepCircle.classList.add("form-stepper-active");
  
    for (let index = 0; index < stepNumber; index++) {
        
        const formStepCircle = document.querySelector('li[step="' + index + '"]');
       
        if (formStepCircle) {
           
            formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-active");
            formStepCircle.classList.add("form-stepper-completed");
        }
    }
};

document.querySelectorAll(".btn-navigate-form-step").forEach((formNavigationBtn) => {
   
    formNavigationBtn.addEventListener("click", () => {
       
        const stepNumber = parseInt(formNavigationBtn.getAttribute("step_number"));
       
        navigateToFormStep(stepNumber);
    });
});

// form validations

    function validateForm() {
      // Reset error messages
      document.querySelectorAll('.error-message').forEach(function(element) {
        element.textContent = '';
      });

      var isValid = true;

      // Get input values
      var name = document.forms["admissionForm"]["name"].value;
      var phoneNum = document.forms["admissionForm"]["phone_num"].value;
      var email = document.forms["admissionForm"]["email"].value;
      var insta = document.forms["admissionForm"]["insta"].value;
      var courses = document.forms["admissionForm"]["courses"].value;
      var state = document.forms["admissionForm"]["state"].value;
      var city = document.forms["admissionForm"]["city"].value;
      var fatherName = document.forms["admissionForm"]["father_name"].value;
      var fatherPhone = document.forms["admissionForm"]["father_phone_num"].value;
      var motherName = document.forms["admissionForm"]["mother_name"].value;
      var motherPhone = document.forms["admissionForm"]["mother_phone_num"].value;
      var highestQualification = document.forms["admissionForm"]["highest_qualification"].value;

      // Check if required fields are empty
      if (name == "") {
        addErrorMessage('name', 'Name is required');
        isValid = false;
      }

      if (phoneNum == "") {
        addErrorMessage('phone_num', 'Phone Number is required');
        isValid = false;
      }

      if (email == "") {
        addErrorMessage('email', 'Email is required');
        isValid = false;
      } else {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
          addErrorMessage('email', 'Invalid email format');
          isValid = false;
        }
      }

      if (insta == "") {
        addErrorMessage('insta', 'Instagram Link is required');
        isValid = false;
      }

      if (courses == "") {
        addErrorMessage('courses', 'Course Details is required');
        isValid = false;
      }

      if (state == "") {
        addErrorMessage('state', 'State is required');
        isValid = false;
      }

      if (city == "") {
        addErrorMessage('city', 'City / Town / Village is required');
        isValid = false;
      }

      if (fatherName == "") {
        addErrorMessage('father_name', "Father's Name is required");
        isValid = false;
      }

      if (fatherPhone == "") {
        addErrorMessage('father_phone_num', "Father's Phone Number is required");
        isValid = false;
      }

      if (motherName == "") {
        addErrorMessage('mother_name', "Mother's Name is required");
        isValid = false;
      }

      if (motherPhone == "") {
        addErrorMessage('mother_phone_num', "Mother's Phone Number is required");
        isValid = false;
      }

      if (highestQualification == "") {
        addErrorMessage('highest_qualification', "Highest Qualification is required");
        isValid = false;
      }

      return isValid;
    }

    function addErrorMessage(fieldName, message) {
      var inputField = document.getElementsByName(fieldName)[0];
      var errorMessageDiv = document.createElement('div');
      errorMessageDiv.textContent = message;
      errorMessageDiv.className = 'error-message';
      inputField.parentNode.appendChild(errorMessageDiv);
    }
