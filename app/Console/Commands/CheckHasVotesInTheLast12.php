<?php

namespace App\Console\Commands;

use App\Models\Server;
use Illuminate\Console\Command;

class CheckHasVotesInTheLast12 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Server:check_last_vote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Every 12 if server have at least 1 vote ';

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
        $date = new \DateTime();
        $date->modify('-12 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $servers = Server::where('created_at', '<', $formatted_date)->where('status',true)->where('hasBacklink', true)->where('admin_active', true)->where('server_owner_active', true)->get();
        foreach($servers as $server){
                if(count($server->vote) == 0){
                    $server->has_votes_in_the_last_12 = false;
                    $server->save();
                }
        }
    }
}
