

## first step
add email smtp  credentials 

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=dev@toplist
MAIL_FROM_NAME="${APP_NAME}"

##and this 
App_email="youremail@test.com"  ##this for contact when a user tries to contact you put your email that will receive a message .

and recaptcha 
INVISIBLE_RECAPTCHA_SITEKEY=6LeCNhwaAAAAAHLVfJBdyleRSh7bRmYuvolBuycB
INVISIBLE_RECAPTCHA_SECRETKEY=6LeCNhwaAAAAACh31QVu_Fve05EQqn7p9iOWNQmU

##for key you need to go to 'resources/js/store/store.js' and put it in this variable => sitekey

##for the language we have English and french 
##go to 'resources/js/lang/ => this for vue js && for laravel go to 'resources/lang/
## i added only English and french  because that what i know 


##seed the database => php artisan db:seed
## login credentials
admin => {
		'username'=>'admin',
		'password'=>'password'
}
user => {
	'username'=>'user',
	 'password'=>'password'
}

