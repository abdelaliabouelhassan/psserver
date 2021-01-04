<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Server;
class updateVote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vote:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Votes Every 10min';

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

        $current_servers = Server::orderBy('realtimeVote', 'desc')->where('status', 'true')->get();
        $previous_servers = Server::orderBy('previousVote', 'desc')->where('status', 'true')->get();

        foreach ($current_servers as $current_server_pos => $current_server) {
            $up_down = 'down';

            foreach ($previous_servers as $previous_server_pos => $previous_server) {
                // If the current position of the server is lower than the
                // positions of the previous servers, which do not have the same ID,
                // we can assume that the server is now at a higher position.
                if ($current_server_pos < $previous_server_pos) {
                    $up_down = 'up';
                    break;
                }

                // If we found the current server in the array of previous servers.
                if ($current_server->id === $previous_server->id) {
                    // We can assume that it is lower or the same.
                    $up_down = $current_server_pos > $previous_server_pos  ? 'down' : 'stable';

                    break;
                }
            }

            $current_server->upDown = $up_down;
            $current_server->previousVote = $current_server->realtimeVote;
            $current_server->save();
        }


     
    }
}
