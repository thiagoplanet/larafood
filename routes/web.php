<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
//
//

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        /**
     * Plan x Profile
     */
        Route::get('plans/{id}/profile/{idProfile}/detach', 'Admin\ACL\PlanProfileController@detachProfilePlan')->name('plans.profile.detach');
        Route::post('plans/{id}/profiles', 'Admin\ACL\PlanProfileController@attachProfilesPlan')->name('plans.profiles.attach');
        Route::any('plans/{id}/profiles/create', 'Admin\ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
        Route::get('plans/{id}/profiles', 'Admin\ACL\PlanProfileController@profiles')->name('plans.profiles');
        Route::get('profiles/{id}/plans', 'Admin\ACL\PlanProfileController@plans')->name('profiles.plans');

        /**
     * PERMISSION x PROFILE
     */

        Route::get('profiles/{id}/permission/{idPermission}/detach', 'Admin\Acl\PermissionProfileController@detachPermissionProfile')->name('profiles.permissions.detach'); //desvincula permissão ao perfil(profile)
        Route::post('profiles/{id}/permissions', 'Admin\Acl\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attache'); //vincula permissão ao perfil(profile)
        Route::any('profiles/{id}/permissions/create', 'Admin\Acl\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
        Route::get('profiles/{id}/permissions', 'Admin\Acl\PermissionProfileController@permissions')->name('profiles.permissions');
        Route::get('permissions/{id}/profiles', 'Admin\Acl\PermissionProfileController@profiles')->name('permissions.profiles'); //aqui fazemos o contrario, de permissão vejo quais são os perfils

        /**
     * Routes Permissions
     */
        Route::any('permissions/search', 'Admin\Acl\PermissionController@search')->name('permissions.search');
        Route::Resource('permissions', 'Admin\Acl\PermissionController');

        /**
     * Routes Profiles
     */
        Route::any('profiles/search', 'Admin\Acl\ProfileController@search')->name('profiles.search');
        Route::Resource('profiles', 'Admin\Acl\ProfileController');

        /**
     * ROutes details Plans
     */
        Route::delete('plans/{url}/details/{idDetail}', 'Admin\DetailPlanController@destroy')->name('details.plan.destroy'); //atualiza formulario
        Route::get('plans/{url}/details/create', 'Admin\DetailPlanController@create')->name('details.plan.create'); //exibe formulario
        Route::get('plans/{url}/details/{idDetail}', 'Admin\DetailPlanController@show')->name('details.plan.show'); //atualiza formulario
        Route::put('plans/{url}/details/{idDetail}', 'Admin\DetailPlanController@update')->name('details.plan.update'); //atualiza formulario
        Route::get('plans/{url}/details/{idDetail}/edit', 'Admin\DetailPlanController@edit')->name('details.plan.edit'); //exibe formulario
        Route::post('plans/{url}/details', 'Admin\DetailPlanController@store')->name('details.plan.store'); //cadastra novo plano no banco
        Route::get('plans/{url}/details', 'Admin\DetailPlanController@index')->name('details.plan.index');

        /**
     * Routes Plans
     */
        Route::get("plans", "Admin\PlanController@index")->name('plans.index');
        Route::get("plans/create", "Admin\PlanController@create")->name('plans.create');
        Route::post("admin/plans", "Admin\PlanController@store")->name('plans.store');
        Route::get("plans/{url}", "Admin\PlanController@show")->name('plans.show');
        Route::delete("plans/{url}", "Admin\PlanController@destroy")->name('plans.detroy');
        Route::any('plans/search', 'Admin\PlanController@search')->name('plans.search');

        Route::get("plans/{url}/edit", "Admin\PlanController@edit")->name('plans.edit');
        Route::put("plans/{url}", "Admin\PlanController@update")->name('plans.update');

        /**
     * Home Dashboard
     */
        Route::get('/', 'Admin\PlanController@index')->name('admin.index');

    });

    /**
     * site
     */

Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');

/**
 * Auth routes
 */
Auth::routes();


