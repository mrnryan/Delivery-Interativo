<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login • Delivery SaaS</title>
    <style>
      /* Reset simples */
      * { box-sizing: border-box; margin: 0; padding: 0; }
      html, body { height: 100%; font-family: Arial, sans-serif; }

      /* Fundo e centralização */
      body {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ffebee 0%, #fff3e0 100%);
      }

      /* Card de login */
      .login-card {
        position: relative;
        background: #ffffff;
        padding: 2rem 1.5rem 3rem;
        width: 320px;
        border-radius: 8px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        text-align: center;
      }
      /* Ícone de delivery */
      .login-card::before {
        content: "🚚";
        font-size: 3rem;
        position: absolute;
        top: -30px;
        left: calc(50% - 1.5rem);
      }

      .login-card h2 {
        margin-top: 1.5rem;
        margin-bottom: 1.5rem;
        color: #333333;
        font-size: 1.4rem;
      }

      /* Mensagem de erro */
      .error {
        color: #c62828;
        margin-bottom: 1rem;
        font-size: 0.9rem;
      }

      /* Inputs */
      .input-group {
        margin-bottom: 1.2rem;
        text-align: left;
      }
      .input-group label {
        display: block;
        font-size: 0.85rem;
        color: #555555;
        margin-bottom: 0.3rem;
      }
      .input-group input {
        width: 100%;
        padding: 0.6rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 0.95rem;
      }
      .input-group input:focus {
        border-color: #ff7043;
        outline: none;
      }

      /* Botão */
      button {
        width: 100%;
        padding: 0.7rem;
        border: none;
        border-radius: 4px;
        background: #ff5722;
        color: #ffffff;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
      }
      button:hover {
        background: #e64a19;
      }
    </style>
</head>
<body>
  <div class="login-card">
    <h2>SaaS Delivery</h2>

    <?php if(isset($error)): ?>
      <p class="error"><?= htmlspecialchars($error, ENT_QUOTES) ?></p>
    <?php endif; ?>

    <form method="post" action="?c=auth&a=login">
      <div class="input-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required autofocus>
      </div>
      <div class="input-group">
        <label for="password">Senha</label>
        <input id="password" type="password" name="password" required>
      </div>
      <button type="submit">Entrar</button>
    </form>
  </div>
</body>
</html>

