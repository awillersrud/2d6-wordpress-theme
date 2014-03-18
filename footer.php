<hr>

<footer class="clearfix">

</footer>


</div> <!-- mork -->
</div> <!-- slidebar main content end: sb-site -->


<!-- Le javascript

================================================== -->
<!-- jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<!-- Slidebars -->
<script src="<?php bloginfo('template_directory'); ?>/slidebars/slidebars/0.9/slidebars.js"></script>
<script>
    (function($) {
        $(document).ready(function() {
            var mySlidebars = new $.slidebars();
            $('.hamburger-meny').on('click', function() {
                mySlidebars.toggle('left');
            });
        });
    }) (jQuery);
</script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-48955910-1', 'spillforeningen2d6.no');
    ga('send', 'pageview');

</script>
</body>
</html>