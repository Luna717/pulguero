<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body class="bg-dark text-light">
    <div class="container ">
        <h1>ver producto</h1>
            <?php echo form_open('');?>
            <div class="form-group">
                <?php
                    echo form_label('Nombre', 'nombre');

                    $data = [
                        'name'      => 'nombre',
                        'value'     => $nombre,
                        'class'     => 'form-control input-lg', 
                        'readonly' => true
                    ];
                    echo form_input($data);
                    ?>
            </div>
            <div class="form-group">
                <?php
                    echo form_label('Password', 'password');

                    $data = [
                        'name'      => 'password',
                        'value'     => $password,
                        'class'     => 'form-control input-lg', 
                        'type'     => 'password',
                        'readonly' => true
                    ];
                    echo form_input($data);
                    ?>
            </div>
            <div class="form-group">
                <?php
                    echo form_label('Correo', 'correo');

                    $data = [
                        'name'      => 'correo',
                        'value'     => $correo,
                        'class'     => 'form-control input-lg', 
                        'readonly' => true
                    ];
                    echo form_input($data);
                    ?>
            </div>
			
            <a class="btn btn-outline-light mt-2" href="../listadoUsuarios">regresar</a>


        <?php echo form_close();?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>