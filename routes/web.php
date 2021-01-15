<?php

use Illuminate\Support\Facades\Route;

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

   // Route::get('/', 'DashboardController@index')->name('dashboard.index');
   Route::get('/forms', 'PageController@index')->name('forms');
   Route::get('/tables', 'PageController@tables')->name('tables');
   Route::get('/chartjs', 'PageController@chartjs')->name('chartjs');
   Route::get('/typography', 'PageController@typography')->name('typography');
   Route::get('/dropdowns', 'PageController@dropdowns')->name('dropdowns');
   Route::get('/buttons', 'PageController@buttons')->name('buttons');

   Route::get('/', function () {
     return view('auth.login');
  });

   Auth::routes();


   Route::get('/home', 'HomeController@index')->name('home');
   //********company settings********//
   Route::get('/company', 'CompanyController@index')->name('company');
   Route::post('/company/store', 'CompanyController@store')->name('company.store');
  //********agegroup********//
   Route::resource('agegroup', 'AgegroupController');
   Route::get('/agegroup/delete/{id}','AgegroupController@delete');
   Route::get('/agegroup/edit/{id}','AgegroupController@edit');
  //******* Subscription plans********/
   Route::resource('subscription', 'SubscriptionController');
   Route::get('/subscription/delete/{id}','SubscriptionController@delete');
   Route::get('/subscription/edit/{id}','SubscriptionController@edit');
   Route::get('/subscription_list', 'SubscriptionController@subscriptions');

  //******* preferences********/
   Route::resource('/preferences', 'PreferenceController');
   Route::get('/preferences/delete/{id}','PreferenceController@delete');
   Route::get('/preferences/edit/{id}','PreferenceController@edit');
   // student preferences
   Route::resource('/studentpreferences', 'StudentpreferencesController');
   Route::get('/studentpreferences/show/{id}','StudentpreferencesController@show');
   //******* Admin Blogs********/
   Route::resource('/adminblogs', 'AdminBlogsController');
   Route::get('/adminblogs/delete/{id}','AdminBlogsController@delete');
   Route::get('/adminblogs/edit/{id}','AdminBlogsController@edit');

     //******* Student Blogs********/
     Route::resource('/studentblogs', 'StudentBlogsController');
     Route::get('/studentblogs/delete/{id}','StudentBlogsController@delete');
     Route::get('/studentblogs/edit/{id}','StudentBlogsController@edit');

   //*******L&D Category ********//
   Route::resource('/learning', 'LearningCategoryController');
   Route::get('/learning/delete/{id}','LearningCategoryController@delete');
   Route::get('/learning/edit/{id}','LearningCategoryController@edit');
   //*******L&D Details ********//
   Route::resource('/development', 'LearningController');
   Route::get('/development/delete/{id}','LearningController@delete');
   Route::get('/development/edit/{id}','LearningController@edit');
  //*******option poll types********
   Route::resource('/optionpolltype', 'OptionpolltypeController');
   Route::get('/optionpolltype/delete/{id}','OptionpolltypeController@delete');
   Route::get('/optionpolltype/edit/{id}','OptionpolltypeController@edit');
   //*******option poll ********
   Route::resource('/optionpoll', 'OptionpollController');
   Route::get('/optionpoll/delete/{id}','OptionpollController@delete');
   Route::get('/optionpoll/delete_request/{id}','OptionpollController@delete_request');
   Route::get('/optionpoll/approval/{id}','OptionpollController@approval');
   Route::get('/optionpoll/edit/{id}','OptionpollController@edit');
   Route::post('/optionpoll/store', 'OptionpollController@store')->name('optionpoll.store');
   Route::post('/optionpoll/approve_requests', 'OptionpollController@approve_requests')->name('optionpoll.approve_requests');
   Route::get('optionpoll.requests','OptionpollController@requests')->name('optionpoll.requests');
   //vendors type
  //vendors type
 
  Route::resource('/vendorcategory', 'VendorcategoryController');
  Route::get('/vendorcategory/delete/{id}','VendorcategoryController@delete');
  Route::get('/vendorcategory/edit/{id}','VendorcategoryController@edit');
  
  //vendors details
   Route::resource('/vendors', 'VendorsController');
   Route::get('/vendors/delete/{id}','VendorsController@delete');
   Route::get('/vendors/edit/{id}','VendorsController@edit');
   Route::get('/vendors/create/{id}','VendorsController@create');

   //contentcategory

   Route::resource('/contentcategory', 'ContentcategoryController');
   Route::get('/contentcategory/delete/{id}','ContentcategoryController@delete');
   Route::get('/contentcategory/edit/{id}','ContentcategoryController@edit');

   //tasks
   Route::resource('/task', 'TaskController');
   Route::get('/task/delete/{id}','TaskController@delete');
   Route::get('/task/edit/{id}','TaskController@edit');
   //Activity types
   Route::resource('/subject', 'SubjectController');
   Route::get('/subject/delete/{id}','SubjectController@delete');
   Route::get('/subject/edit/{id}','SubjectController@edit');
    //Questions
    Route::resource('/questions', 'QuestionsController');
    Route::post('/questions/delete','QuestionsController@questiondelete');
     Route::get('/questions/edit/{id}','QuestionsController@edit');
    Route::get('/questions/createQuestions/{id}','QuestionsController@createQuestions');
    Route::post('/questions/store', 'QuestionsController@store')->name('questions.store');
 
    //Answers
    Route::resource('/details', 'ContentdetailsController');
    Route::get('/details/delete/{id}','ContentdetailsController@delete');
    Route::get('/details/edit/{id}','ContentdetailsController@edit');

// parent details
   Route::resource('/parentdetail', 'ParentdetailController');
   Route::get('/parentdetail/delete/{id}','ParentdetailController@delete');
   Route::get('/parentdetail/edit/{id}','ParentdetailController@edit');
   Route::get('/parentdetail/show/{id}','ParentdetailController@show');

   Route::get('parent/all', 'ParentdetailController@alllist')->name('parent.all');
   Route::get('/parentdetail/resetPassword/{id}','ParentdetailController@resetPassword');
//student details
   Route::resource('/studentdetails', 'StudentdetailsController');
   Route::get('/studentdetails/delete/{id}','StudentdetailsController@delete');
   Route::get('/studentdetails/edit/{id}','StudentdetailsController@edit');
   Route::get('/studentdetails/show/{id}','StudentdetailsController@show');

  // student queries
   Route::resource('/studentqueries', 'StudentqueriesController');
   Route::get('/studentqueries/show/{id}','StudentqueriesController@show');
   //goals

   Route::resource('/studentgoals', 'StudentgoalsController');
   Route::get('/studentgoals/show/{id}','StudentgoalsController@show');
  //studentscrapbook
   Route::resource('/studentscrapbook', 'StudentscrapbookController');
   Route::get('/studentscrapbook/show/{id}','StudentscrapbookController@show');
    //******* Archievements********/
    Route::resource('achievements', 'AchievementsController');
    Route::get('/achievements/delete/{id}','AchievementsController@delete');
    Route::get('/achievements/view/{id}','AchievementsController@edit');
      //**********Book a Slot*********/
      Route::resource('/bookslot', 'BookslotController');
      Route::get('/bookslot/edit/{id}','BookslotController@edit');
      Route::post('/bookslot/checkslot', 'BookslotController@checkslot');

   //*******Study Group*******/
   Route::resource('studygroup', 'StudygroupController');
   Route::get('/studygroup/delete/{id}','StudygroupController@delete');
   Route::get('/studygroup/view/{id}','StudygroupController@edit');
   Route::resource('studygrouprequest', 'StudygrouprequestController');
   Route::get('/studygrouprequest/create/{id}','StudygrouprequestController@create');
   Route::get('/studygroup/edit/{id}','StudygroupController@edit');

    // student postings
    Route::resource('postings', 'PostingsController');
    Route::get('/postings/view/{id}','PostingsController@show');
    Route::get('/postings/delete/{id}','PostingsController@delete');


   //***********Teacher login***********//
   Route::get('/teachershome', 'TeacherController@home')->name('teacher.home');
   Route::get('/ondemand', 'TeacherController@ondemand')->name('teacher.ondemand');
   Route::get('/teacher/approve_demand/{id}','TeacherController@approve_demand');
   Route::post('/teacher/approve', 'TeacherController@approve')->name('teacher.approve');

   // Teacher on Demand
   Route::resource('/teacher', 'TeacherController');
   Route::get('/teacher/edit/{id}','TeacherController@edit');
   Route::get('/teacher/delete/{id}','TeacherController@delete');

 
   Route::get('/requested', 'TeacherController@requested')->name('teacher.requested');
   Route::get('/teacher/delete_teacherdemand/{id}','TeacherController@delete_teacherdemand');
   
/******Discussion forum****** */

Route::resource('/discussionforumcategory', 'DiscussionforumcategoryController');
Route::get('/discussionforumcategory/delete/{id}','DiscussionforumcategoryController@delete');
Route::get('/discussionforumcategory/edit/{id}','DiscussionforumcategoryController@edit');

Route::resource('/discussionforum', 'DiscussionforumController');
Route::get('/discussionforum/delete/{id}','DiscussionforumController@delete');
Route::get('/discussionforum/edit/{id}','DiscussionforumController@edit');

Route::resource('/discussionforumdtl', 'DiscussionforumdtlController');
Route::get('/discussionforumdtl/delete/{id}','DiscussionforumdtlController@delete');
Route::get('/discussionforumdtl/edit/{id}','DiscussionforumdtlController@edit');
Route::post('/discussionforumdtl/viewlist', 'DiscussionforumdtlController@show');

/***Student repository***/
Route::resource('studentrepository', 'StudentrepositoryController');
Route::get('/studentrepository/view/{id}','StudentrepositoryController@show');
Route::get('/studentrepository/delete/{id}','StudentrepositoryController@delete');

 /***UserRoleController */
 Route::resource('userrole', 'UserRoleController');
 Route::get('/userrole/delete/{id}','UserRoleController@delete');
 Route::get('/userrole/edit/{id}','UserRoleController@edit'); 

  //******* Demo Videos********/
  Route::resource('/demo', 'DemoVideoController');
  Route::get('/demo/delete/{id}','DemoVideoController@delete');
  Route::get('/demo/edit/{id}','DemoVideoController@edit');

  //******* country,state,city,district********/
  Route::resource('/country', 'CountryController');
  Route::get('/country/edit/{id}','CountryController@edit');
  Route::resource('/states', 'StatesController');
  Route::get('/states/edit/{id}','StatesController@edit');
  Route::resource('/district', 'DistrictController');
  Route::get('/district/edit/{id}','DistrictController@edit');
  Route::resource('/city', 'CityController');
  Route::get('/city/edit/{id}','CityController@edit');
  
//******* login history********/
Route::resource('/loginhistory', 'LoginhistoryController');


//******* location********/
Route::resource('/location', 'LocationController');
 Route::get('/location/get-state-list/{id}','LocationController@getStateList');
 Route::get('/location/get-city-list/{id}','LocationController@getCityList');
 Route::get('/location/get-district-list/{id}','LocationController@getDistrictList');

 /******* DSA********/
Route::resource('/DSAdetails', 'DSAdetailsController');
Route::get('/DSAdetails/edit/{id}','DSAdetailsController@edit');
Route::get('/DSAdetails/delete/{id}','DSAdetailsController@delete');
Route::get('/DSAdetails/view/{id}','DSAdetailsController@show');

//*******  Video Upload********/
Route::resource('/videofileupload', 'VideofileuploadController');
Route::get('/videofileupload/delete/{id}','VideofileuploadController@delete');
Route::get('/videofileupload/edit/{id}','VideofileuploadController@edit');

//*******  Audio Upload********/
Route::resource('/audiofileupload', 'AudiofileuploadController');
Route::get('/audiofileupload/delete/{id}','AudiofileuploadController@delete');
Route::get('/audiofileupload/edit/{id}','AudiofileuploadController@edit');

//*******  Course ********/
Route::resource('/course', 'CourseController');
Route::get('/course/delete/{id}','CourseController@delete');
Route::get('/course/edit/{id}','CourseController@edit');

//*******Course Videos ********//
Route::resource('/coursedetails', 'CourseDetailsController');
Route::get('/coursedetails/delete/{id}','CourseDetailsController@delete');
Route::get('/coursedetails/edit/{id}','CourseDetailsController@edit');
// course purchased
Route::resource('/purchased', 'CoursePurchasedController');
Route::get('/purchased/details/{id}','CoursePurchasedController@details');
//student tasks
Route::resource('/studenttasks', 'StudentTaskController');
// stdent opinions

Route::resource('/studentopinions', 'StudentOpinionsController');

//******* Magazine ********/
Route::resource('/magazine', 'MagazineController');
Route::get('/magazine/delete/{id}','MagazineController@delete');
Route::get('/magazine/edit/{id}','MagazineController@edit');