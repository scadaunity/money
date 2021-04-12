<?php
// MyVendor\formulario-contato\src\routes\web.php
Route::get('contato', function(){
    return 'Hello World do seu Pacote!';
});

Route::get('money', function(){
  echo "Money";
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
