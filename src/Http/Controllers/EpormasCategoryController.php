<?php

namespace Bantenprov\DashboardEpormas\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Bantenprov\DashboardEpormas\Models\EpormasCategory;
use Validator, Image, Session, File, Response, Redirect, Exception;

class EpormasCategoryController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      try {
          $error = false;
          $statusCode = 200;
          $title = 'Success';
          $type = 'success';
          $message = 'Success';
          $result = EpormasCategory::all();
      } catch (Exception $e) {
          $error = true;
          $statusCode = 404;
          $title = 'Error';
          $type = 'error';
          $message = 'Error';
          $result = 'Not Found';
      } finally {
          return Response::json(array(
            'error' => $error,
            'status' => $statusCode,
            'title' => $title,
            'type' => $type,
            'message' => $message,
            'result' => $result
          ));
      }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request, $version='')
  {
        $path = \Request::path();
        $explode = explode('/', $path);

        $from = 'form';
        if(in_array('api',$explode)){
          $from = 'api';
        }

        $via = $from;
        if($version != '' && $version != 'store'){
          $via .= '-'.$version;
        }

      	$rules = [
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return Response::json(array(
              'title' => 'Error',
              'type'  => 'error',
              'message' => $validator->errors()->all()
          ));
        }

        $data = EpormasCategory::whereNull('deleted_at')
                        ->where('name', $request->name)
                        ->count();
        if($data > 0){
          return Response::json(array(
              'title' => 'Error',
              'type'  => 'error',
              'message' => 'Data has already been taken.'
          ));
        }

        $error = false;
        $statusCode = 200;
        $title = 'Success';
        $type = 'success';
        $message = 'Data created successfully';
        $result = EpormasCategory::create([
            'name' => $request->name
        ]);
        return Response::json(array(
          'error' => $error,
          'status' => $statusCode,
          'title' => $title,
          'type' => $type,
          'message' => $message,
          'result' => $result
        ));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($version='', $id)
  {
        try {
            $error = false;
            $statusCode = 200;
            $title = 'Success';
            $type = 'success';
            $message = 'Success';
            $result = EpormasCategory::findOrFail($id);
        } catch (Exception $e) {
            $error = true;
            $statusCode = 404;
            $title = 'Error';
            $type = 'error';
            $message = 'Error';
            $result = 'Not Found';
        } finally {
            return Response::json(array(
              'error' => $error,
              'status' => $statusCode,
              'title' => $title,
              'type' => $type,
              'message' => $message,
              'result' => $result
            ));
        }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
        try {
            $error = false;
            $statusCode = 200;
            $title = 'Success';
            $type = 'success';
            $message = 'Success';
            $result = EpormasCategory::findOrFail($id);
        } catch (Exception $e) {
            $error = true;
            $statusCode = 404;
            $title = 'Error';
            $type = 'error';
            $message = 'Error';
            $result = 'Not Found';
        } finally {
            return Response::json(array(
              'error' => $error,
              'status' => $statusCode,
              'title' => $title,
              'type' => $type,
              'message' => $message,
              'result' => $result
            ));
        }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $version='', $id)
  {
        $result = EpormasCategory::find($id);

        $rules = [
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return Response::json(array(
              'type'  => 'error',
              'message' => $validator->errors()->all()
          ));
        }

        if($request->name != $result->name){
          $data = EpormasCategory::whereNull('deleted_at')
                          ->where('name', $request->name)
                          ->count();
          if($data > 0){
            return Response::json(array(
                'title' => 'Error',
                'type'  => 'error',
                'message' => 'Data has already been taken.'
            ));
          }
        }

        $path = \Request::path();
        $explode = explode('/', $path);

        $from = 'form';
        if(in_array('api',$explode)){
          $from = 'api';
        }

        $via = $from;
        if($version != '' && $version != 'update'){
          $via .= '-'.$version;
        }

        $error = false;
        $statusCode = 200;
        $title = 'Success';
        $type = 'success';
        $message = 'Data updated successfully';
        $result->update([
            'name' => $request->name
        ]);
        return Response::json(array(
          'error' => $error,
          'status' => $statusCode,
          'title' => $title,
          'type' => $type,
          'message' => $message,
          'result' => $result
        ));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      EpormasCategory::find($id)->delete();
      $error = false;
      $statusCode = 200;
      $title = 'Success';
      $type = 'success';
      $message = 'Data deleted successfully';
      return Response::json(array(
        'error' => $error,
        'status' => $statusCode,
        'title' => $title,
        'type' => $type,
        'message' => $message
      ));
  }

}
