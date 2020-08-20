<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceEditController extends Controller
{
    //
    public function execute(Service $service, Request $request)
    {
        if($request->isMethod('delete')) {
            $service->delete();
            return redirect('admin')->with('status', 'Сервис удален');
        }

        if($request->isMethod('post')) {
            $input = $request->except('_token');
            //dd($input);
            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'text' => 'required',
            ]);


            if($validator->fails()) {
                return redirect()->route('serviceEdit',['service'=>$input['id']])->withErrors($validator);
            }

            if($request->hasFile('icon')) {
                $file = $request->file('icon');
                $file->move(public_path().'/assets/img', $file->getClientOriginalName());
                $input['icon'] = $file->getClientOriginalName();
            } else{
                $input['icon'] = $input['old_icon'];
            }


            unset($input['old_icon']);

            $service->fill($input);


            if($service->update()) {
                return redirect('admin')->with('status','Сервис обновлен');
            }
        }

        $old = $service->toArray();

        if(view()->exists('admin.service_edit')){
            $data = [
                'title' => 'Редактирование сервиса - '.$old['name'],
                'data' => $old
            ];

            return view('admin.service_edit', $data);
        }
    }
}
