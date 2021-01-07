<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
class ProfileController extends Controller
{
    //
 public function add()
    {
        return view('admin.profile.create');
    }
 
 public function create(Request $request)
    {
         // Varidationを行う
      $this->validate($request, Profile::$rules);

      $profile = new Profile;
      $form = $request->all();

      // formに画像があれば、保存する
     if (isset($form['image'])) {
      $path = $request->file('image')->store('public/image');
      $profile->image_path = basename($path);
   } else {
      $profile->image_path = null;
   }

      unset($form['_token']);
      unset($form['image']);
      // データベースに保存する
      $profile->fill($form);
      $profile->save();
     
      return redirect('admin/profile/create');
    }

public function edit(Request $request)
    {
        // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }

public function update(Request $request)
    {
       // Validationをかける
      $this->validate($request, Profile::$rules);
      // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();
      unset($profile_form['_token']);

      // 該当するデータを上書きして保存する
      $profile->fill($profile_form)->save();
      
      return redirect('admin/profile/edit');
    }
	
 // 以下を追記　　
  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $profile = Profile::find($request->id);
      // 削除する
      $profile->delete();
      return redirect('admin/profile/');
  }  


}
