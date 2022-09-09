

## About Developer Test

Your Assignment

Unlocking Achievements

You need to write the code that listens for user events and unlocks the relevant achievement. 

For example;

    • When a user writes a comment for the first time they unlock the “First Comment Written” achievement.

    • When a user has already unlocked the “First Lesson Watched” achievement by watching a single video and then watches another four videos they unlock the “5 Lessons Watched” achievement.


AchievementUnlocked Event

When an achievement is unlocked an AchievementUnlocked event must be fired with a payload of; 

achievement_name (string)
user (User Model)


BadgeUnlocked Event

When a user unlocks enough achievement to earn a new badge a BadgeUnlocked event must be fired with a payload of; 

badge_name (string)
user (User Model)



Achievements Endpoint

There is an endpoint `users/{user}/achievements` that can be found in the ‘web’ routes file, this must return the following;

unlocked_achievements (string[ ]) 
An array of the user’s unlocked achievements by name

next_available_achievements (string[ ])
An array of the next achievements the user can unlock by name. 

Note: Only the next available achievement should be returned for each group of achievements. 

Example: If the user has unlocked the “5 Lessons Watched” and “First Comment Written” achievements only the “10 Lessons Watched” and “3 Comments Written“ achievements should be returned.

current_badge (string) 
The name of the user’s current badge.

## Installation
1. git clone or zip download
2. composer install
3. set .evn
4. To run all tests <code>clear && vendor/bin/phpunit  </code>
5. To run tests  by name <code>clear && vendor/bin/phpunit --filter test_name </code>
6. Api endpoints can be consumed from route/api.php
7. php artisan migrate:fresh --seed
8. php artisan serve 
9. visit http://127.0.0.1:8000/users/4/achievements 
10 view response.
