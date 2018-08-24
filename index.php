<!DOCTYPE html>
<html lang='pt-br'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <link rel="icon" href="./favicon.ico" />
  <link rel="stylesheet" href="./lib/vuetify.min.css">
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
  <title>Marcação de ponto</title>
  <?php # to generate imports easily
    function println($text) {
      echo "\n" . $text . "\n";
    }
    $libs = array('vue.js', 'vue-router.js', 'vuex.js', 'axios.js', 'vuetify.js', 'moment.js');
    foreach ($libs as $lib) { ?>
    <script src="./lib/<?=$lib?>"></script>
  <?php } ?>
  <link rel="stylesheet" type="text/css" href="./css/app.css"/>
</head>
<body>
  <!-- root app -->
  <div id="app">
    <v-app :dark="darkTheme">
      <v-sidebar
        :open="sidebarOpen"
        :toggle-dark-theme="toggleTheme"
        :dark="darkTheme"
      ></v-sidebar>
      <v-topbar :toggle-sidebar="toggleSidebar"></v-topbar>
      <v-content>
        <v-container fluid>
          <router-view></router-view>
        </v-container>
      </v-content>
    </v-app>
  </div>
  <?php
  $components = array(
    'v-calendar-day',
    'v-calendar-week',
    'v-calendar',
    'marcacoes',
    'route-main',
    'v-sidebar',
    'v-topbar'
  );
  # including components html templates
  foreach ($components as $component) {
    println('<script type="text/x-template" id="template-' . $component . '">');
    include('./components/' . $component . '.html');
    println('</script>');
  }
  # including components js vue scripts
  foreach ($components as $component) {
    println('<script type="text/javascript">');
    include('./components/' . $component . '.js');
    println('</script>');
  }
  println('<script type="text/javascript">');
  include('./app.js');
  println('</script>');
  ?>
</body>
</html>