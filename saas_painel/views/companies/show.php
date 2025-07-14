<?php // views/companies/show.php ?>
<h2>Detalhes da Empresa</h2>
<a href="?c=company&a=index" class="btn btn-secondary mb-3">
  <i class="fas fa-arrow-left"></i> Voltar
</a>

<table class="table table-striped">
  <tr><th>ID</th>               <td><?= $company['id'] ?></td></tr>
  <tr><th>Nome</th>             <td><?= htmlspecialchars($company['nome']) ?></td></tr>
  <tr><th>Slug</th>             <td><?= $company['slug'] ?></td></tr>
  <tr><th>Trial (dias)</th>     <td><?= $company['trial_days'] ?></td></tr>
  <tr><th>Início</th>           <td><?= $company['subscription_start'] ?></td></tr>
  <tr><th>Fim</th>              <td><?= $company['subscription_end'] ?></td></tr>
  <tr><th>Status</th>           <td><?= ucfirst($company['status']) ?></td></tr>
  <tr><th>Email Admin Delivery</th><td><?= htmlspecialchars($company['admin_email']) ?></td></tr>
  <tr><th>Senha Admin Delivery</th><td><?= htmlspecialchars($company['admin_password']) ?></td></tr>
  <tr><th>WhatsApp</th>         <td><?= htmlspecialchars($company['whatsapp']) ?></td></tr>
  <tr><th>Cidade</th>           <td><?= htmlspecialchars($company['cidade']) ?></td></tr>
  <tr><th>CEP</th>              <td><?= htmlspecialchars($company['cep']) ?></td></tr>
  <tr><th>Rua</th>              <td><?= htmlspecialchars($company['rua']) ?></td></tr>
  <tr><th>Número</th>           <td><?= $company['sem_numero'] ? '—' : htmlspecialchars($company['numero']) ?></td></tr>
  <tr><th>Sem Número</th>       <td><?= $company['sem_numero'] ? 'Sim' : 'Não' ?></td></tr>
  <tr><th>Documento</th>        <td><?= htmlspecialchars($company['documento']) ?></td></tr>
</table>
