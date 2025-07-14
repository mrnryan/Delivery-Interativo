<?php // views/header.php ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Painel SaaS</title>
  <!-- Bootstrap 5 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    rel="stylesheet"
  >
  <!-- Seu CSS custom -->
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    /* botão fixo no mobile */
    .logout-fixed-mobile {
      position: fixed;
      top: 8px;
      right: 8px;
      z-index: 2000;
    }
    /* não exibe o logout mobile quando o offcanvas estiver aberto */
    .offcanvas.show + .flex-grow-1 .logout-fixed-mobile {
      display: none !important;
    }
    @media (max-width: 767.98px) {
    .topbar {
      height: 80px !important;
    }
  }
  </style>
</head>
<body class="bg-light">
  <div class="d-flex vh-100">

    <!-- Sidebar fixo no desktop -->
    <aside class="d-none d-md-block bg-dark text-white p-3" style="width:250px">
      <h4 class="mb-4">Painel SaaS</h4>
      <?php require __DIR__ . '/sidebar.php'; ?>
    </aside>

    <!-- Offcanvas sidebar no mobile -->
    <div
      class="offcanvas offcanvas-start d-md-none bg-dark text-white p-3"
      tabindex="-1"
      id="sidebarOffcanvas"
      aria-labelledby="sidebarOffcanvasLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarOffcanvasLabel">Painel SaaS</h5>
        <button
          type="button"
          class="btn-close btn-close-white text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Fechar"
        ></button>
      </div>
      <div class="offcanvas-body px-0">
        <?php require __DIR__ . '/sidebar.php'; ?>
      </div>
    </div>

    <div class="flex-grow-1 d-flex flex-column">

      <!-- Topbar/Header -->
      <header class="topbar position-relative">
        <!-- Botão mobile para abrir sidebar -->
        <button
          class="btn btn-sm btn-outline-secondary me-3 d-md-none"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebarOffcanvas"
          aria-controls="sidebarOffcanvas"
        >
          <i class="fas fa-bars"></i>
        </button>

        <?php
          $titles = [
            'dashboard' => 'Dashboard',
            'company'   => 'Empresas',
            'financial' => 'Financeiro',
            'note'      => 'Anotações',
            'user'      => 'Usuários'
          ];
          $c = $_GET['c'] ?? 'dashboard';
          $title = $titles[$c] ?? ucfirst($c);
        ?>
        <h1 class="mb-0 text-truncate" style="flex:1; min-width:0; margin:0;">
          <?= htmlspecialchars($title, ENT_QUOTES) ?>
        </h1>

        <!-- Logout inline no desktop -->
        <a
          href="?c=auth&a=logout"
          class="btn btn-sm btn-outline-danger d-none d-md-inline-flex align-items-center position-relative ms-auto"
        >
          <i class="fas fa-sign-out-alt me-1"></i> Sair
        </a>
      </header>

      <!-- Logout fixo no mobile -->
      <a
        href="?c=auth&a=logout"
        class="btn btn-sm btn-outline-danger logout-fixed-mobile d-md-none"
        title="Sair"
      >
        <i class="fas fa-sign-out-alt"></i> Sair
      </a>

      <!-- Conteúdo principal -->
      <main class="p-4 flex-fill overflow-auto">
        <!-- Aqui entra o conteúdo específico de cada view -->
