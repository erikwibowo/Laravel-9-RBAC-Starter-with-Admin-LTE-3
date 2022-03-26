@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @can('create role')
                            <div class="card-header">
                                <h3 class="card-title">
                                    <button class="btn btn-sm btn-success" id="btn-tambah"><i class="fas fa-plus"></i> Tambah</button>
                                </h3>
                            </div>
                            @endcan
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Guard</th>
                                            <th>Permission</th>
                                            <th>Updated</th>
                                            @canany(['update role', 'delete role'])
                                                <th>Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $i)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $i->name }}</td>
                                                <td>{{ $i->guard_name }}</td>
                                                <td>
                                                    @if ($i->name == 'superadmin' || count($i->permissions) == count($permission))
                                                        All permission
                                                    @else
                                                        {{ $i->permissions->implode('name', '|') }}
                                                    @endif
                                                </td>
                                                <td>{{ $i->updated_at }}</td>
                                                @canany(['update role', 'delete role'])
                                                    <td>
                                                        <div class="btn-group">
                                                            @can('update role')
                                                                @if ($i->name != 'superadmin')
                                                                    <button class="btn btn-sm btn-primary btn-edit" data-id="{{ $i->id }}"><i class="fas fa-pencil-alt"></i></button>
                                                                @endif
                                                            @endcan
                                                            @can('delete role')
                                                                @if ($i->name != 'superadmin')
                                                                    <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $i->id }}" data-name="{{ $i->name }}"><i class="fas fa-trash"></i></button>
                                                                @endif
                                                            @endcan
                                                        </div>
                                                    </td>
                                                @endcanany
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $(document).on("click", '#btn-tambah', function() {
                $('input:checkbox').prop('checked', false);
                $('#modal-tambah').modal({backdrop: 'static', keyboard: false, show: true});
            });
            $(document).on("click", '.btn-edit', function() {
                let id = $(this).attr("data-id");
                $('#modal-loading').modal({backdrop: 'static', keyboard: false, show: true});
                $.ajax({
                    url: "{{ route('role.show') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        // console.log(data.data.permissions);
                        var data = data.data;
                        var permissions = data.permissions;
                        if (permissions.length == {{ count($permission) }}) {
                            $("#checkAllu").prop('checked', true);
                        }else{
                            $("#checkAllu").prop('checked', false);
                        }
                        if (data.name == 'superadmin') {
                            $('input:checkbox.permission').prop('checked', true);
                            $('input:checkbox.permission').prop('disabled', true);
                            $("#checkAllu").prop('checked', true);
                            $("#checkAllu").prop('disabled', true);
                        }else{
                            $('input:checkbox.permission').prop('checked', false);
                            $('input:checkbox.permission').prop('disabled', false);
                            $("#checkAllu").prop('disabled', false);
                        }
                        for (let i = 0; i < permissions.length; i++) {
                            $(`#${permissions[i].id}u`).prop('checked', true);
                        }
                        $("#name").val(data.name);
                        $("#guard_name").val(data.guard_name);
                        $("#id").val(data.id);
                        $('#modal-loading').modal('hide');
                        $('#modal-edit').modal({backdrop: 'static', keyboard: false, show: true});
                    },
                });
            });
            
            $(document).on("click", '.btn-delete', function() {
                let id = $(this).attr("data-id");
                let name = $(this).attr("data-name");
                $("#did").val(id);
                $("#delete-data").html(name);
                $('#modal-delete').modal({backdrop: 'static', keyboard: false, show: true});
            });

            $("#checkAll").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $("#checkAllu").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
@endsection

@section('modal')
    {{-- Modal tambah --}}
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <label>Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Guard</label>
                            <div class="input-group">
                                <select class="form-control" name="guard_name">
                                    <option value="web">web</option>
                                    <option value="api">api</option>
                                </select>
                                @error('guard_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group mt-2">
                            <label>Permission</label>
                        </div>
                        <div class="input-group">
                            <div class="icheck-primary col-md-3">
                                <input class="form-check-input" type="checkbox" id="checkAll">
                                <label class="form-check-label" for="checkAll">Check All</label>
                            </div>
                        </div>
                        <div class="input-group">
                            @foreach ($permission as $p)
                                <div class="icheck-primary col-md-3">
                                    <input class="form-check-input permission" type="checkbox" name="permissions[]" id="{{ $p->id }}" value="{{ $p->name }}">
                                    <label class="form-check-label {{ strtok($p->name, ' ') == 'delete' ? 'text-danger':'' }}" for="{{ $p->id }}">{{ $p->name }}</label>
                                </div>
                            @endforeach
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- Modal Update --}}
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('role.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="input-group">
                            <label>Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" id="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Guard</label>
                            <div class="input-group">
                                <select class="form-control" name="guard_name" id="guard_name">
                                    <option value="web">web</option>
                                    <option value="api">api</option>
                                </select>
                                @error('guard_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group mt-2">
                            <label>Permission</label>
                        </div>
                        <div class="input-group">
                            <div class="icheck-primary col-md-3">
                                <input class="form-check-input" type="checkbox" id="checkAllu">
                                <label class="form-check-label" for="checkAllu">Check All</label>
                            </div>
                        </div>
                        <div class="input-group">
                            @foreach ($permission as $p)
                                <div class="icheck-primary col-md-3">
                                    <input class="form-check-input permission" type="checkbox" name="permissions[]" id="{{ $p->id }}u" value="{{ $p->name }}">
                                    <label class="form-check-label {{ strtok($p->name, ' ') == 'delete' ? 'text-danger':'' }}" for="{{ $p->id }}u">{{ $p->name }}</label>
                                </div>
                            @endforeach
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- Modal delete --}}
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('role.destroy') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <p class="modal-text">Apakah anda yakin akan menghapus? <b id="delete-data"></b></p>
                        <input type="hidden" name="id" id="did">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection