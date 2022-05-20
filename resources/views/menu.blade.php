<v-navigation-drawer
width="250"
v-model="drawer_help"
app
clipped
mini-variant.sync="mini"
>
<v-list-item>
  <v-list-item-content>
    <v-list-item-title class="text-h6"> Administrador </v-list-item-title>
    <v-list-item-subtitle> Estiven Leon </v-list-item-subtitle>
  </v-list-item-content>
</v-list-item>

<v-divider></v-divider>

<v-list dense nav>
   <v-list-item  v-for="item in itemsCrud" :to="item.ruta" :key="item.text"   link> 
  
    
     <v-list-item-title v-text="item.text"></v-list-item-title> 
     {{-- <v-list-item-title v-text="item.ruta"></v-list-item-title>  --}}
    <v-list-item-icon>
        <v-icon v-text="item.icon"></v-icon>
    </v-list-item-icon>
    
  </v-list-item>
</v-list>
</v-navigation-drawer>