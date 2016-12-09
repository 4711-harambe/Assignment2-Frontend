<?php
?>
<!-- Loads basic unordered list navbar -->

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Munmer Difflin</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        {menudata}
        <li><a href="{link}">{name}</a></li>
        {/menudata}
      </ul>
      <p class= "navbar-text navbar-right">Role: {userrole}</p>
    </div><!--/.nav-collapse -->
  </div>
</nav>




<!--<div class="navbar-inner">
      <ul class="nav">
          {menudata}
          <li><a href="{link}">{name}</a></li>
          {/menudata}
      </ul>
</div>-->
