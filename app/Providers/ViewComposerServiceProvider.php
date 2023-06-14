<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
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
                ->with('languages', $languages);
        });
    }
}
