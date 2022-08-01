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
                            <h1 class="m-0 text-dark">Clientes</h1>
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
                                        Lista y administracion de clientes
                                    </h3>
                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                                                    <span class="fas fa-plus"></span>
                                                    Añadir cliente
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- /.card-header -->
                                <div class="card-body table-responsive">
                                    <table class="table" id="table">
                                        <thead>
                                            <tr>
                                                <th>C.I</th>
                                                <th>Nombres</th>
                                                <th>Fecha de Nacimiento</th>
                                                <th>Direccion</th>
                                                <th>Telefono</th>
                                                <th>Email</th>
                                                <th>Estado</th>
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
                        <h4 class="modal-title">Registro de nuevo cliente</h4>
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
                                        <label for="nationality">Nacionalidad</label>
                                        <select id="nationality" class="form-control">
                                            <option value="V">Venezolano</option>
                                            <option value="E">Extranjero</option>
                                            <option value="J">Juridico</option>
                                        </select>
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="ci">Cedula o RIF</label>
                                        <input type="text" class="form-control" id="id" placeholder="Ingresar Cedula o Rif">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                            </div>
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
                                        <label for="birthdate">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" id="birthdate">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="address">Dirección</label>
                                        <input type="text" class="form-control" id="address" placeholder="Dirección del cliente">
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
                                        <label for="phone">Telefono</label>
                                        <input type="tel" class="form-control" id="phone" placeholder="ingresar numero de telefono">
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
                        <h4 class="modal-title">El cliente se inhabilitara</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Esta seguro de inhabilitar este cliente?</p>
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
            $.get('/api/customers')
              .done(res => {
                const customers = JSON.parse(res)
                const table = document.getElementById('table').children[1]
                table.innerHTML = ``
                customers.filter(employee => Number(employee.status) === 1).forEach(customer => {
                    const row = table.insertRow()
                    row.setAttribute('id', customer.id);
                    row.innerHTML = `
                        <td>${customer.nationality}- ${customer.ci}</td>
                        <td>${customer.first_name} ${customer.last_name}</td>
                        <td>${customer.birth_date}</td>
                        <td>${customer.address}</td>
                        <td>${customer.phone}</td>
                        <td>${customer.email}</td>
                        <td>${Boolean(customer.status) ? 'Activo' : 'Inactivo'}</td>
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
                        document.getElementById('id-modal').value = customer.id
                    }

                    const btnGroups = document.createElement('div')
                    btnGroups.className = 'btn-group'
                    btnGroups.appendChild(btnRemove)

                    row.children[7].appendChild(btnGroups)
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
                            nationality    : inputs[0].value,
                            ci             : inputs[1].value,
                            first_name     : inputs[2].value,
                            last_name      : inputs[3].value,
                            birth_date     : inputs[4].value,
                            address        : inputs[5].value,
                            email          : inputs[6].value,
                            phone          : inputs[7].value
                        }

                        $.post('/api/customers/add', newData)
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

                        $.post('/api/customers/edit', newData)
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
