<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceAddController extends Controller
{
    //
    public function execute(Request $request)
    {
        if($request->isMethod('post')) {
            $input = $request->except('_token');

            $messages = [
              'required' => 'Поле :attribute обязательно к заполнению'
            ];

            $validator = Validator::make($input,[
                'name' => 'required',
                'text' => 'required',
                'icon' => 'required'
            ], $messages);

            if($validator->fails()) {
                return redirect()->route('serviceAdd')->withErrors($validator)->withInput();
            }

            if($request->hasFile('icon')) {
                $file = $request->file('icon');

                $input['icon'] = $file->getClientOriginalName();
                $file->move(public_path().'/assets/img', $input['icon']);
            }

            $service = new Service();
            $service->fill($input);

            if($service->save()) {
                return redirect('admin')->with('status','Сервис добавлен');
            }
        }

        if(view()->exists('admin.service_add')) {
            $data = [
                'title' => 'Создание нового сервиса'
            ];
            return view('admin.service_add', $data);
        }
        abort(404);
    }
}
