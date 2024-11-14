<script>
    // Add this near the end of your body tag
    let inactivityTime = function () {
        let time;
        // Reset the timer on any user activity
        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeydown = resetTimer;
        document.onclick = resetTimer;
        document.onscroll = resetTimer;
        document.ontouchstart = resetTimer;

        function logout() {
            window.location.href = "{{ route('logout') }}";
        }

        function resetTimer() {
            clearTimeout(time);
            time = setTimeout(logout, 30000);
        }
    };
    inactivityTime();
</script>
