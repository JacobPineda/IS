<?php


echo "<!-------- START SIDE NAV --------->
<span style='font-size:30px;cursor:pointer' onclick='openNav()'>&#9776;</span>

<div id='mySidenav' class='sidenav'>
  <a href='javascript:void(0)' class='closebtn' onclick='closeNav()'>&times;</a>
<nav class='navigation'>
  <ul class='mainmenu'>
    <li><a href='/IS/home.php'>Home</a></li>
    <li><a href=''>Schools</a>
      <ul class='submenu'>
        <li><a href='/'>School1</a></li>
        <li><a href=''>School2</a></li>
      </ul>
    </li>
    <li><a href=''>Products</a>
      <ul class='submenu'>
        <li><a href='/IS/reports/drug.php'>Drugs</a></li>
        <li><a href=''>Prod2</a></li>
      </ul>
    </li>
    <li><a href=''>About</a></li>
    <li><a href=''>Contact Us</a></li>
  </ul>
</nav>
</div>


<script>
function openNav() {
    document.getElementById('mySidenav').style.width = '250px';
}

function closeNav() {
    document.getElementById('mySidenav').style.width = '0';
}
</script>

<!-------- END SIDE NAV --------->"


?>