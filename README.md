## First Step
Add email SMTP credentials:

MAIL_MAILER=smtp  
MAIL_HOST=smtp.mailtrap.io  
MAIL_PORT=2525  
MAIL_USERNAME=  
MAIL_PASSWORD=  
MAIL_ENCRYPTION=tls  
MAIL_FROM_ADDRESS=dev@toplist  
MAIL_FROM_NAME="${APP_NAME}"

## Contact Email
Set the contact email:

App_email="youremail@test.com"

## reCAPTCHA
Add reCAPTCHA credentials:

INVISIBLE_RECAPTCHA_SITEKEY=
INVISIBLE_RECAPTCHA_SECRETKEY=

Add `sitekey` in `resources/js/store/store.js`:

const sitekey = 'your_recaptcha_sitekey';

## Language
English and French languages are supported. Vue.js files are in `resources/js/lang/`, and Laravel files are in `resources/lang/`.

## Seed Database
Run:

php artisan db:seed

## Login Credentials
- Admin:  
  'username': 'admin',  
  'password': 'password'

- User:  
  'username': 'user',  
  'password': 'password'
