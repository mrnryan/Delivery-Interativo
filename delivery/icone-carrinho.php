<!-- BOTÃO DO CARRINHO -->

<div class="col-xl-3 mr-5">
  <div class="header__info d-flex align-items-center">
    <div class="header__info-cart tpcolor__oasis ml-10 tp-cart-toggle">
      <button><i><img src="<?= BASE_URL_STATIC ?>img/icon/cart-1.svg" alt=""></i>
        <span id="total-itens-carrinho"></span>
      </button>
    </div>
  </div>
</div>

<!-- header-cart-start -->
<div class="tpcartinfo tp-cart-info-area p-relative">
  <button class="tpcart__close"><i class="icon-x"></i></button>
  <div class="tpcart">
    <h4 class="tpcart__title">CARRINHO</h4>
    <div class="tpcart__product">
      <div class="tpcart__product-list">
        <ul id="listar-itens-carrinho-icone" style="margin-left: -40px;">
        </ul>
      </div>
      <div class="tpcart__checkout">
        <div class="tpcart__total-price d-flex justify-content-between align-items-center">
          <span> Subtotal:</span>
          <span class="heilight-price">R$ <span id="total-carrinho-icone"></span></span>
        </div>
        <div class="tpcart__checkout-btn">
          <a class="tpcheck-btn link-neutro2" href="carrinho">VER CARRINHO</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JS here -->
<script src="<?= BASE_URL_STATIC ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL_STATIC ?>assets/js/nice-select.js"></script>
<script src="<?= BASE_URL_STATIC ?>assets/js/main.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    listarCarrinhoIcone();
  });

  function listarCarrinhoIcone() {
    $.ajax({
      url: '<?= BASE_URL_STATIC ?>js/ajax/listar-itens-carrinho-icone.php',
      method: 'POST',
      data: {},
      dataType: "html",
      success: function (result) {
        $("#listar-itens-carrinho-icone").html(result);
      }
    });
  }
</script>
