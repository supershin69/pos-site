<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;
use Illuminate\Support\Facades\Route;

require_once __DIR__.'/admin.php';
require_once __DIR__.'/user.php';

Route::get('/', function () {
    return redirect('/register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//SOCIAL LOGIN

use Laravel\Socialite\Socialite;

Route::get('/auth/{provider}/redirect', [SocialLoginController::class, 'redirect'] )->name('social#redirect');

Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback'] )->name('social#callback');

Route::get('/php-info', function() {
    ob_start();
    phpinfo();
    return response(ob_get_clean());
});

Route::get("test-ssl", function() {
    echo "PHP Version: " . PHP_VERSION . "<br>";
    echo "Loaded php.ini: " . php_ini_loaded_file() . "<br>";
    echo "curl.cainfo: " . ini_get('curl.cainfo') . "<br>";
    echo "openssl.cafile: " . ini_get('openssl.cafile') . "<br>";
    echo "CA File exists: " . (file_exists(ini_get('curl.cainfo')) ? 'YES' : 'NO') . "<br>";
});

Route::get("test-dd", function() {
    dd('Yayy');
});
