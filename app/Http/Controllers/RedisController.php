<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;

class RedisController extends Controller
{
    public function __construct()
    {
        $this->storage = Redis::Connection();
    }

    public function showArticle($id)
    {
        $this->storage->pipeline(function($pipe) use ($id) {
            $pipe->zIncrBy('articleViews', 1, "article:{$id}"); // Adds the view count into a sorted set
            // It's the equivalent of: "ZINCRBY key increment member". Key "articleViews" is the ZSet's name
            $pipe->incr("article:{$id}:views"); // Logs the view count as a simple string key-value pair
        });

        return $this->storage->get("article:{$id}:views");
    }
    public function popularityTally() 
    {
        $tally = $this->storage->zRevRange('articleViews', 0, -1);

        foreach ($tally as $article)
        {
            $id = str_replace('article:', '', $article);
            echo "Article {$id}. <br>";
        }
    }

    public function cachedDbRead()
    {
        DB::connection()->enableQueryLog();

        $articles = Cache::remember('articles_cache', 60, function() { // cache it for 60s
            return DB::table('article')->get();
        }); 

        $log = DB::getQueryLog();
        print_r($log);

        return $articles;      

        // The first time you visit http://127.0.0.1:8000/cached-db-read , you will see the DB log
        // The second time you visit it (within 60s), the DB log will be an empty array, because DB won't be accessed
        // https://laravel.com/docs/11.x/cache#retrieve-store  
    }

    public function throttledRoute() 
    {
        return "Unthrottled yet";
    }
    public function rateLimited() 
    {
        return "Not rate-limited yet";
    }
    public function rateLimited2(Request $request) 
    {
        $executed = RateLimiter::attempt(
            'key:' . ($request->user()?->id ?: $request->ip()), 
            3, // 3 per minute
            function() {
                // Do something
                return "Not rate-limited yet";
            }
        );

        if (!$executed)
        {
            return 'You reached your limit, please come back after a minute';
        }
    }
}
