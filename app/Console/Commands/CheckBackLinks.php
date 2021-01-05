<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Server;
use App\Mail\ServerBackLink;
use Illuminate\Support\Facades\Mail;

class CheckBackLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backlinks:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Server If They Have Backlinks';

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
       
       $servers = Server::where('hasBacklink',true)->where('admin_active', true)->where('server_owner_active', true)->get();
       foreach($servers as $server){
            //check backlinks
            $url =  request()->server('SERVER_NAME') . '/' . $server->slug;
            if (!checkBackLink($server->url, $url)) {
                //status => false
                    $server->hasBacklink = false;
                    $server->save();
                //send email 
                $back_link = url('/serverdetails/' . $server->slug);
                Mail::to($server->user->email)->send(new ServerBackLink($back_link));
            }

       }

    
    }
}
