### FILES AND FUNCTION ON PROJECT ###

1. By opening the project it run through routes where the file path is root/routes/web.php
    It render the user the repested triggered function where the home function goes to the file App\Http\Controllers\MailGunController calls the User function.

    On User function the data are we got form MAILGUN templated we created on the MAILGUN through the API which they provided and rendered the data to view page(admin.user) 

    The USERBlade contains a form that has first name , last name , and the template names we got from the api. IF we filled that filled and clicked on submit it triggers the store user function .  

    It render the user the repested triggered function where the home function goes to the file App\Http\Controllers\MailGunController calls the Store function.

    On this function it used to validate the data are empty are not. then will get the template where user choosed to send .

    Store the user data on USER table with the help of APP/Model/ USER.php file it interact with database. 

    After these the mail will be sent to the user . before that need to add the user mail id $user['email']  on this flied to recieve mail. 
