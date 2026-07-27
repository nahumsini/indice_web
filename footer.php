<!-- Footer -->
<footer class="site-footer">
  <div class="site-footer__brand-line" aria-hidden="true">
    <span></span><span></span><span></span><span></span>
  </div>
  <div class="container">
    <div class="row g-4 align-items-start site-footer__main">
      <div class="col-lg-5">
        <a href="/index.php" class="footer-brand-logo" aria-label="Índice">
          <span class="footer-logo-crop" aria-hidden="true">
            <img src="/imgs/indice-logo-official.png" alt="" class="footer-logo-img footer-logo-img--base" width="900" height="600" loading="lazy" decoding="async">
            <img src="/imgs/indice-logo-official.png" alt="" class="footer-logo-img footer-logo-img--wordmark" width="900" height="600" loading="lazy" decoding="async">
          </span>
          <span class="visually-hidden">Índice</span>
        </a>
        <p class="site-footer__description mt-3" data-i18n="footer.desc">
          Sistema operativo empresarial para ordenar y escalar tu negocio.
        </p>
        <a href="mailto:contacto@indiceapp.com" class="site-footer__email">contacto@indiceapp.com</a>
      </div>
      <div class="col-6 col-lg-2">
        <h6 class="site-footer__heading" data-i18n="footer.product">Producto</h6>
        <ul class="site-footer__links list-unstyled mt-3">
          <li class="mb-2"><a href="/modulos.php" data-i18n="nav.modules">Módulos</a></li>
          <li class="mb-2"><a href="/metodologia.php" data-i18n="nav.methodology">Metodología</a></li>
          <li class="mb-2"><a href="/modo-aprendiz.php" data-i18n="nav.apprentice">Modo aprendiz</a></li>
          <li class="mb-2"><a href="/planes.php" data-i18n="nav.plans">Planes</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg-2">
        <h6 class="site-footer__heading" data-i18n="footer.company">Empresa</h6>
        <ul class="site-footer__links list-unstyled mt-3">
          <li class="mb-2"><a href="/nosotros.php" data-i18n="nav.about">Nosotros</a></li>
          <li class="mb-2"><a href="/blog.php" data-i18n="nav.blog">Blog</a></li>
          <li class="mb-2"><a href="/ayuda.php" data-i18n="footer.links.help">Centro de ayuda</a></li>
        </ul>
      </div>
      <div class="col-12 col-lg-3">
        <h6 class="site-footer__heading" data-i18n="footer.support">Soporte</h6>
        <ul class="site-footer__links list-unstyled mt-3">
          <li class="mb-2"><a href="/nosotros.php" data-i18n="footer.links.contact">Contacto</a></li>
          <li class="mb-2"><a href="<?= getIndiceLoginUrlAttr() ?>" data-i18n="nav.login">Iniciar sesión</a></li>
          <li class="mb-2"><a href="/privacidad.php" data-i18n="footer.privacy">Privacidad</a></li>
          <li class="mb-2"><a href="/terminos.php" data-i18n="footer.terms">Términos</a></li>
        </ul>
      </div>
    </div>
    <hr class="site-footer__divider">
    <div class="row align-items-start mt-3 g-3 footer-corporate site-footer__corporate">
      <div class="col-md-6 text-center text-md-start company-info site-footer__company">
        <strong>Índice Technologies Inc.</strong><br>
        130 King St W, Toronto, ON, M5X1E3, Canada · Exchange Tower<br>
        <a href="mailto:contacto@indiceapp.com">contacto@indiceapp.com</a>
      </div>
      <div class="col-md-6 text-center text-md-end">
        <div>&copy; <?php echo date('Y'); ?> <span data-i18n="footer.rights">Indice. Todos los derechos reservados.</span></div>
        <div class="mt-1">
          <a href="/privacidad.php" class="site-footer__legal" data-i18n="footer.privacy">Privacidad</a> &nbsp;|&nbsp;
          <a href="/terminos.php" class="site-footer__legal" data-i18n="footer.terms">Términos</a>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Scripts del sitio -->
<script src="/js/i18n.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
