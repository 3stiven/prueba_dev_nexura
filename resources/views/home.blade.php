@extends('layout')
@section('userCom')
@include('menu')
<v-main class="pb-0" style="background: #f3f3f3;">
  
    <router-view name="dialog"></router-view>
    <router-view></router-view>
    <v-overlay
    fixed
    v-if="loading_get_info"
    z-index="9"
    opacity="1"
    color="white"
    :value="loading_get_info"
  >
    <v-card light elevation="0" tile>
      <v-progress-circular
        :size="70"
        :width="7"
        color="primary"
        class="d-block mx-auto"
        indeterminate
      ></v-progress-circular>
      <v-card-text
        class="
          primary--text
          text-center
          pa-0
          text-h4
          ml-0
          mr-0
          mb-0
          mt-5
          font-weight-bold
        "
      >
        Procesando solicitud
      </v-card-text>
      <v-card-text
        class="secondary--text text-center pa-0 text-h6 ml-0 mr-0 mt-0 mb-5"
      >
        Esto podría tardar unos segundos
      </v-card-text>
    </v-card>
  </v-overlay>
</v-fade-transition>
</v-main>
    {{-- @if(Auth::user()->role == 1)
         <usuario-component :role={{json_encode(Auth::user()->role)}}></usuario-component>
    @elseif(auth()->user()->role == 2) 
         <administrador-component :role={{json_encode(Auth::user()->role)}}></administrador-component>
    @endif --}}
@endsection
