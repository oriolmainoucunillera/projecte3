<!-- PEU DE PÀGINA DE L'APLICACIÓ -->

<?php
    function footer() {
        ?>
            <div id="peupagina" class="text-center text-white">
                <p>
                    <script>
                        // Script per mostrar l'any actual a la web
                        var date = new Date();
                        var year = date.getFullYear();
                        document.write("Copyright " + year + " per AILLED.");
                    </script>
                </p>
            </div>
        <?php
    }
?>
