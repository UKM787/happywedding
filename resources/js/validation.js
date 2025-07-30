import { extend, normalizeRules } from 'vee-validate';
import { alpha, alpha_dash, alpha_num, alpha_spaces, between, confirmed, digits, email, ext, image, max,max_value, mimes, min, min_value, numeric,regex,required,size } from 'vee-validate/dist/rules';

extend('required', {
  ...required,
  message: 'This field is required!'
});

extend('image', {
  ...image,
  message: 'This {field} must be a image!'
});

extend('mimes', {
  ...mimes,
 message: (name, placeholders) => {
  let message = [];
  for(let keys in placeholders){
    if(keys.length == 1){
      message.push(placeholders[keys].substring(placeholders[keys].lastIndexOf("/") + 1));
    }

  }
  message = message.join(', ')
  console.log(message);
    return `The image must be of type ${message}`;
  }
});

extend('size', {
  ...size,
  message: 'This field must be of {size} kb!'
});

extend('min', {
  ...min,
  message: 'This feild must have at least {length} charcters!'
});

extend('max', {
  ...max,
  message: 'This feild must be only {length} charcters!'
});

extend('alpha_num', {
  ...alpha_num,
  message: 'This feild must be in an alpha numeric format!'
});

extend('alpha_spaces', {
  ...alpha_spaces,
  message: 'This feild must only contains letter and spaces!'
});

extend('alpha', {
  ...alpha,
  message: 'This feild must be in letters!'
});

extend('email', {
  ...email,
  message: 'This feild must be an email!'
});

extend('numeric', {
  ...numeric,
  message: 'This feild must be a number!'
});

extend('digits', {
  ...digits,
  message: 'This feild must be {length} digits!'
});


// No message specified.
//extend('email', email);
//extend('alpha', alpha);
// extend('required', required);
