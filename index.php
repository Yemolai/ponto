<!DOCTYPE html>
<html lang='pt-br'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <link rel="icon" href="./favicon.ico" />
  <link rel="stylesheet" href="./lib/vuetify.min.css">
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
  <title>Ponto</title>
  <?php # to generate imports easily
    function println($text) {
      echo "\n" . $text . "\n";
    }
    $libs = array(
      'vue.min.js',
      'vue-router.min.js',
      'vuex.min.js',
      'axios.min.js',
      'vuetify.min.js',
      'moment.min.js',
      'moment.pt-br.min.js'
    );
    foreach ($libs as $lib) { ?>
    <script src="./lib/<?=$lib?>"></script>
  <?php } ?>
  <link rel="stylesheet" type="text/css" href="./css/app.css"/>
</head>
<body>
  <!-- root app -->
  <div id="app">
    <v-app :dark="$store.state.darkTheme">
      <v-sidebar></v-sidebar>
      <v-topbar></v-topbar>
      <v-content>
        <v-container fluid>
          <router-view></router-view>
        </v-container>
      </v-content>
    </v-app>
  </div>
  <?php
  $components = array(
    'v-calendar-dialog',
    'v-calendar-day',
    'v-calendar-week',
    'v-calendar',
    'marcacoes',
    'route-calendar',
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