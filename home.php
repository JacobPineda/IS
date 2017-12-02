<?php
   error_reporting (E_ALL ^ E_NOTICE);
   session_start();
   /*
   *Setting up session variables
   *arrCheckedVals - contains all values of selected columns in each industry
   *page - current page of the generated table
   */
   
   $_SESSION['arrCheckedVals'] =  null;
   $_SESSION['page'] = 1;
   $_SESSION['selected_report'] = 'default';
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Home</title>
   </head>
   <style>
      h1 {
      margin-top: 3em;
      margin-bottom: 0.5em;
      font-size: 1.5em;
      font-weight: bold;
      color: #22581d;
      }
      .emphasis {
      font-weight: bold;
      display: inline-block;
      color:	#ae3232;
      }
      .color.icon {
      color: 	#d4af37;
      }
   </style>
   <body>
      <!--<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>-->
      <?php
         include("topnav.php");
         ?>
      <div class="pusher">
      <br><br><br><br>
      <div class="ui centered text container">
         <h1><i class="info circle icon"></i>About Report Analytics Portal</h1>
         This​ ​web​ ​application​ ​is​ ​a​ ​general-purpose​ ​information​ ​portal​ ​about​ ​certificates​ ​of 
         registration​ ​of​ ​various​ ​
         <div class="emphasis">products​</div>
         (biological,​ ​drug,​ ​food,​ ​food​ ​supplement,​ ​hazardous​ ​substance, HMR,​ ​HDL,​ ​household​ ​pesticide,​ ​household​ ​remedy,​ ​veterinary,​ ​medical​ ​oxygen)​ ​issued​ ​by​ ​the 
         FDA,​ ​
         <div class="emphasis">state​ ​university​ ​colleges​</div>
         and​ 
         <div class="emphasis">public​ ​elementary​ ​schools.​</div>
         <br><br>
         The​ ​rationale​ ​of​ ​this​ ​web​ ​application​ ​is​ ​for​ ​compiling,​ ​consolidating​ ​and​ ​organizing​ ​large 
         amount​ ​of​ ​data​ ​concerning​ ​product​ ​registration,​ ​state​ ​university​ ​colleges​ ​and​ ​public​ ​elementary 
         schools.​ ​One​ ​of​ ​the​ ​products​ ​involved​ ​are​ ​drug​ ​products,​ ​this​ ​web​ ​app​ ​can​ ​be​ ​helpful​ ​to​ ​
         <div class="emphasis">doctors</div>
         , 
         <div class="emphasis">pharmacies​</div>
         and​ 
         <div class="emphasis">​patients</div>
         . ​While​ ​the​ ​schools​ ​component​ ​of​ ​the​ ​web​ ​app​ ​can​ ​be​ ​useful​ ​to 
         <div class="emphasis">students​</div>
         and​ ​their​ ​
         <div class="emphasis">parents​</div>
         to​ ​assess​ ​the​ ​most​ ​affordable​ ​and​ ​suitable​ ​schools​ ​for​ ​them.
         <div class="ui section divider"></div>
         <div class="ui centered text container">
            <h1><i class="puzzle icon"></i>Features</h1>
            The​ ​user​ ​would​ ​be​ ​able​ ​to​ ​
            <div class="emphasis">search </div>
            for​ ​the​ ​product/college/school​ ​that​ ​they​ ​are​ ​looking​ ​for​ ​and​ ​
            <div class="emphasis">view​</div>
            the​ ​information​ ​about​ ​it.​ ​The 
            web​ ​application​ ​aims​ ​to​ ​make​ ​it​ ​easier​ ​and​ ​simplify​ ​the​ ​process​ ​of​ ​gathering​ ​information​ ​about 
            the​ ​products​ ​and​ ​schools​ ​by​ ​offering​ ​an​ ​easy​ ​to​ ​use​ ​and​ ​understand​ ​user​ ​interface. <br><br>
            Specifically, this web app has the features:
            <ul class="ui list">
               <li>Title​ ​selection​ ​for​ ​industries​ ​(school,​ ​univ,​ ​products) </li>
               <li>Dynamic​ ​table​ ​generation​ ​from​ ​selected​ ​columns​ ​per​ ​industry </li>
               <li>Dynamic​ ​report​ ​generation​ ​(bar,​ ​pie,​ ​line​ ​graph,​ ​etc)​ ​from​ ​selected​ ​columns​ ​per​ ​industry </li>
               <li>Recommended​ ​reports​ ​(predefined​ ​reports​ ​from​ ​report​ ​generation)​ ​with​ ​title </li>
               <li>As​ ​an​ ​admin,​ ​I​ ​can​ ​add/update/delete​ ​entries​ ​of​ ​rows,​ ​columns​ ​and​ ​data​ ​of​ ​each industry​ ​title​ ​(school,​ ​univ,​ ​products).​ ​(Content​ ​management) </li>
               <li>Tagging​ ​of​ ​period​ ​(e.g.​ ​Top​ ​10​ ​schools​ ​for​ ​2016,​ ​etc.)</li>
            </ul>
            <div class="ui section divider"></div>
            <h1><i class="address card icon"></i>About the Team</h1>
            We are a group from 
            <div class="emphasis">CS 165 HTUV-PULA</div>
            under Ma'am Ada Cariaga
            <br><br>
            <div class="ui four column grid">
               <div class="column">
                  <h2 class="ui icon header">
                     <i class="user circle color icon"></i>
                     <div class="content">
                        Frederick Luartes
                        <div class="sub header">2016-91170</div>
                     </div>
                  </h2>
               </div>
               <div class="column">
                  <h2 class="ui icon header">
                     <i class="user circle color icon"></i>
                     <div class="content">
                        Jacob Miguel Pineda​
                        <div class="sub header">2015-05345</div>
                     </div>
                  </h2>
               </div>
               <div class="column">
                  <h2 class="ui icon header">
                     <i class="user circle color icon"></i>
                     <div class="content">
                        Jules Rodriguez​
                        <div class="sub header">2012-21928</div>
                     </div>
                  </h2>
               </div>
               <div class="column">
                  <h2 class="ui icon header">
                     <i class="user circle color icon"></i>
                     <div class="content">
                        Paola Faith Simon
                        <div class="sub header">2014-32670</div>
                     </div>
                  </h2>
               </div>
            </div>
            <div class="ui section divider"></div>
            <h1><i class="cubes icon"></i>Tools and Technologies Used</h1>
            <div class="ui hidden divider"></div>
            <div class="ui divided relaxed horizontal list">
               <div class="item">
                  <div class="content">
                     <div class="header">Language</div>
                     PHP
                  </div>
               </div>
               <div class="item">
                  <div class="content">
                     <div class="header">Web Server</div>
                     XAMPP
                  </div>
               </div>
               <div class="item">
                  <div class="content">
                     <div class="header">UI Framework</div>
                     Semantic UI
                  </div>
               </div>
            </div>
         </div>
         <br><br><br>
      </div>
   </body>
</html>