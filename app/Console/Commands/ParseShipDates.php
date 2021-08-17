<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ParseShipDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:parse-shipdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Goes through the order table, pulling out the expected ship date from the comments and storing it in the shipdate_expected field';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        DB::statement('
UPDATE `sweetwater_test`
SET shipdate_expected = STR_TO_DATE(RTRIM(SUBSTRING(comments, POSITION("Expected Ship Date: " IN comments) + LENGTH("Expected Ship Date: "), POSITION("Expected Ship Date: " IN comments) + LENGTH("Expected Ship Date: ") + 8 - 1)), "%m/%d/%y")
WHERE comments LIKE "%Expected Ship Date: %";
        ');

        $this->info("Parsing complete.");
        return 0;
    }
}
