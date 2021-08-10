<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class PopulateShipdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
UPDATE `sweetwater_test`
SET shipdate_expected = STR_TO_DATE(RTRIM(SUBSTRING(comments, POSITION("Expected Ship Date: " IN comments) + LENGTH("Expected Ship Date: "), POSITION("Expected Ship Date: " IN comments) + LENGTH("Expected Ship Date: ") + 8 - 1)), "%m/%d/%y")
WHERE comments LIKE "%Expected Ship Date: %";
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
