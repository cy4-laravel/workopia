<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::get('/', fn () => view('welcome'));

Route::get('/', function () {
    return view('welcome');
});


Route::get('/jobs', function() {
    return vieW('jobs.index');
})->name('jobs.index'); // example of route naming


Route::get('/jobs/create', function() {
    return vieW('jobs.create');
})->name('jobs.create'); // example of route naming
















// below are the routes we will never gonna use .. it is just a learning stuff



Route::get('/posts/{id}', function(string $id) {
    return 'POST '. $id;
})->where('id', '[0-9]+');

Route::get('/posts/{id}/comments/{commentId}', function(string $id, string $commentId) {
    return 'Post ' . $id . ' Comment ' . $commentId;
})->whereNumber('id')->whereAlpha('commentId');

// response helper [it can be accessible globally (no need to import anything)]
Route::get('/test', function(){
    return response()->json(['name' => 'john doe'])->cookie('name', 'adil doe');
});

// fetching that cookie
Route::get('/read-cookie', function(Request $request){
    $cookieValue = $request->cookie('name');
    // return $cookieValue;
    return response()->json(['cookie' => $cookieValue]);
});


// we can download files as shown below
Route::get('/download', function(){
    return response()->download(public_path('favicon.ico'));
});

// // request helper example
// Route::get('/tst', function(Request $request){
//     return [
//         'method' => $request->method(),
//         'url' => $request->url(),
//         'path' => $request->path(),
//         'fullUrl' => $request->fullUrl(),
//         'ip' => $request->ip(),
//         'userAgent' => $request->userAgent(),
//         'header' => $request->header()
//     ];
// });


// Query Params example below:
Route::get('/users', function(Request $request){
    return $request->except(['name']);
});


// Route::get('/test', function (){
//     $url = route('jobs'); // where as, jobs is the name of the route
//     return "<a href='$url'>Click here</a>";
// });


// JSON, if we are dealing with API, like react or veu, etc, 
// we can return json as below

Route::get('/api/users', function() {
    return [
        'name' => 'testing user',
        'email' => 'test@gmail.com'
    ];
});


Route::any('/submit', function() {
    return 'submitted';
});

// Route::match(['get', 'post'],'/submit', function() {
//         return 'submitted';
// });
    
// Route::post('/submit', function() {
//     return 'submitted';
// });

