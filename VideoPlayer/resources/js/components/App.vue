<template>
   <div>
       <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
           <div class="container">
               <ul class="navbar-nav">
                   <router-link :to="{ name: 'welcome' }" class="nav-link">Home</router-link>
                   <router-link :to="{ name: 'feedback' }" class="nav-link">Deixe aqui seu Feedback!</router-link>
               </ul>

           </div>
       </nav>
       <div class="container">
           <main>
               <router-view></router-view>
           </main>
       </div>
   </div>
</template>
<script>
   export default {}
</script>
