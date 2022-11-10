            <footer class="row tm-row">
                <div class="col-md-6 col-12 tm-color-gray">
                    Design: <a rel="nofollow" target="_parent" href="#" class="tm-external-link">G-EV-Vehicles</a>
                </div>
                <div class="col-md-6 col-12 tm-color-gray tm-copyright">
                    Copyright 2022 Tesla Company Co. Ltd.
                </div>
            </footer>
        </main>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/templatemo-script.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.tm-nav-item').click(function(){
                var id = $(this).attr('id');
                localStorage.setItem('idActive',id);
            });
            $('#'+localStorage.getItem('idActive')).addClass('active');
        });
    </script>
</body>
</html>