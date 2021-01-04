<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RestVote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vote:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Votes Every 14days';

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
    public function handle()
    {
        
        DB::table('servers')->update(['realtimeVote' => 0, 'previousVote' => 0, 'upDown' => 'stable']);
        DB::table('votes')->delete();
        
    }
}
