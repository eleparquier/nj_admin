<?php include(dirname(__FILE__)."/../../header.php"); ?>
    <script src="<?php echo fr\gilman\nj\Conf::common()['urlAdmin']['js']; ?>/pages/Admin/regles.js"></script>
    <script src="<?php echo fr\gilman\nj\Conf::common()['urlAdmin']['js']; ?>/ckeditor/ckeditor.js"></script>

    <form class="col-sm-12">
        <fieldset>
            <div class="form-group groupBt" id="groupBt1">
                <button id="btEnvoyerRegles1" class="btn btn-default btEnvoyerRegles">Envoyer</button>
                <span class="help-block"></span>
            </div>
            <textarea name="regles" id="regles" rows="20" cols="80"><?php echo $regles; ?></textarea>
            <div class="form-group groupBt" id="groupBt2">
                <button id="btEnvoyerRegles2" class="btn btn-default btEnvoyerRegles">Envoyer</button>
                <span class="help-block"></span>
            </div>
        </fieldset>
    </form>
<?php include(dirname(__FILE__)."/../../footer.php"); ?>