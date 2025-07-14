<?php
// views/sidebar.php
?>
<nav class="nav flex-column sidebar-nav">
  <a class="nav-link <?= ($_GET['c']=='dashboard')?'active':'' ?>"
     href="?c=dashboard&a=index">
    <i class="fas fa-home me-2"></i> Dashboard
  </a>
  <a class="nav-link <?= ($_GET['c']=='company')?'active':'' ?>"
     href="?c=company&a=index">
    <i class="fas fa-store me-2"></i> Empresas
  </a>
  <a class="nav-link <?= ($_GET['c']=='financial')?'active':'' ?>"
     href="?c=financial&a=index">
    <i class="fas fa-dollar-sign me-2"></i> Financeiro
  </a>
  <a class="nav-link <?= ($_GET['c']=='note')?'active':'' ?>"
     href="?c=note&a=index">
    <i class="fas fa-sticky-note me-2"></i> Anotações
  </a>
  <a class="nav-link <?= ($_GET['c']=='user')?'active':'' ?>"
     href="?c=user&a=index">
    <i class="fas fa-users me-2"></i> Usuários
  </a>
</nav>
