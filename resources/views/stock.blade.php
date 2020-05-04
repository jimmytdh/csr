@extends('app')

@section('css')

@endsection

@section('body')
    <h2 class="text-success title-header">{{ $name }} <small class="text-muted"></small></h2>
    <div class="row mb-2">
        <div class="col-lg-12">
            <form action="" class="form-inline">
                <div class="form-group">
                    <input type="text" placeholder="Search..." class="form-control mr-1">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-flat mr-1">
                        <i class="fa fa-search"></i> Search
                    </button>
                </div>
                <div class="form-group">
                    <a href="{{ url('/supply') }}" class="btn btn-default btn-flat">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>

    </div>
    @if(session('status')=='saved')
        <div class="alert alert-success">
            <i class="fa fa-check"></i> Successfully saved!
        </div>
    @endif

    @if(session('status')=='deleted')
        <div class="alert alert-warning">
            <i class="fa fa-check"></i> Successfully deleted!
        </div>
    @endif
    <section class="content">
        <div class="table-responsive-sm">
            @if(count($data) > 0)
            <table class="table table-sm table-striped mt-2">
                <tr class="bg-dark text-white">
                    <th>Brand</th>
                    <th>Unit</th>
                    <th>Qty</th>
                    <th>Expiration Date</th>
                    <th>Date Updated</th>
                </tr>
                @foreach($data as $row)
                <?php
                    $today = date('Y-m-d');
                    $expire = '';
                    if($today >= $row->date_expiration){
                        $expire = 'bg-warning';
                    }

                ?>
                <tr class="{{ $expire }}">
                    <td>
                        <a href="{{ url('/stock/delete/'.$row->id) }}" class="text-decoration-none delete">
                            <i class="fa fa-trash {{ $expire }} text-danger"></i>
                        </a>
                        {{ $row->brand }}
                    </td>
                    <td>{{ $row->unit }}</td>
                    <td>{{ $row->qty }}</td>
                    <td>{{ date('M d, Y',strtotime($row->date_expiration)) }}</td>
                    <td>{{ date('M d, Y',strtotime($row->updated_at)) }}</td>
                </tr>
                @endforeach
            </table>
            {{ $data->links() }}
            @else
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> No data found!
                </div>
            @endif
        </div>
    </section>
@endsection

@section('modal')

@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('.delete').on('click',function(e){
                e.preventDefault();
                var r = confirm('Are you sure you want to delete this supply?')
                if(r==true)
                    window.location = $(this).attr('href')
            })
        });
    </script>
@endsection
