//create mjproject Database
// step 1 migrate all table
php artisan migrate
// step 2 seeder for table data
php artisan db:seed --class=admin_seeder
php artisan db:seed --class=user_seeder
php artisan db:seed --class=incharge_seeder
php artisan db:seed --class=department_seeder
php artisan db:seed --class=complaint_seeder

//id password
//for admin
admin@gmail.com
admin@123
//for user X is a number for example user1,user2...userX
userX@gmail.com
userX@123
//for incharge X is a number for example incharge1,incharge2...inchargeX
inchargeX@gmail.com
inchargeX@123
