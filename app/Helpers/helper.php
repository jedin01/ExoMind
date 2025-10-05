<?php

use App\Models\Paciente;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

function tempoDesdeCriacao($data)
{
    $agora = Carbon::now();
    $dataCriacao = Carbon::parse($data);
    $diferencaMinutos = abs($agora->diffInMinutes($dataCriacao));
    if ($diferencaMinutos < 1) {
        return 'Agora';
    }

    // Obtém a diferença em dias, horas e minutos
    $diferencaDias = $agora->diffInDays($dataCriacao);
    $diferencaHoras = $agora->diffInHours($dataCriacao) % 24;
    $diferencaMinutos = $diferencaMinutos % 60;

    // Monta a string de retorno
    $tempo = '';

    if ($diferencaDias > 0) {
        $tempo .= $diferencaDias . ' dia(s) ';
    }

    if ($diferencaHoras > 0) {
        $tempo .= $diferencaHoras . ' hora(s) ';
    }

    if ($diferencaMinutos > 0) {
        $tempo .= $diferencaMinutos . ' minuto(s)';
    }
    return trim($tempo);
}
function my_hospital_id(){
    return Auth::user()->hospital;
}

function menusByRole(){
    $menus = Auth::user()->fk_role->fk_role_permissions;
      $groups_array = [];
      $current_group = "";
      foreach($menus as $menu){
        if($menu->fk_module->fk_group->vc_nome != $current_group){
          $current_group = $menu->fk_module->fk_group->vc_nome;
        }
        $groups_array[$current_group][]=$menu->fk_module;
      }
      return $groups_array;
}
function my_hospital(){
    return Auth::user()->fk_hospital;
}
function isLoja(){
    $routePrefix = app(RT::class)->getPrefix();
    //dd(strpos($routePrefix, 'loja'));
    return strpos($routePrefix, 'loja');
}
function paciente_id(){
    if(Auth::user()->funcao == 3){
        return Paciente::where('user',Auth::id())
            ->first()
            ->id;
    }
}

function users()
{
    return User::all();
}
function  upload( $file){
    $nomeFile = uniqid() . '.' . $file->getClientOriginalExtension();
    $caminhoFile = public_path('docs/files/imagens'); // Pasta de destino

    $file->move($caminhoFile, $nomeFile);
    return "docs/files/imagens/".$nomeFile;

}
function profile_photo_path($caminho){
    $caminho =isset($caminho)?$caminho->profile_photo_path:'perfil.png';
    return $caminho;

}
function my_profile_photo_path(){
    return Auth::check()? Auth::user()->profile_photo_path:'perfil.png';

}
?>
