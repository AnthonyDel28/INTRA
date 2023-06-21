<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::check() ? Auth::user() : null;
            $notificationsCount = 0;
            $messagesCount = 0;

            if ($user) {
                $notificationsCount = DB::table('notifications')
                    ->where('read', 0)
                    ->where('user_id', $user->id)
                    ->count();
                $messagesCount = DB::table('ch_messages')
                    ->where('to_id', $user->id)
                    ->where('seen', 0)
                    ->selectRaw('COUNT(*) as count')
                    ->groupBy('from_id', 'to_id')
                    ->selectRaw('COUNT(*) as count')
                    ->get()
                    ->count();
            }
            $sections = DB::table('sections')->get();
            $languages = [
                'Bash',
                'C',
                'C#',
                'C++',
                'CSS',
                'Diff',
                'Go',
                'GraphQL',
                'HTML',
                'XML',
                'JSON',
                'Java',
                'JavaScript',
                'Kotlin',
                'Less',
                'Lua',
                'Makefile',
                'Markdown',
                'Objective-C',
                'PHP',
                'PHP Template',
                'Perl',
                'Plain text',
                'Python',
                'Python REPL',
                'R',
                'Ruby',
                'Rust',
                'SCSS',
                'SQL',
                'Shell',
                'Session',
                'Swift',
                'TOML',
                'INI',
                'TypeScript',
                'Visual Basic .NET',
                'WebAssembly',
                'YAML',
            ];

            $view->with('sections', $sections)
                ->with('languages', $languages)
                ->with('notificationsCount', $notificationsCount)
                ->with('messagesCount', $messagesCount);
        });
        View::composer('*', SuccessComposer::class);
    }
}
