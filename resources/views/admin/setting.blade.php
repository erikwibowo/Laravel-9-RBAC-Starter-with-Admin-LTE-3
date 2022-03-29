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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    @foreach ($category as $i)
                                        <li class="nav-item"><a class="nav-link {{ $loop->iteration == 1 ? 'active':'' }}" href="#{{ $i->category }}" data-toggle="tab">{{ Str::ucfirst($i->category) }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach ($category as $i)
                                        @php
                                            $settings = \App\Models\Setting::where(['category' => $i->category])->get();
                                        @endphp
                                        <div class="tab-pane {{ $loop->iteration == 1 ? 'active':'' }}" id="{{ $i->category }}">
                                            <form class="form-horizontal" action="{{ route('setting.update') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @foreach ($settings as $set)
                                                    <div class="form-group row">
                                                        <label for="{{ $set->key }}" class="col-sm-2 col-form-label">{{ str_replace("Application ", "", $set->name) }}</label>
                                                        <div class="col-sm-10">
                                                            @if ($set->type == 'text')
                                                                <input type="hidden" name="key[]" value="{{ $set->key }}">
                                                                <input type="text" name="value[]" value="{{ $set->value }}" class="form-control" id="{{ $set->key }}" placeholder="{{ $set->name }}" required>
                                                            @elseif($set->type == 'textarea')
                                                                <input type="hidden" name="key[]" value="{{ $set->key }}">
                                                                <textarea type="text" name="value[]" rows="3" class="form-control" id="{{ $set->key }}" placeholder="{{ $set->name }}" required>{{ $set->value }}</textarea>
                                                            @elseif($set->type == 'file')
                                                                <img src="{{ asset($set->value) }}" alt="{{ $set->name }}" id="{{ $set->key }}-image" width="8%">
                                                                <div class="input-group">
                                                                    <input type="hidden" name="key[]" value="{{ $set->key }}">
                                                                    <input type="text" readonly class="form-control" placeholder="{{ $set->name }}" name="value[]" id="{{ $set->key }}" value="{{ $set->value }}" readonly required>
                                                                    {{-- <div class="input-group-append">
                                                                        <button class="btn btn-primary" type="button" id="{{ $set->key }}button">Pilih Foto</button>
                                                                    </div> --}}
                                                                </div>
                                                                <small class="text-primary">Klik untuk memilih file</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    @php
        $setts = \App\Models\Setting::where(['type' => 'file'])->get();
    @endphp
    @foreach ($setts as $set)
        @php
            $setid[] = '#'.$set->key;
            $jsonsetid = json_encode($setid, true);
        @endphp
    @endforeach
    <script>
        $(document).ready(function() {
            // input
            let inputId = '';
            function fmSetLink($url) {
                $(inputId).val($url.substring(1));
                $(inputId+'-image').attr("src", "{{ asset(null) }}"+$url.substring(1));
            }
            
            window.fmSetLink = fmSetLink;

            $(document).on("click", '{{ implode(',', $setid) }}', function(event) {
                event.preventDefault();
                inputId = '#'+event.target.id;
                window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
            });
        });
    </script>
@endsection