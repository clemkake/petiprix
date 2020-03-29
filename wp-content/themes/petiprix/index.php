<?php get_header(); ?>

    <div id="zonesModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="top:30%">
        <div class="modal-dialog">
            <!-- 
                <?php print_r($_COOKIE);
                    print_r($_POST);
                ?>
            -->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Zones actives</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" >
                <select name="zones" class="form-control" id="zones">
                    <option value="Cocody"> Cocody </option>
                    <option value="Bingerville"> Bingerville </option>
                    <option value="Yopougon"> Yopougon   </option>
                    <option value="port-bouet"> port-bouet </option>
                    <option value="Abobo"> Abobo </option>
                    <option value="Adjame"> Adjame </option>
                    <option value="Plateau"> Plateau </option>
                    <option value="Koumassi"> Koumassi </option>
                    <option value="Marcori"> Marcori </option>
                    <option value="Treichville"> Treichville </option>
                    <option value="Songon"> Songon </option>
                </select>
                <button type="submit" class="btn btn-primary" style="margin-top: 10%;float: right;">valider</button>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="submit" class="btn btn-primary">changer</button> -->
            </div>
            </div>

        </div>
    </div>




<?php get_template_part('includes/main-content'); ?>
<?php get_footer(); ?>
