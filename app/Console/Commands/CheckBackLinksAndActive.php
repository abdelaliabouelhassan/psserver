<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Server;

class CheckBackLinksAndActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backlink:active';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check The Serve if have backlink and active';

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
        $servers = Server::where('hasBacklink', false)->where('admin_active',true)->where('server_owner_active', true)->get();
        foreach ($servers as $server) {
            //check backlinks
            $url =  request()->server('SERVER_NAME') . '/' . $server->slug;
            if (!checkBackLink($server->url, $url)) {
                //status => false
                $server->hasBacklink = false;
                $server->save();
          
            }
           
        }
    }
}
