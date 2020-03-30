<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use DB;
use App\Log;
use App\Role;
use App\MenuName;
use Session;
use Carbon\Carbon;
use Validator;
use App\ConfigText;
use App\User;

class RoleController extends Controller
{
    
    public function index()
    {
        $menu     = MenuClass::menuName('L_ROLE_ADMIN');
        $mainmenu = MenuClass::menuName('L_ADMIN');
        $roles    = Role::select('role_id', 'name')->get();
        return view('pages.admin.role_admin', compact('roles', 'menu', 'mainmenu'));
    }
    
    public function store(Request $request)
    {
        $role = $request->rolename;
        if($role != ''){

            $validator = Validator::make($request->all(),[
                'rolename' => 'required',
            ]);
        
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
  

            $user = Role::create([
                'name' => $role
              ]);
              $lastValue = Role::orderBy('role_id', 'desc')->first();
              $menu      = MenuName::select('menu_id')->orderby('menu_id', 'desc')->first();
              $menuarray = DB::select('SELECT menu_id from asta_db.adm_menu ');
              $menufirst = MenuName::select('menu_id')->first();

              for ($i=$menufirst->menu_id; $i <= $menu->menu_id; $i++) {
                $menuId[] = [
                  'role_id' => $lastValue->role_id,
                  'menu_id' => $i,
                  'type'    => '2'
                ];
              }
      
              DB::table('asta_db.adm_access')->insert($menuId);
              Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '2',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Menambahkan data ('.$role.')'
              ]);
              return redirect()->route('Role_Admin')->with('success', alertTranslate('L_INSERT_DATA_SUCCESS'));  
        }
        return redirect()->route('Role_Admin')->with('alert', alertTranslate('L_ROLE_NAME_NULL'));
    }

    public function menu($role)
    {
        $roles    = DB::table('asta_db.adm_access')
                    ->join('asta_db.adm_menu', 'asta_db.adm_menu.menu_id', '=', 'asta_db.adm_access.menu_id')
                    ->select(
                      'asta_db.adm_menu.name',
                      'asta_db.adm_access.type',
                      'asta_db.adm_access.menu_id',
                      'asta_db.adm_access.role_id'
                    )
                    ->where('asta_db.adm_access.role_id', '=', $role)
                    ->get();
        $mainmenu = MenuName::where('parent_id', '=', 0)
                    ->join('asta_db.adm_access', 'asta_db.adm_access.menu_id', '=', 'asta_db.adm_menu.menu_id')
                    ->where('status', '=', 1)
                    ->where('parent_id', '=', 0)
                    ->where('asta_db.adm_access.role_id', '=', $role)
                    ->where('asta_db.adm_menu.menu_id', '!=', 100)
                    ->get();

        
                    
        $op_id   = Session::get('userId');
        $role_op = User::where('op_id', '=', $op_id)->first();
        $roles          = $roles->toArray();
        $menu           = MenuClass::menuName('L_ROLE_ADMIN');
        $mainmenuaccess = MenuClass::menuName('L_ADMIN');
        $roletype       = ConfigText::select('name', 'value')->where('id', '=', 6)->first();
        $value          = str_replace(':', ',', $roletype->value);
        $type           = explode(",", $value);

        return view('pages.admin.role_edit', compact('roles', 'role', 'menu', 'type','mainmenu', 'mainmenuaccess', 'role_op'));
    }

    
    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
        $currentname = Role::where('role_id', '=', $pk)->first();
  
        Role::where('role_id', '=', $pk)->update([
          $name => $value
        ]);      
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '2',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit data '.$currentname->name.' => '. $value
        ]);
    }


    public function menuupdate(Request $request, $role)
    {     
        
        $menu = DB::table('adm_access')->where('role_id', '=', $role)->get();

        //------ to get role name -----//
        $rolename = DB::table('adm_role')->where('role_id', '=', $role)->first();
        // ----- end to get role name ---//

        $roletype = ConfigText::select('name', 'value')->where('id', '=', 6)->first();
        $valuetyp = str_replace(':', ',', $roletype->value);
        $type     = explode(",", $valuetyp);
        
        $typerole = [
          $type[0] => $type[1],
          $type[2] => $type[3],
          $type[4] => $type[5]
        ];

        $b = 1;
        $c = count($menu) - 1;
        for($i=0; $i<$c; $i++):
          
          // ---- Sebelum di edit ---- //
          $before = DB::table('asta_db.adm_access')->where('menu_id', '=', $menu[$i]->menu_id)->where('role_id', '=', $role)->first();
          // ---- end sebelum di edit ----//
          DB::table('asta_db.adm_access')->where('menu_id', $menu[$i]->menu_id)->where('role_id', '=', $role)->update([
            'type' => $_POST["typerole".$menu[$i]->menu_id]
          ]);

          //---- sesudah di edit ----//
          $after = DB::table('asta_db.adm_access')->where('menu_id', '=', $menu[$i]->menu_id)->where('role_id', '=', $role)->first();

          // ---- log untuk menu type ----//
          if($after->type != $before->type):

            $menuname = DB::table('adm_menu')->select('name')->where('menu_id', '=', $menu[$i]->menu_id)->first();
            if($before->type == '0'):
              $currentvalue1 = ConfigTextTranslate($type[1]);
            elseif($before->type == '1'):
              $currentvalue1 = ConfigTextTranslate($type[3]);
            elseif($before->type == '2'):
              $currentvalue1 = ConfigTextTranslate($type[5]);
            endif;

            if($after->type == 0) :
              $value        = ConfigTextTranslate($type[1]);
            elseif($after->type == 1): 
              $value        = ConfigTextTranslate($type[3]);
            elseif($after->type == 2): 
              $value        = ConfigTextTranslate($type[5]);
            endif;  
            Log::create([
              'op_id'     => Session::get('userId'),
              'action_id' => '2',
              'datetime'  => Carbon::now('GMT+7'),
              'desc'      => 'Edit Tipe Peran Aksses nama peran: '.$rolename->name.' ('.translate_menu($menuname->name).') '.$currentvalue1.' => '. $value
            ]);
          endif;
          // ---- end log untuk menu type ----//

          // ---- end sesudah di edit ----//

          
        endfor;
        
        return redirect()->route('Role_Admin')->with('success', alertTranslate('L_DATA_UPDATED'));


    }

    public function destroy(Request $request)
    {
        $userid = $request->id;
        $operator = DB::table('operator')->where('role_id', '=', $userid)->first();
      
        if(!$operator) {
          if($userid != '')
          {
              $rolename = DB::table('asta_db.adm_role')->where('role_id', '=', $userid)->first();
              DB::table('asta_db.adm_role')->where('role_id', '=', $userid)->delete();
              DB::table('asta_db.adm_access')->where('role_id', '=', $userid)->delete();

              Log::create([
                  'op_id'     => Session::get('userId'),
                  'action_id' => '2',
                  'datetime'  => Carbon::now('GMT+7'),
                  'desc'      => 'Hapus data Nama Peran '.$rolename->name
              ]);
              return redirect()->route('Role_Admin')->with('success', alertTranslate('L_DATA_DELETED'));
          }
          return redirect()->route('Role_Admin')->with('alert', alertTranslate('L_SOMETHING_WRONG')); 
        }
        return back()->with('alert', alertTranslate('Operator Still use this role, wait until role didnott use'));
    }

    //DELETE ALL SELECTED 
    public function deleteAllSelected(Request $request)
    {
      $ids         = $request->userIdAll;
      $rolenameall = $request->rolenameAll;
      
      DB::table('asta_db.adm_role')->whereIn('role_id', explode(",", $ids))->delete();
      DB::table('asta_db.adm_access')->whereIn('role_id', explode(",", $ids))->delete();

      Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '2',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Hapus data ('.$rolenameall.')'
      ]);

      return redirect()->route('Role_Admin')->with('success', alertTranslate('L_DATA_DELETED'));
    }

}
