<?php

namespace App\Console\Commands;

use App\Mail\PostSent;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\Website;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:subscriber';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending emails to subscribers';

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
     * @return void
     */
    public function handle()
    {
        $post        = Post::latest()->first();
        $subscribers = Subscriber::with([
            'websites' => function ($query) use ($post) {
                $query->where('website_id', $post->website_id);
            }
        ])->get();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->queue(new PostSent($post));
        }
    }
}
