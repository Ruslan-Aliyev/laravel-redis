
## Tutorials

- Redis: https://www.youtube.com/playlist?list=PL4cUxeGkcC9h3V2eqhi8rRdIDJshP-b4P
- Redis & Laravel: https://www.youtube.com/playlist?list=PLXM5y5j_b0mMdVF5p_2ug_b5tWqah_tfJ

Then Install & Setup Redis

```
REDIS_HOST=172.17.11.22 # WSL's IP
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_CLIENT=predis
```

`composer require predis/predis`

Check the routes: `/check-redis` and `/test-redis`

See web route, RedisController & RouteServiceProvider to see the things that can be done

# For cache

`CACHE_DRIVER=redis`

- https://laravel.com/docs/11.x/cache
- Cache strategies: https://redis.io/blog/three-ways-to-maintain-cache-consistency

# Rate Limiting

- RateLimiter has more fine-grained control
- RateLimiter can be used anywhere in the code. throttle is just a middleware
- throttle takes precedence over RateLimiter if both are used  

- https://www.youtube.com/watch?v=vrLcCxWlxOk
- https://stackoverflow.com/questions/43058219/disable-rate-limiter-in-laravel
- https://www.cloudways.com/blog/laravel-and-api-rate-limiting/
- https://www.youtube.com/watch?v=TQSDi3e0TxU
- https://laravel.com/docs/11.x/rate-limiting
- https://www.solo.io/topics/rate-limiting
- See also: https://github.com/GrahamCampbell/Laravel-Throttle

# Install/Setup

- https://stackoverflow.com/questions/77347654/how-do-i-install-redis-and-the-phpredis-extension-in-laravel
- https://www.techalyst.com/posts/install-and-configure-redis-server-for-laravel

## Install/Setup on Windows

- https://github.com/atabegruslan/Others/blob/master/Storage/redis-windows.md
- https://gist.github.com/lnfel/ab04028d6b115304ca5daef145710ac0

# Todo

- https://viblo.asia/p/redis-sentinel-la-cai-gi-m68Z0eaMlkG
