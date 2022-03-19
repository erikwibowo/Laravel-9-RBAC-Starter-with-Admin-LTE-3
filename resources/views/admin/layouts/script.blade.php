<script>
    localStorage.getItem('theme') == "light" || localStorage.getItem('theme') == null ? $("#icontheme").attr("class","fas fa-sun"):$("#icontheme").attr("class","fas fa-moon");
    document.querySelector('body').classList.add(localStorage.getItem('theme'));
    $(document).ready(function(){
        $("#btntheme").on("click", function(){
            if (localStorage.getItem('theme') == 'light' || localStorage.getItem('theme') == null) {
            localStorage.setItem('theme', 'dark-mode')
            document.querySelector('body').classList.add(localStorage.getItem('theme'));
            document.querySelector('body').classList.remove('light');
            $("#icontheme").attr("class","fas fa-moon");
            }else{
            localStorage.setItem('theme', 'light')
            document.querySelector('body').classList.add(localStorage.getItem('theme'));
            document.querySelector('body').classList.remove('dark-mode');
            $("#icontheme").attr("class","fas fa-sun");
            }
        });

        $(function () {
            $('.datatable').DataTable({
                "stateSave": true
            });
        });
    });
</script>