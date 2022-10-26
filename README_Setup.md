### How do I get set up? ###

1. Create login on Mailgun for free.
2. give the mail for auth on doamin stmp and aip key details. we can get form domains submenu. ON Template submenu we have created mail templates to be used. 
3. set .env database name as task
4. Set the Mailgun details on .env , and set the host on config/Mail.php 
5. run php artisan migrate
6. run composer update
7. set the mailgun details as  required data for MAILER 
8. Set TO EMAIL ADDERESS On (App\Http\Controllers\MailGunController ) file on User function where variable is decalered as mailto:($user['email']);
9. Run php artisan serve project will be started on brower.

env mailer configuration

MAIL_MAILER=mailgun
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=postmaster@sandboxcec62448d7c84db0833ee6370077c724.mailgun.org
MAIL_PASSWORD=2e33ec5d0240915584f9f38045d2adaf-8845d1b1-aee43afd
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=msanjai3107@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
MAILGUN_SECRET=b355dbbb212ccaa7882f09b00756f084-8845d1b1-463901f2
MAILGUN_DOMAIN=sandboxcec62448d7c84db0833ee6370077c724.mailgun.org
MAILGUN_ENDPOINT=api.mailgun.net