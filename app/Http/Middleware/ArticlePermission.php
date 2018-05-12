<?php

namespace App\Http\Middleware;

use App\Article;
use Closure;

class ArticlePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $article_id = $request->route('article_id') ?
            $request->route('article_id') :
            Article::slug($request->route('article_slug'))->first(['id'])->id;

        $permission = \App\ArticlePermission::where('article_id', $article_id)
            ->where('user_id', auth()->user()->user_id)
            ->count();

        if ($permission < 1) {

            return response()->json([
                'header' => 'Access Denied',
                'message' => 'You cannot reach this article',
                'status' => 'error'
            ], 401);
        }

        return $next($request);
    }
}
