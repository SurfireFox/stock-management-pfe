<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategorieController,
    CommandeController,
    HomeController,
    ProduitController,
    ShopController,
    Auth\LoginController,
    Auth\RegisterController
};
use App\Http\Controllers\Auth\UserManagementController;


// Public routes
Route::get('/', [HomeController::class, 'home']);

Route::get('/shop', [ShopController::class, 'shop']);
Route::get('/produitdetail/{id}', [ProduitController::class, 'show']);
Route::view('/about', 'about');
Route::view('/contact', 'contact');

// Guest-only routes (login & registration)
Route::middleware(['guest', 'preventBack'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout route
Route::middleware('auth')->post('/logout', [LoginController::class, 'logout'])->name('logout');

// Logged-in user routes
Route::middleware('auth')->group(function () {
    Route::view('/panier', 'panier');
    Route::view('/checkout', 'checkout');
    Route::post('/checkout', [CommandeController::class, 'checkout'])->name('checkout');
});

// User Dashboard
Route::middleware(['auth', 'role:2'])->get('/userdashboard', function () {
    $user = auth()->user();
    $commands = $user->commandes()->get();

    return view('userpages.userdashboard', [
        'totalcommands' => $commands->count(),
        'completedcommands' => $commands->where('status', 'completed')->count(),
        'pendingcommands' => $commands->where('status', 'pending')->count(),
        'commands' => $commands
    ]);
})->name('userdashboard');

// User Profile
Route::middleware(['auth', 'role:2'])->get('/userprofile', function () {
    $user = auth()->user();
    $commands = $user->commandes()->get();

    return view('userpages.userprofile', [
        'totalOrders' => $commands->count(),
        'completedOrders' => $commands->where('status', 'completed')->count(),
        'pendingOrders' => $commands->where('status', 'pending')->count(),
        'activities' => $user->activities()->latest()->take(5)->get() ?? []
    ]);
})->name('userprofile');

// Admin routes (role = 1)
Route::prefix('admin')->middleware(['auth', 'role:1'])->group(function () {

    // produit Routes
    Route::get('/dashboard', [ProduitController::class, 'adminproduit'])->name('produits');
    Route::post('/produit', [ProduitController::class, 'create'])->name('produit.store');
    Route::delete('/produit/{id}', [ProduitController::class, 'delete'])->name('produit.delete');
    Route::post('/produit/update/{id}', [ProduitController::class, 'update'])->name('produit.update');

    // Categorie Routes
    Route::get('/categorie', [CategorieController::class, 'categorie'])->name('categorie');
    Route::post('/categorie', [CategorieController::class, 'create'])->name('categorie.store');
    Route::delete('/categorie/{id}', [CategorieController::class, 'delete'])->name('categorie.delete');
    Route::post('/categorie/update/{id}', [CategorieController::class, 'update'])->name('categorie.update');

    // commands
    // Route::get('/usersorders', [CommandeController::class, 'commande'])->name('commande');
    Route::get('/usersorders', function () {
    return view('admindashboard.usersorders');
    });
    Route::get('/usersorders', [CommandeController::class, 'commande'])->name('admin.usersorders');
    Route::post('/usersorders/update/{id}', [CommandeController::class, 'update'])->name('usersorders.update');
    Route::delete('/usersorders/{id}', [CommandeController::class, 'annulercommande'])->name('usersorders.delete');

    // produit creation
    Route::get('/create', function() {
        $Categories = \App\Models\Categorie::all();
        return view('admindashboard.productcreation', compact('Categories'));
    })->name('createproduit');
    Route::post('/create', [ProduitController::class, 'create'])->name('createproduit');

    // User Management (Controller-based) ✅
    Route::get('/users', [UserManagementController::class, 'index'])->name('indexusers');
    Route::get('/users/create', function() {
        $roles = \App\Models\Role::all();
        return view('admindashboard.userscreate', compact('roles'));
    })->name('createusers');
    Route::post('/users/create', [\App\Http\Controllers\Auth\UserManagementController::class, 'store'])->name('storeusers');
    Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('editusers');
    Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('updateusers');
    Route::delete('/users/{user}/delete', [UserManagementController::class, 'destroy'])->name('destroyusers');

    // Admin profile & history
    Route::view('/history', 'admindashboard.usershistory')->name('history');
    Route::view('/profile', 'admindashboard.profile')->name('profile');
    Route::put('/profile/update', [UserManagementController::class, 'updateProfile'])->name('admin.profile.update');
    Route::put('/profile', [UserManagementController::class, 'changePassword'])->name('admin.profile.changePassword');

    // Admin Orders Management (usersorders)
    // Route::get('/usersorders', [CommandeController::class, 'adminOrders'])->name('admin.orders');
    // Route::get('/usersorders/{commande}', [CommandeController::cla²&class, 'view'])->name('commande.view');
    // Route::get('/usersorders/{commande}/edit', [CommandeController::class, 'edit'])->name('commande.edit');
    // Route::delete('/usersorders/{commande}', [CommandeController::class, 'destroy'])->name('commande.delete');

        // Profile view and update
        Route::get('/profile', function () {
            $stats = [
                'products_added' => \App\Models\Produit::count(),
                'orders_processed' => \App\Models\Commande::where('status', 'completed')->count(),
                'users_managed' => \App\Models\User::where('role_id', 2)->count()
            ];
            return view('admindashboard.profile', compact('stats'));
        })->name('admin.profile');
});
