<h1>Admin Usuario / Carga masiva</h1>
<div class="wpcontent">Carga masiva de usuarios<br></div>

<form action="<?php echo Yii::app()->params['baseUrl'].'/adminUsuario/cargaUsuario' ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="AdminUsuario[usuariosCSV]" />
    <input type="submit" name="AdminUsuario[cargaUsuario]" value="Enviar" />
</form>
<p><?php echo $msg; ?></p>