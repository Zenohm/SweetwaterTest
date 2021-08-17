<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('data:parse-shipdate', function () {
    DB::statement('
UPDATE `sweetwater_test`
SET shipdate_expected = STR_TO_DATE(RTRIM(SUBSTRING(comments, POSITION("Expected Ship Date: " IN comments) + LENGTH("Expected Ship Date: "), POSITION("Expected Ship Date: " IN comments) + LENGTH("Expected Ship Date: ") + 8 - 1)), "%m/%d/%y")
WHERE comments LIKE "%Expected Ship Date: %";
        ');
})->purpose('Goes through the order table, pulling out the expected ship date from the comments and storing it in the shipdate_expected field');
