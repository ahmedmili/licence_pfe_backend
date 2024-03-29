<?php




use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\SqlImportController;
use App\Models\Partner;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

function common(string $scope)
{
    Route::post('register', [AuthController::class, 'register']);
    Route::put('passwordeux', [AuthController::class, 'updatePasswordeux']);
    Route::put('passwordpartner', [AuthController::class, 'updatePassworPartner']);
    Route::post('registerpartner', [PartnerController::class, 'store']);
    Route::post('login', [AuthController::class, 'login']);



    Route::middleware(['auth:sanctum', $scope])->group(
        function () {
            Route::get('commandes', [CommandController::class, 'index']);
            Route::get('commande/{id}', [CommandController::class, 'commande']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('user', [AuthController::class, 'user']);
            Route::put('users/info', [AuthController::class, 'updateInfo']);
        }
    );
}

//admin
Route::prefix('admin')->group(function () {
    common('scope.admin');
    Route::middleware(['auth:sanctum', 'scope.admin'])->group(function () {



        // role management
        Route::put('addRole', [UserController::class, "addRole"]);

        //Boxs Management
        Route::apiResource('boxs', BoxController::class);
        Route::get('searchBoxs', [BoxController::class, 'searchBoxs']);
        Route::get('boxs/boxdetails/{id}', [BoxController::class, 'boxdetails']);
        Route::get('searchBox', [BoxController::class, 'searchBox']);
        Route::get('filterboxs', [BoxController::class, 'filterBoxs']);
        Route::post('updateBox/{id}', [BoxController::class, 'updateBox']);
        Route::put('boxs/status/{id}', [BoxController::class, 'updateBoxStatus']);
        Route::get('boxestotal', [BoxController::class, 'total']);
        Route::get('getTotalBoxCounts', [BoxController::class, 'getTotalBoxCounts']);

        //Users Management
        Route::apiResource('users', UserController::class);
        Route::get('getuser/{id}', [UserController::class, 'getUserById']);
        Route::get('searchUsers', [UserController::class, 'searchUsers']);
        Route::put('users/status/{id}', [UserController::class, 'updateUserStatus']);
        Route::put('users/password/{id}', [UserController::class, 'updateUserPassword']);
        Route::get('/users/userdetails/{id}', [UserController::class, 'showuser']);
        Route::get('searchUser', [UserController::class, 'searchUser']);
        Route::get('filterusers', [UserController::class, 'filterUsers']);
        Route::get('userstotal', [UserController::class, 'total']);
        Route::get('getTotalUserCounts', [UserController::class, 'getTotalUserCounts']);
        //Orders Management
        Route::get('orders', [CommandController::class, 'getOrder']);
        Route::get('orders/getorder/{id}', [CommandController::class, 'getOrderById']);
        Route::post('orders/addorder', [CommandController::class, 'addOrder']);
        Route::put('orders/updateorder/{id}', [CommandController::class, 'updateOrder']);
        Route::delete('orders/deleteorder/{id}', [CommandController::class, 'deleteOrder']);
        Route::get('orders/orderdetails', [CommandController::class, 'index']);
        Route::get('orders/orderdetails/{id}', [CommandController::class, 'show']);
        Route::get('searchOrder', [CommandController::class, 'searchOrder']);
        Route::get('filterorders', [CommandController::class, 'filterOrders']);
        Route::put('orders/status/{id}', [CommandController::class, 'updateOrderStatus']);
        Route::get('orderstotal', [CommandController::class, 'total']);
        Route::get('getTotalCounts', [CommandController::class, 'getTotalCounts']);
        //Partners Management
        Route::apiResource('partners', PartnerController::class);
        Route::get('partners/partnerdetails/{id}', [PartnerController::class, 'showdetails']);
        Route::get('searchPartner', [PartnerController::class, 'searchPartner']);
        Route::get('filter', [PartnerController::class, 'filterPartners']);
        Route::post('update/{id}', [PartnerController::class, 'updatePartner']);
        Route::post('updateImage/{id?}', [PartnerController::class, 'updatePartnerImage']);
        Route::post('updatePassword/{id}', [PartnerController::class, 'updatePartnerPassword']);
        Route::put('partners/status/{id}', [PartnerController::class, 'updatePartnerStatus']);
        Route::get('partnerstotal', [PartnerController::class, 'total']);
        Route::get('getTotalPartnerCounts', [PartnerController::class, 'getTotalPartnerCounts']);
        //Address Management
        Route::post('addAddress', [AddressController::class, 'store']);


        // stats
    });
});





//User
Route::prefix('user')->group(function () {
    common('scope.user');
    Route::middleware(['auth:sanctum', 'scope.user'])->group(function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::apiResource('users', UserController::class);
        Route::put('user/password', [AuthController::class, 'updatePassword']);
        //partner
        Route::get('getNearbyPartners/{lat}&{long}&{dist}&{unity?}', [PartnerController::class, 'getNearbyPartners']);
        Route::get('recommandedPartners/{name}', [PartnerController::class, 'recommandedPartners']);

        // rates
        Route::post('RatePartner', [UserController::class, 'ratePartner']);
        Route::get('getPartnerRates', [UserController::class, 'getPartnerRates']);

        // Box
        Route::get('boxs', [BoxController::class, 'index']); // all boxs
        Route::get('availableBoxs', [BoxController::class, 'availableBoxs']);
        Route::get('recommandedBoxs/{name}', [BoxController::class, 'recommandedBoxs']);
        Route::get('graphRecommandedBoxs', [BoxController::class, 'graphRecommandedBoxs']);

        Route::get('boxs/boxdetails/{id}', [BoxController::class, 'boxdetails']);
        Route::get('boxs/favorites', [BoxController::class, 'getfavorsBoxs']);
        Route::get('partners/favorites', [PartnerController::class, 'getfavorsPartners']);

        Route::get('indexByCategory/{category}', [BoxController::class, 'indexByCategory']);
        Route::get('indexByPartnerCategory/{category}', [BoxController::class, 'indexByPartnerCategory']);
        Route::get('filterprice', [BoxController::class, 'filterprice']);
        Route::get('/boxs/{id}', [BoxController::class, 'show']); // get single box
        Route::get('/partners/{id}', [BoxController::class, 'showPartner']); // get single partner
        Route::get('/showboxs', [BoxController::class, 'index2']);
        // order
        Route::post('orders/addorder', [CommandController::class, 'addOrder']);
        Route::get('getUserOrders/{status}', [CommandController::class, 'getOrdersByUser']);
        Route::post('orders/verif', [CommandController::class, 'verifQr']);


        // Like
        Route::post('/boxs/{id}/likes', [LikeController::class, 'likeOrUnlike']);
        Route::get('/boxs/{id}/checklikes', [LikeController::class, 'verifLike']);
        Route::post('/partners/{id}/likes', [LikeController::class, 'likeOrUnlikePartner']);
        Route::get('/partners/{id}/checklikes', [LikeController::class, 'verifLikePartner']);

        // stats
        Route::get('/userStats', [UserController::class, 'userStats']);
    });
});


//Partenaire
Route::prefix('partner')->group(function () {
    common('scope.partner');
    Route::middleware(['auth:sanctum', 'scope.partner'])->group(function () {
        Route::get('user', [PartnerController::class, 'currentPartner']);
        Route::put('changepassword', [PartnerController::class, 'changePassword']);
        Route::patch('updateData', [PartnerController::class, 'updateSelfData']);
        // Route::patch('partners/info', [AuthController::class, 'update']);
        // Route::post('updateImage', [PartnerController::class, 'updatePartnerImage']);
        Route::post('updateImage/{id?}', [PartnerController::class, 'updatePartnerImage']);

        Route::get('getPartnerDetails', [PartnerController::class, 'showPartnerDetails']);
        Route::put('updatePosition', [PartnerController::class, 'updatePosition']);
        // Route::post('logout', [PartnerController::class, 'logout']);
        //Box
        Route::apiResource('boxs', BoxController::class);
        Route::get('partnerboxes', [PartnerController::class, 'showpartnerboxes']);

        Route::get('getPartnerBoxs', [PartnerController::class, 'getPartnerBoxs']);
        Route::get('getPartnerBoxsbystatus/{status}', [PartnerController::class, 'getPartnerBoxsbystatus']);
        Route::put('updateBoxDetails/{id}', [BoxController::class, 'updateBoxDetails']);
        Route::post('updateBoxImage/{id}', [BoxController::class, 'updateBoxImage']);

        // orders
        Route::get('getPartnerOrders/{status}', [CommandController::class, 'getPartnerOrders']);
        Route::get('getPartnerOrderCount', [CommandController::class, 'getPartnerOrderCount']);


        //Address Management
        Route::post('addAddress', [AddressController::class, 'store']);

        // stats
        Route::get('/salesStats/{type}', [PartnerController::class, 'salesStats']);
        Route::get('getTotalBoxCountsstat', [BoxController::class, 'getTotalBoxCountsstat']);

        // rates 
        Route::get('getUsersRates', [PartnerController::class, 'getUserRates']);
    });
});

Route::put('users/password', [AuthController::class, 'updatePassword']);
Route::post('forgetPassWord', [UserController::class, 'forgetPassWord']);
Route::post('verifCode', [UserController::class, 'verifCode']);

Route::post('/send-notification', [FirebaseNotification::class, 'sendNotification']);
Route::post('/import-sql', [SqlImportController::class, 'importSql']);
Route::post('/import-csv', [SqlImportController::class, 'importCsv']);
// Route::post('/import-sql', 'SqlImportController@importSql');
// Route::post('/import-csv', 'SqlImportController@importCsv');

