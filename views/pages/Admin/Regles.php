<?php include(dirname(__FILE__)."/../../header.php"); ?>
    <script src="<?php echo fr\gilman\nj\Conf::common()['urlAdmin']['js']; ?>/pages/Admin/regles.js"></script>
    <script src="<?php echo fr\gilman\nj\Conf::common()['urlAdmin']['js']; ?>/ckeditor/ckeditor.js"></script>

    <div class="row col-sm-12">
        <fieldset>
            <button id="btEnvoyerRegles1" class="btn btn-default btEnvoyerRegles">Envoyer</button>
            <textarea name="regles" id="regles" rows="20" cols="80"><?php echo $regles; ?></textarea>
            <button id="btEnvoyerRegles2" class="btn btn-default btEnvoyerRegles">Envoyer</button>
        </fieldset>
    </div>
<?php include(dirname(__FILE__)."/../../footer.php"); ?>