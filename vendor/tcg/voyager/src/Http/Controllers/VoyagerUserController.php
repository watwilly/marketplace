<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use \App\User as user;

class VoyagerUserController extends VoyagerBaseController
{
    public function profile(Request $request)
    {
        $route = '';
        $dataType = Voyager::model('DataType')->where('model_name', Auth::guard(app('VoyagerGuard'))->getProvider()->getModel())->first();
        if (!$dataType && app('VoyagerGuard') == 'web') {
            $route = route('voyager.users.edit', Auth::user()->getKey());
        } elseif ($dataType) {
            $route = route('voyager.'.$dataType->slug.'.edit', Auth::user()->getKey());
        }

        return Voyager::view('voyager::profile', compact('route'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    { 
        if (Auth::user()->getKey() == $id) {
            $request->merge([
                'role_id'                              => Auth::user()->role_id,
                'active'                               =>$request->active,
                'user_belongstomany_role_relationship' => Auth::user()->roles->pluck('id')->toArray(),
            ]);
        }

        return parent::update($request, $id);
    }

    public function delete($id)
    {
       $user = user::where('id', $id)->first();

       if (is_null($user)) {
            return redirect()->back()->with([
                'message'    =>"Este usuario ya no existe en el sistema",
                'alert-type' => 'error',
            ]);  
       }
       #remove incidencias;
       $incidencias = $user->incidenciasId();
       if ($incidencias->count() > 0) {
        $incidencias->delete();
       }

       #remove interesados
       $interesados = $user->interesados();
       if ($interesados->count() > 0) {
            $interesados->delete();
       }

       #remove reports
       $reportes = $user->reportesId();
       if ($reportes->count() > 0) {
            $reportes->delete();
       }

       #remove services
       $servicios = $user->serviciosId();
       if ($servicios->count() > 0) {
            $servicios->delete();
       }

       #remove store
       $tienda = $user->tienda();
       if ($tienda->count() > 0) {
            $tienda->delete();
       }

       $user_meli = $user->usermeli();
       if ($user_meli->count() > 0) {
            $user_meli->delete();
       }



       #remove publications
       $pub = $user->postsId()->get();

        if ($pub->count() > 0) {
            foreach ($pub as $publication) {
               //remove colors
                $colores = $publication->postscolores();
                if ($colores->count() > 0) {
                    $colores->delete();
                }

                //remove waist
                $talles = $publication->poststalles();
                if ($talles->count() > 0) {
                    $talles->delete();
                }

                //remove vehicles
                $vehiculos = $publication->postsvehiculos();
                if ($vehiculos->count() > 0) {
                    $vehiculos->delete();
                }

                //remove visit
                $visitas = $publication->postvisitas();
                if ($visitas->count() > 0) {
                    $visitas->delete();
                }

                //remove image
                $imagenes = $publication->postimagenes();

                if ($imagenes->count() > 0) {
                    $thumbnails = ['cropped','medium','mini','small'];
                    foreach ($imagenes->get() as  $image) {

                        $find = explode(".", $image->imagen);
                        $type = end($find);
                        $filename = basename($image->imagen, $type);
                        $filename = str_replace(".", "", $filename);
                        $dir = dirname($image->imagen);
                    
                        $this->deleteFileIfExists($image->imagen);

                       foreach ($thumbnails as  $thum) {
                          
                         $this->deleteFileIfExists("$dir/$filename-$thum.$type");
                       }
                    }
                    $imagenes->delete();
                }

                $publication->delete();
            }
        }

       try {
           $user->delete();
            return redirect()->back()->with([
                'message'    =>"El usuario y todos sus registros fueron eliminados del sistema",
                'alert-type' => 'success',
            ]);  
       } catch (Exception $e) {
            return redirect()->back()->with([
                'message'    =>$e,
                'alert-type' => 'error',
            ]);           
       }
    }

}
