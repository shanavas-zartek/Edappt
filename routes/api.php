<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');
        Route::post('create_pin', 'AuthController@create_pin');
        Route::post('/parent', 'AuthController@parent_details');
        Route::post('check_duplicate_mobile', 'AuthController@check_duplicate_mobile');
        Route::post('update_password', 'AuthController@update_password');
        Route::post('check_duplicate_email_phone', 'AuthController@check_duplicate_email_phone');
        Route::post('/student', 'AuthController@student_details');
        Route::post('login_using_email', 'AuthController@login_using_email');
        Route::post('/save_student_image', 'AuthController@save_student_image');
        Route::post('/categories', 'AuthController@category_details');
        Route::post('/age_group', 'AuthController@age_group_list');
        Route::post('get_student_list', 'AuthController@student_list');
        Route::post('/save_planner_item', 'AuthController@save_planner_item');
        Route::post('/get_planner_list', 'AuthController@get_planner_list');
        Route::post('/edit_planner', 'AuthController@edit_planner_item');
        Route::post('/save_timetable', 'AuthController@save_timetable');
        Route::post('/get_timetables', 'AuthController@get_timetables');
        Route::post('/delete_timetable', 'AuthController@delete_timetable');

        Route::post('create_parent_student', 'AuthController@create_parent_student');
        Route::post('/get_state_list', 'AuthController@state_list');
        Route::post('/get_city_list', 'AuthController@city_list');
        Route::post('/get_district_list', 'AuthController@district_list');
        Route::post('/get_country_list', 'AuthController@country_list');

        Route::post('/save_parent_details', 'AuthController@save_parent_details');
        Route::post('/edit_parent_details', 'AuthController@edit_parent_details');
        Route::post('/get_parent_details', 'AuthController@get_parent_details');
        Route::post('/get_parent_folder', 'AuthController@get_parent_folder');
        Route::post('/get_child_folders', 'AuthController@get_child_folders');
        
        Route::post('/get_diary', 'AuthController@get_my_diary');
        Route::post('/save_diary', 'AuthController@save_my_diary');
        Route::post('/edit_diary', 'AuthController@edit_my_diary');

        Route::post('/save_repository', 'AuthController@save_repository');
        Route::post('/get_uploaded_files', 'AuthController@get_uploaded_files');

        Route::post('/save_student_post', 'AuthController@create_student_post');
		Route::post('/get_posts_list', 'AuthController@get_posts_list');
        Route::post('/edit_posts', 'AuthController@edit_posts');
        /*
        POST CATEGORY LIST
        */
        Route::get('/category_list', 'Contentcategory@get_category_list');

        /*
        Student Details Update. student details divided into two sections. "MY" and "MY FAVOURATES"
        */
        Route::post('/update_student_my', 'AuthController@update_student_my');
        Route::post('/update_student_my_favourite', 'AuthController@update_student_my_favourite');
        
        /*
        Audio files uploaded from admin side. 
        */
        Route::post('/get_audio_files', 'AuthController@get_audio_files');
        
        Route::post('/save_audio_files', 'AuthController@save_audio_file');
        Route::post('/edit_audio_files', 'AuthController@edit_audio_file');
        Route::post('/save_audio_listen_history', 'AuthController@save_audio_listen_history');
        Route::post('/get_all_watched_audio_list', 'AuthController@get_all_watched_audio_list');
        
        Route::post('/save_video_files', 'AuthController@save_video_files');
        Route::post('/edit_video_files', 'AuthController@edit_video_files');
        Route::post('/get_video_files', 'AuthController@get_video_files');
        Route::post('/get_videos', 'AuthController@get_videos');

        Route::post('/get_video_watched_history', 'AuthController@get_video_watched_history');
        Route::post('/save_video_watched_history', 'AuthController@save_video_watched_history');
        
        Route::post('/save_studygroup_request', 'AuthController@save_studygroup_request');
        Route::post('/get_studygroup_list', 'AuthController@get_studygroup_list');
        Route::post('/edit_studygroup_request', 'AuthController@edit_studygroup_request');
        
        Route::post('/get_studygrouprequest_list', 'AuthController@get_studygrouprequest_list');
        
        Route::post('/get_quiz_list', 'AuthController@get_quiz_list');
        Route::post('/get_quiz_details', 'AuthController@get_quiz_details');
        Route::post('/get_quiz_name', 'AuthController@get_quiz_name');
        Route::post('/make_payment', 'AuthController@make_payment');
        Route::post('/get_course_list', 'AuthController@get_course_list');
        Route::post('/get_course_videos', 'AuthController@get_course_videos');
        Route::post('/purchase_course', 'AuthController@purchase_course');
        Route::post('/cancel_course_purchase', 'AuthController@cancel_course_purchase');
        Route::post('/get_purchased_course_list', 'AuthController@get_purchased_course_list');
        Route::post('/get_course_summary_list', 'AuthController@get_course_summary_list');
        Route::post('/save_puzzledetails', 'AuthController@save_puzzledetails');
        Route::post('/get_attempted_puzzles', 'AuthController@get_attempted_puzzles');
        Route::post('/puzzle_resuls', 'AuthController@puzzle_resuls');

        Route::post('/get_total_points', 'AuthController@get_total_points');
        Route::post('/dashboard_points', 'AuthController@dashboard_points');

        Route::post('/get_payment_history', 'AuthController@get_payment_history');
        Route::post('/save_father_details', 'AuthController@save_father_details');
		Route::post('/save_mother_details', 'AuthController@save_mother_details');
		Route::post('/save_address_details', 'AuthController@save_address_details');
        Route::post('/get_task_list', 'AuthController@get_task_list');
        Route::post('/get_completed_task_list', 'AuthController@get_completed_task_list');
        Route::post('/save_student_task', 'AuthController@save_student_task');
        Route::post('/get_opinion_poll_list', 'AuthController@get_opinion_poll_list');
        Route::post('/get_opinion_poll_answered_list', 'AuthController@get_opinion_poll_answered_list');
        Route::post('/save_student_opinion', 'AuthController@save_student_opinion');
        Route::post('/get_poll_details', 'AuthController@get_poll_details');
        Route::post('/get_magazine_list', 'AuthController@get_magazine_list');
        Route::post('/get_task_details', 'AuthController@get_task_details');
        Route::post('/get_student_blogs', 'AuthController@get_student_blogs');
        Route::post('/save_blog', 'AuthController@save_blog');
        Route::post('/activity_search', 'AuthController@activity_search');
        Route::post('/puzzle_search', 'AuthController@puzzle_search');
        Route::get('/contentcategories', 'AuthController@contentcategory');
		Route::post('/get_vendorcategory_list', 'AuthController@get_vendorcategory_list');
		Route::post('/get_vendors_list', 'AuthController@get_vendors_list');
		Route::post('/save_student_queries', 'AuthController@save_student_queries');
		Route::post('/get_vendor_results', 'AuthController@get_vendor_results');
		Route::post('/save_teacherondemand_request', 'AuthController@save_teacherondemand_request');
        Route::post('/save_vendordata', 'AuthController@save_vendordata');
        Route::post('/edit_vendordata', 'AuthController@edit_vendordata');


		Route::post('/get_teacherondemand_requests_list', 'AuthController@get_teacherondemand_requests_list');
		Route::post('/get_teacherondemand_details', 'AuthController@get_teacherondemand_details');
		Route::post('/save_student_goals', 'AuthController@save_student_goals');
		Route::post('/get_student_goals', 'AuthController@get_student_goals');
		Route::post('/get_student_goals_results', 'AuthController@get_student_goals_results');
		Route::post('/attempted_quiz_results', 'AuthController@attempted_quiz_results');
		
        /*
        SEPERATING THIS FUNCTION INTO TWO INDIVIDUAL SELECT.
        IN MOBILE APPLICATION, CAN PERFORM LAZY LOAD
        */
        Route::post('/get_all_student_blogs', 'AuthController@get_all_student_blogs');
        Route::post('/get_blogs_by_student_id', 'AuthController@get_blogs_by_student_id');

        

        Route::group([
        'middleware' => 'auth:api'
        ], function() {
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
        });
        
        
    });