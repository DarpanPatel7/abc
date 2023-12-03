<!-- Footer-->
<footer class="content-footer footer bg-footer-theme">
  <div class="{{ (!empty($containerNav) ? $containerNav : 'container-fluid') }} d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
    <div class="mb-2 mb-md-0">
      © <script>
        document.write(new Date().getFullYear())

      </script>
      , made with ❤️ by <a href="{{ (!empty(config('global.creatorUrl')) ? config('global.creatorUrl') : '') }}" target="_blank" class="footer-link fw-semibold">{{ (!empty(config('global.creatorName')) ? config('global.creatorName') : '') }}</a>
    </div>
    <div>
      <a href="{{ config('global.licenseUrl') ? config('global.licenseUrl') : '#' }}" class="footer-link me-4" target="_blank">License</a>
      <a href="{{ config('global.moreThemes') ? config('global.moreThemes') : '#' }}" target="_blank" class="footer-link me-4">More Themes</a>
      <a href="{{ config('global.documentation') ? config('global.documentation') : '#' }}" target="_blank" class="footer-link me-4">Documentation</a>
      <a href="{{ config('global.support') ? config('global.support') : '#' }}" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
    </div>
  </div>
</footer>
<!--/ Footer-->
