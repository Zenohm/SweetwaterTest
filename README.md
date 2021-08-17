# Greetings!

Hello Sweetwater reviewers of this code!

This project was generated using the laravel/laravel template as a foundation.

The first commit lays out all code which was present before I began my work.

# Time Analysis

Looking at my commit history, I got the initial commit in around 1:16 PM and got the final commit in around 6:14 PM.

Total time: 4 hours and 58 minutes.

Breakdown:
- 1:16 PM - 1:50 PM (34m) = Initialization and data seeding
- 1:50 PM - 2:16 PM (26m) = Creating an MVP to view data
- 2:16 PM - 4:29 PM (2h 13m) = Task 1
- 4:29 PM - 5:48 PM (1h 19m) = Task 2
- 5:48 PM - 6:14 PM (26m) = Updating the readme and minor cleanup.

# Caveats

* This is my first time since college (Feb 8th, 2018) that I have touched PHP
* I have never used Laravel or Eloquent before.
* Because of the above I spent most of the time exploring and manually testing, no time unit testing.
* I have left logic and configuration inside the OrderController. If this were to be unit-tested, I'd pull that out into a service where it can be tested in isolation.
* I have decided to not take time to remove unnecessary code added by the initial project template.

# Getting it Running

* Ensure MySQL is setup and running (I used XAMPP).
* Create the `sweetwatertest` database.
* Ensure PHP and Laravel are installed.
* Run `php artisan migrate --seed` to populate the database.
* Run `php artisan serve`.
* Navigate to http://localhost:8000 to view the running project.
* Once you have looked over the data, run `php artisan data:parse-shipdate` to update the ship dates as required by Task 2.
* Look back over the data to see the ship dates are now populated.
