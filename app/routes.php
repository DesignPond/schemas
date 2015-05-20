<?php



/**
 * Session routes
*/
Route::post('login', array( 'before' => 'csrf' , 'uses' => 'SessionController@login') );
Route::get('login', 'SessionController@auth');
Route::get('logout', 'SessionController@logout');

Route::controller('password', 'RemindersController');

/**
 * Pages routes
 */
Route::get('/', 'HomeController@index');
Route::get('book/{id}', 'HomeController@book');
Route::get('contact', 'HomeController@contact');
Route::post('sendemail', 'HomeController@sendemail');

/**
 * Categories routes
 */
Route::resource('categorie', 'CategorieController');

/**
 * Themes routes
 */
Route::resource('theme', 'ThemeController');
Route::get('theme/drop_theme/{id}', 'ThemeController@drop_theme');
Route::get('theme/drop_subtheme/{id}', 'ThemeController@drop_subtheme');

/**
 * Subtheme routes
 */
Route::resource('subtheme', 'SubthemeController');

/**
 * Tags routes
 */
Route::get('tags', 'TagController@tags');
Route::get('allTags', 'TagController@allTags');
Route::post('addTag', 'TagController@addTag');
Route::post('removeTag', 'TagController@removeTag');
Route::resource('tag', 'TagController');

/**
 * Compose routes
 */
Route::get('compose/{id}/delete', 'ComposeController@destroy');
Route::get('compose/modal/{id?}', 'ComposeController@modal');
Route::post('compose/update', array( 'uses' => 'ComposeController@update') );
Route::post('compose/status', array( 'before' => 'csrf' , 'uses' => 'ComposeController@status') );
Route::post('compose/assign', array( 'before' => 'csrf' , 'uses' => 'ComposeController@assign') );
Route::post('compose', array( 'before' => 'csrf' , 'uses' => 'ComposeController@store') );
Route::resource('compose', 'ComposeController');

/**
 * User routes
 */

Route::get('manage', 'UserController@manage');
Route::get('actifs', 'UserController@actifs');
Route::get('revision', 'UserController@revision');
Route::get('archives', 'UserController@archives');
Route::post('archives', 'UserController@archives');
Route::post('getArchives', 'UserController@getArchives');
Route::resource('user', 'UserController');

/**
 * API routes
 */
Route::group(array('prefix' => 'api'), function()
{
    // Get theme for project
    Route::get('projet/{id}', 'ComposeController@projet');
    // Boxes and arrows
    Route::get('boxe/projet/{id}', 'BoxeController@refProject');
    Route::resource('boxe', 'BoxeController');
    Route::get('arrow/projet/{id}', 'ArrowController@refProject');
    Route::resource('arrow', 'ArrowController');

});

/**
 * TEST routes
 */
Route::get('roles', 'UserController@roles');



