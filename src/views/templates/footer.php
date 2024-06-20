<footer class="text-center container-fluid bg-warning text-light p-3">
    <p class="m-0">All rights reserved &copy; YoungStars FC <span id="copyrightYear"></span></p>
    <p class="m-0" style="font-size: smaller;">Developed by <a href="https://www.casmir.dev" target="_blank" class="text-white">casmir.dev</a></p>
</footer>

<script>
    const copyrightYearElement = document.getElementById("copyrightYear");
    copyrightYearElement.textContent = new Date().getFullYear();
</script>