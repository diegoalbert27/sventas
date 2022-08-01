<!DOCTYPE html>
<html lang='es'>

<?php include_once '../app/Views/partials/head.php' ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

        <?php include_once '../app/Views/partials/navbar.php' ?>

        <?php include_once '../app/Views/partials/sidebar.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Empleados</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Lista y administracion de vendedores
                                    </h3>
                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                                                    <span class="fas fa-plus"></span>
                                                    Anadir vendedor
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- /.card-header -->
                                <div class="card-body table-responsive">
                                    <table class="table" id="table">
                                        <thead>
                                            <tr>
                                                <th>Nombres</th>
                                                <th>Usuario</th>
                                                <th>Email</th>
                                                <th>Fecha de Ingreso</th>
                                                <th>Estado</th>
                                                <th>Cargo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                        <!-- /.Left col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registro de nuevo vendedor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger text-center d-none" id="alert-modal-add">
                            Debe de llenar el formulario correctamente
                        </div>
                        <form id="form-add" role="form">
                            <div class="form-row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="firstName">Nombre</label>
                                        <input type="text" class="form-control" id="firstName" placeholder="Ingresar nombre">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="lastName">Apellido</label>
                                        <input type="text" class="form-control" id="lastName" placeholder="Ingresar Apellido">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="user">Usuario</label>
                                        <input type="text" class="form-control" id="user" placeholder="Asignar nombre de usuario">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="ingresar direccion de email">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" id="password" placeholder="Asignar contraseña para acceso a cuenta">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="role">Cargo</label>
                                        <select class="form-control" name="role" id="role">
                                            <option value="">Seleccionar Cargo</option>
                                            <option value="2">Vendedor</option>
                                        </select>
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btn-modal-add">Guardar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-trash">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">El vendedor se inhabilitara</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Esta seguro de inhabilitar este vendedor?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="hidden" name="id-modal" id="id-modal">
                        <button type="button" class="btn btn-danger" id="btn-modal-remove">Si, estoy seguro</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <?php include_once '../app/Views/partials/footer.php' ?>
    </div>
    <!-- ./wrapper -->

    <!-- Import JavaScript -->
    <!-- Import AdminLTE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js" integrity="sha512-KBeR1NhClUySj9xBB0+KRqYLPkM6VvXiiWaSz/8LCQNdRpUm38SWUrj0ccNDNSkwCD9qPA4KobLliG26yPppJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function get() {
            $.get('/api/employees')
              .done(res => {
                const employees = JSON.parse(res)
                const table = document.getElementById('table').children[1]
                table.innerHTML = ``
                employees.filter(employee => Number(employee.status) === 1).forEach(employee => {
                    const row = table.insertRow()
                    row.setAttribute('id', employee.id);
                    row.innerHTML = `
                        <td>${employee.first_name} ${employee.last_name}</td>
                        <td>${employee.username}</td>
                        <td>${employee.email}</td>
                        <td>${employee.created_at}</td>
                        <td>${Boolean(employee.status) ? 'Activo' : 'Inactivo'}</td>
                        <td>Vendedor</td>
                        <td></td>
                    `

                    const btnRemove = document.createElement('button')
                    btnRemove.setAttribute('data-toggle', 'modal')
                    btnRemove.setAttribute('data-target', '#modal-trash')
                    btnRemove.className = 'btn btn-danger'
                    btnRemove.innerHTML = `
                        <span class="fas fa-trash"></span>
                    `
                    btnRemove.onclick = () => {
                        document.getElementById('id-modal').value = employee.id
                    }

                    const btnGroups = document.createElement('div')
                    btnGroups.className = 'btn-group'
                    btnGroups.appendChild(btnRemove)

                    row.children[6].appendChild(btnGroups)
                })
              })
              .fail(err => console.log(err))
        }

        document.addEventListener('DOMContentLoaded', () => {
            const inputs = Array.from(document.querySelectorAll('#form-add input, #form-add select'))
            const textsErrors = Array.from(document.getElementsByClassName('text-error'))

            get()

            inputs.forEach((input, i) => {
                input.onfocus = () => {
                    input.classList.remove('border')
                    input.classList.remove('border-danger')
                    textsErrors[i].classList.add('d-none')
                }

                input.onblur = () => {
                    if (input.value === '') {
                        input.classList.add('border')
                        input.classList.add('border-danger')
                        textsErrors[i].classList.remove('d-none')
                        return
                    }

                    input.classList.remove('border')
                    input.classList.remove('border-danger')
                    textsErrors[i].classList.add('d-none')
                }
            })

            document.getElementById('btn-modal-add')
                .addEventListener('click', (e) => {
                    let isCorrect = true

                    const alertModalAdd = document.getElementById('alert-modal-add')

                    inputs.forEach((input, i) => {
                        if (input.value === '') {
                            input.classList.add('border')
                            input.classList.add('border-danger')
                            textsErrors[i].classList.remove('d-none')
                            return
                        }

                        input.classList.remove('border')
                        input.classList.remove('border-danger')
                        textsErrors[i].classList.add('d-none')
                    })

                    isCorrect = inputs.every(input => input.value !== '')

                    if (isCorrect) {
                        e.target.innerHTML = `
                        <div class="spinner-border text-light" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        `

                        alertModalAdd.classList.add('d-none')

                        const newData = {
                            first_name    : inputs[0].value,
                            last_name     : inputs[1].value,
                            username      : inputs[2].value,
                            email         : inputs[3].value,
                            password      : inputs[4].value,
                            role_id       : inputs[5].value
                        }

                        $.post('/api/employees/add', newData)
                            .done(res => {
                                let { message } = JSON.parse(res)

                                if (message === 'success') {
                                    e.target.innerHTML = 'Guardar'
                                    inputs.forEach((input) => {
                                        input.value = ''
                                    })
                                    $('#modal-lg').modal('hide')
                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.options.closeDuration = 300;
                                    toastr.options.closeEasing = 'swing';
                                    toastr.success('Agregado satisfactoriamente')
                                    get()
                                }
                            })
                            .fail(err => console.log(err))
                    } else {
                        alertModalAdd.classList.remove('d-none')
                    }
                })

                document.getElementById('btn-modal-remove')
                    .addEventListener('click', () => {
                        const { value } = document.getElementById('id-modal')

                        const newData = {
                            status: 0,
                            id: value
                        }

                        $.post('/api/employees/edit', newData)
                            .done(res => {
                                let { message } = JSON.parse(res)

                                if (message === 'success') {
                                    $('#modal-trash').modal('hide')
                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.options.closeDuration = 300;
                                    toastr.options.closeEasing = 'swing';
                                    toastr.success('Acción Realizada con exito')
                                    get()
                                }
                            })
                            .fail(err => console.log(err))
                    })
        })
    </script>

    <!-- End of the imports -->
</body>

</html>
