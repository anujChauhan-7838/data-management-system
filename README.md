# About the Multi Auth laravel 8 admin panel with OTP verification

This is the admin project built on laravel 8 with multi authentication and mutli admin roles with OTP verification at the time of login.


# Steps to set up the project 

1. clone the project via HTTPS OR SSH OR CLI 
    for example - using HTTPS Method , use below command to clone the project
    # git clone https://github.com/anujChauhan-7838/data-management-system.git multi-auth-admin-panel
    
    
2. After the clone install the dependencies using the following command 
   # compose install
   
3. Now all the dependencies has been installed now follow the next step 

4. change file name from .env.example to .env . the file is located on the root of folder.

5. Now Generate the secret key using the below command 
   # php artisan key:generate
   
6. Now the change the database and mail configuration in  .env file 

7. Greate you are almost done the setup . now some more database set is required so follow the following steps

8. Run the database migration using the below command
  # php artisan migrate
 
9.Now run the database seeder which will insert intial data in the database . use following command to insert data in the tables
  # php artisan db:seed
  
  
  
  Hurray! you have been done the setup . now it time to play with admin panel. just run the command to open admin panel in the browser 
  
  # php artisan serve 
  
  Open the below url in the broswer 
  # htt://127.0.0.1:8000
  
  yes it is now done . click on login page and enter the crendetial given below 
  
  # Username/Email -> sm.anuj.chauhan@yopmail.com
  # password       -> 12345678
  
  After that it is ask a OTP (One Time Password ) . which has been sent the yopmail mail id (sm.anuj.chauhan@yopmail.com).
  just open the url(https://yopmail.com/en/) and enter your email name (sm.anuj.chauhan) here you will see the one time password mail . if you get it then copy and paste in the verify OTP section . Otherwise you can find it from dabatase if you are developer. just go to database and click on users table and get the OTP from otp column and copy an paste it.
  
  
  Done .   Enjoy your data ..
  
  Let me know if any error you guys are facing . i will happy to assist  you.
    
