<section class="aesop-stories-newsletter">
	<h3>Share this Story</h3>
	<p>Be social. Be happy.</p>
	<div class="aesop-stories-social">
		<a href=""><i class="dashicons dashicons-twitter"></i></a>
		<a href=""><i class="dashicons dashicons-facebook"></i></a>
	</div>
	<h3>Get the Latest</h3>
	<p>Recieve updates, new stories, and more.</p>
	<div class="aesop-stories-newsletter-inner">
   <form action="https://madmimi.com/signups/subscribe/74148" id="mad_mimi_signup_form" method="post" target="_blank">
       <div class="mimi_field required">
          	<input id="signup_email" name="signup[email]" type="text" data-required-field="This field is required" placeholder="you@example.com"/>
       </div>
       <div>
          <input type="submit" class="submit" value="Subscribe" id="webform_submit_button" data-default-text="Subscribe" data-submitting-text="Sending…" data-invalid-text="← You forgot to enter your email!" data-choose-list="↑ Choose a list">
       </div>
    </form>
<script type="text/javascript">
(function() {
  var form = document.getElementById('mad_mimi_signup_form'),
      submit = document.getElementById('webform_submit_button'),
      validEmail = /.+@.+\..+/,
      isValid;
      
  form.onsubmit = function(event) {
    validate();
    if(!isValid) {
      revalidateOnChange();
      return false;
    }
  };
  
  function validate() {
    isValid = true;
    emailValidation();
    fieldAndListValidation();
    updateFormAfterValidation();
  }

  function emailValidation() {
    var email = document.getElementById('signup_email');
    if(!validEmail.test(email.value)) {
      textFieldError(email);
      isValid = false;
    } else {
      removeTextFieldError(email);
    }
  }

  function fieldAndListValidation() {
    var fields = form.querySelectorAll('.mimi_field.required');
    for(var i = 0; i < fields.length; ++i) {
      var field = fields[i],
          type  = fieldType(field);
      if(type == 'checkboxes' || type == 'radio_buttons') {
        checkboxAndRadioValidation(field);
      } else {
        textAndDropdownValidation(field, type);
      }
    }
  }

  function fieldType(field) {
    var type = field.querySelectorAll('.field_type');
    if(type.length > 0) {
      return type[0].getAttribute('data-field-type');
    } else if(field.className.indexOf('checkgroup') >= 0) {
      return 'checkboxes';
    } else {
      return 'text_field';
    }
  }

  function checkboxAndRadioValidation(field) {
    var inputs   = field.getElementsByTagName('input'),
        selected = false;
    for(var i = 0; i < inputs.length; ++i) {
      var input = inputs[i];
      if((input.type == 'checkbox' || input.type == 'radio') && input.checked) selected = true;
    }
    if(selected) {
      field.className = field.className.replace(/ invalid/g, '');
    } else {
      if(field.className.indexOf('invalid') == -1) field.className += ' invalid';
      isValid = false;
    }
  }

  function textAndDropdownValidation(field, type) {
    var inputs = field.getElementsByTagName('input');
    for(var i = 0; i < inputs.length; ++i) {
      var input = inputs[i];
      if(input.name.indexOf('signup') >= 0) {
        if(type == 'text_field') {
          textValidation(input);
        } else {
          dropdownValidation(field, input);
        }
      }
    }
    htmlEmbedDropdownValidation(field);
  }

  function textValidation(input) {
    if(input.id == 'signup_email') return;
    var val = input.value;
    if(val == '') {
      textFieldError(input);
      isValid = false;
      return;
    } else {
      removeTextFieldError(input)
    }
  }

  function dropdownValidation(field, input) {
    var val = input.value;
    if(val == '') {
      if(field.className.indexOf('invalid') == -1) field.className += ' invalid';
      onSelectCallback(input);
      isValid = false;
      return;
    } else {
      field.className = field.className.replace(/ invalid/g, '');
    }
  }

  function htmlEmbedDropdownValidation(field) {
    var dropdowns = field.querySelectorAll('.mimi_html_dropdown');
    for(var i = 0; i < dropdowns.length; ++i) {
      var dropdown = dropdowns[i],
          val      = dropdown.value;
      if(val == '') {
        if(field.className.indexOf('invalid') == -1) field.className += ' invalid';
        isValid = false;
        dropdown.onchange = validate;
        return;
      } else {
        field.className = field.className.replace(/ invalid/g, '');
      }
    }
  }

  function textFieldError(input) {
    input.className   = 'required invalid';
    input.placeholder = input.getAttribute('data-required-field');
  }

  function removeTextFieldError(input) {
    input.className   = 'required';
    input.placeholder = '';
  }

  function onSelectCallback(input) {
    if(typeof Widget != 'undefined' && Widget.BasicDropdown != undefined) {
      var dropdownEl = input.parentNode,
          instances  = Widget.BasicDropdown.instances;
      for(var i = 0; i < instances.length; ++i) {
        var instance = instances[i];
        if(instance.wrapperEl == dropdownEl) {
          instance.onSelect = validate;
        }
      }
    }
  }

  function updateFormAfterValidation() {
    form.className   = isValid ? '' : 'mimi_invalid';
    submit.value     = submitButtonText();
    submit.disabled  = !isValid;
    submit.className = isValid ? 'submit' : 'disabled';
  }

  function submitButtonText() {
    var invalidFields = document.querySelectorAll('.invalid'),
        text;
    if(isValid || invalidFields == undefined) {
      text = submit.getAttribute('data-default-text');
    } else {
      if(invalidFields.length > 1 || invalidFields[0].className.indexOf('checkgroup') == -1) {
        text = submit.getAttribute('data-invalid-text');
      } else {
        text = submit.getAttribute('data-choose-list');
      }
    }
    return text;
  }

  function revalidateOnChange() {
    var fields = form.querySelectorAll(".mimi_field.required");
    for(var i = 0; i < fields.length; ++i) {
      var inputs = fields[i].getElementsByTagName('input');
      for(var j = 0; j < inputs.length; ++j) {
        inputs[j].onchange = validate;
      }
    }
  }
})();
</script>
	</div>
</section>