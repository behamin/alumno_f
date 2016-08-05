<div class="changes-avatar">
    <div class="img-acount">
        <img alt="" src="<?= base_url('assets/profile_images/'.$alumno->getAlumnosdatos()->getImage()) ?>">
    </div>
    <div class="choses-file up-file">
        <input type="file">
        <input type="hidden">
        <a class="mc-btn btn-style-6 open-file" style="cursor: pointer" cmd="profile_images">Cambiar imagen</a>
        <form enctype="multipart/form-data" name="form-image_profile" action="<?= site_url('main_controler/upload_attachment/') ?>" method="post">
          <input name="param" value="alumnos,Alumnosdatos,Image,<?= $idAlumno ?>,200,200,500,profile_images,profile" type="hidden"/>
          <input name="cdm" value="profile_images" type="hidden"/>
          <input name="profile_images" cmd="image_profile" style="display:none" type="file">
        </form>
    </div>
</div>
