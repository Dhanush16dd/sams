

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



    // muyltiple select check box 

    $(function () {
      setCheckboxSelectLabels();
  
      $(".toggle-next").click(function () {
          $(this).next(".checkboxes").slideToggle(400);
      });
  
      $(".ckkBox").change(function () {
          toggleCheckedAll(this);
          setCheckboxSelectLabels();
      });
  });
  
  function setCheckboxSelectLabels(elem) {
      var wrappers = $(".wrapper");
      $.each(wrappers, function (key, wrapper) {
          var checkboxes = $(wrapper).find(".ckkBox:checked");
          var label = $(wrapper).find(".checkboxes").attr("id");
          var prevText = "";
          var numberOfChecked = checkboxes.length;
  
          if (numberOfChecked >= 3) {
              // Disable further checks
              $(wrapper).find(".ckkBox:not(:checked)").prop("disabled", true);
              // Show warning message
              $(wrapper).find(".warning-message").text("You can only select up to 3 items.").show();
          } else {
              // Enable all checkboxes
              $(wrapper).find(".ckkBox").prop("disabled", false);
              // Hide warning message
              $(wrapper).find(".warning-message").hide();
          }
  
          $.each(checkboxes, function (i, checkbox) {
              var button = $(wrapper).find("button");
              var text = $(checkbox).next().html();
              var btnText = prevText + text;
              if (numberOfChecked >= 3) {
                  btnText = numberOfChecked + " " + label + " selected";
              }
              $(button).text(btnText);
              prevText = btnText + ", ";
          });
      });
  }
  
  function toggleCheckedAll(checkbox) {
      var apply = $(checkbox).closest(".wrapper").find(".apply-selection");
      apply.fadeIn("slow");
  
      var val = $(checkbox).closest(".checkboxes").find(".val");
      var all = $(checkbox).closest(".checkboxes").find(".all");
      var ckkBox = $(checkbox).closest(".checkboxes").find(".ckkBox");
  
      if (!$(ckkBox).is(":checked")) {
          $(all).prop("checked", true);
          return;
      }
  
      if ($(checkbox).hasClass("all")) {
          $(val).prop("checked", false);
      } else {
          $(all).prop("checked", false);
      }
  }
  
