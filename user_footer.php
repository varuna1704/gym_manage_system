            </div>
        </div>
    </main>
    <footer class="site-footer">Nikam Varuna</footer>
</div>
<script>
(function () {
    function fitSurfaces() {
        var wraps = document.querySelectorAll('.fit-wrap');
        for (var i = 0; i < wraps.length; i++) {
            var wrap = wraps[i];
            var surface = wrap.querySelector('.content-surface');
            if (!surface) {
                continue;
            }

            surface.style.setProperty('--content-scale', '1');

            var availableHeight = Math.max(1, wrap.clientHeight - 2);
            var availableWidth = Math.max(1, wrap.clientWidth - 2);
            var contentHeight = Math.max(1, surface.scrollHeight);
            var contentWidth = Math.max(1, surface.scrollWidth);

            var scale = Math.min(1, availableHeight / contentHeight, availableWidth / contentWidth);
            surface.style.setProperty('--content-scale', scale.toFixed(3));
        }
    }

    window.addEventListener('load', fitSurfaces);
    window.addEventListener('resize', fitSurfaces);
})();
</script>
</body>
</html>
