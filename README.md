<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Laravel Bulls and Cows Game

Implementation a simple game buls and cows [wiki](https://bg.wikipedia.org/wiki/%D0%91%D0%B8%D0%BA%D0%BE%D0%B2%D0%B5_%D0%B8_%D0%BA%D1%80%D0%B0%D0%B2%D0%B8)  which allow a single human player to play a one-sided game against the computer.

This project was created with Laravel 8, Bootstrap 4, JQuery, Blade Template Engine and AJAX.

Below you will find some information about this project

How to start:

1.Clone this repository: git clone https://github.com/DimovDev/Bulls-and-cows.git

2.Install all dependencies: composer install

3.Start application: php artisan serve

4.Open in your browser http://localhost:8000/

5.Enjoy the game

How to play:

Bulls and cows is a traditional game in which you have to guess pre-generated combination of numbers. The program generates combination of 4 unique numbers (the same number can't be in more than one place at a time, zero is included). After you start the game, you must try to guess the combination, result will be presented in the form of number of bulls and cows. Bull means that you guessed the number and the corresponding position. Cows mean that you only guessed the number, but it’s not in the correct position. The game ends when you guess all numbers and their positions, which is equal to 4 bulls. If you decide to surrender, you can choose “Give Up” where you will see what was the combination. Have fun!

Live demo can be found here https://dimovdev.ml
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
